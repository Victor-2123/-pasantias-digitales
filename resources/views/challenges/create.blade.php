<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            
            <div class="mb-10">
                <a href="{{ route('challenges.manage') }}" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest text-gray-400 hover:text-stitch-primary transition-colors mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                    Volver a gestión
                </a>
                <h1 class="font-lexend text-4xl font-bold text-stitch-primary">Crear Nuevo Desafío</h1>
                <p class="text-stitch-on-surface-variant mt-2">Diseña una experiencia de aprendizaje retadora para tus alumnos.</p>
            </div>

            <form action="{{ route('challenges.store') }}" method="POST" class="space-y-8 bg-white p-10 md:p-12 rounded-[3rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                @csrf

                <!-- Titulo -->
                <div>
                    <label for="title" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Título del Desafío</label>
                    <input type="text" name="title" id="title" required value="{{ old('title') }}"
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary font-bold placeholder-slate-300"
                        placeholder="Ej: Rediseño de Interfaz Bancaria">
                    @error('title') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Carrera -->
                    <div>
                        <label for="career_id" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Carrera Relacionada</label>
                        <select name="career_id" id="career_id" required
                            class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary font-bold">
                            <option value="">Selecciona una carrera</option>
                            @foreach($careers as $career)
                                <option value="{{ $career->id }}" {{ old('career_id') == $career->id ? 'selected' : '' }}>{{ $career->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Empresa (Opcional) -->
                    <div>
                        <label for="company_id" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Empresa Patrocinadora (Opcional)</label>
                        <select name="company_id" id="company_id"
                            class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary font-bold">
                            <option value="">Ninguna</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Dificultad -->
                    <div>
                        <label for="difficulty" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Nivel de Dificultad</label>
                        <select name="difficulty" id="difficulty" required
                            class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary font-bold">
                            <option value="Fácil">Fácil</option>
                            <option value="Intermedio" selected>Intermedio</option>
                            <option value="Avanzado">Avanzado</option>
                        </select>
                    </div>

                    <!-- Fecha Límite -->
                    <div>
                        <label for="expires_at" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Fecha de Vencimiento (Opcional)</label>
                        <input type="date" name="expires_at" id="expires_at" value="{{ old('expires_at') }}"
                            class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary font-bold">
                    </div>
                </div>

                <!-- Descripción con Trix -->
                <div>
                    <label for="description" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Instrucciones Detalladas</label>
                    <div class="prose max-w-none">
                        <input id="description" type="hidden" name="description" value="{{ old('description') }}">
                        <trix-editor input="description" class="min-h-[300px] bg-slate-50 border-none rounded-2xl p-6 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary"></trix-editor>
                    </div>
                    @error('description') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full py-5 bg-stitch-primary text-white rounded-[1.5rem] font-bold text-sm uppercase tracking-widest hover:bg-stitch-secondary transition-all shadow-lg shadow-stitch-primary/20">
                        Publicar Desafío
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Trix Editor Assets -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <style>
        trix-toolbar .trix-button-group { border: none !important; margin-bottom: 10px !important; }
        trix-toolbar .trix-button { background: #f8fafc !important; border-radius: 8px !important; margin-right: 4px !important; }
        trix-editor { border: none !important; }
    </style>
</x-app-layout>
