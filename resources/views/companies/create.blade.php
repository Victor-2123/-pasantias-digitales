<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            
            <div class="mb-10">
                <a href="{{ route('companies.manage') }}" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest text-gray-400 hover:text-stitch-primary transition-colors mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                    Volver a gestión
                </a>
                <h1 class="font-lexend text-4xl font-bold text-stitch-primary">Nueva Empresa</h1>
                <p class="text-stitch-on-surface-variant mt-2">Registra un nuevo aliado estratégico en la plataforma.</p>
            </div>

            <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8 bg-white p-10 md:p-12 rounded-[3rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Nombre -->
                    <div>
                        <label for="name" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Nombre de la Empresa</label>
                        <input type="text" name="name" id="name" required value="{{ old('name') }}"
                            class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary font-bold placeholder-slate-300"
                            placeholder="Ej: Google Mexico">
                    </div>

                    <!-- Sector -->
                    <div>
                        <label for="sector" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Sector / Industria</label>
                        <input type="text" name="sector" id="sector" required value="{{ old('sector') }}"
                            class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary font-bold placeholder-slate-300"
                            placeholder="Ej: Tecnología / Salud / Finanzas">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Sitio Web -->
                    <div>
                        <label for="website" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Sitio Web (URL)</label>
                        <input type="url" name="website" id="website" value="{{ old('website') }}"
                            class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary font-bold placeholder-slate-300"
                            placeholder="https://example.com">
                    </div>

                    <!-- Color de Marca -->
                    <div>
                        <label for="color" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Color Corporativo (Hex)</label>
                        <div class="flex gap-4">
                            <input type="color" name="color" id="color" value="{{ old('color', '#3B82F6') }}"
                                class="w-16 h-14 bg-slate-50 border-none rounded-2xl p-1 cursor-pointer">
                            <input type="text" id="color_text" value="{{ old('color', '#3B82F6') }}" readonly
                                class="flex-grow bg-slate-50 border-none rounded-2xl p-4 text-stitch-primary font-bold">
                        </div>
                    </div>
                </div>

                <!-- Logo -->
                <div>
                    <label for="logo" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Logo de la Empresa</label>
                    <input type="file" name="logo" id="logo" accept="image/*"
                        class="w-full bg-slate-50 border-none rounded-2xl p-3 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary text-xs font-bold">
                </div>

                <!-- Descripcion -->
                <div>
                    <label for="description" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Descripción de la Empresa</label>
                    <textarea name="description" id="description" rows="5" required
                        class="w-full bg-slate-50 border-none rounded-2xl p-6 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary font-medium"
                        placeholder="Breve descripción de la misión y visión de la empresa..."></textarea>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full py-5 bg-stitch-primary text-white rounded-[1.5rem] font-bold text-sm uppercase tracking-widest hover:bg-stitch-secondary transition-all shadow-lg shadow-stitch-primary/20">
                        Registrar Empresa
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const colorInput = document.getElementById('color');
        const colorText = document.getElementById('color_text');
        colorInput.addEventListener('input', () => {
            colorText.value = colorInput.value;
        });
    </script>
</x-app-layout>
