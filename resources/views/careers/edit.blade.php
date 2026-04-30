<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            
            <div class="mb-10">
                <a href="{{ route('careers.manage') }}" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest text-gray-400 hover:text-stitch-primary transition-colors mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                    Volver a gestión
                </a>
                <h1 class="font-lexend text-4xl font-bold text-stitch-primary">Editar Carrera</h1>
                <p class="text-stitch-on-surface-variant mt-2">Actualiza la información del perfil profesional.</p>
            </div>

            <form action="{{ route('careers.update', $career) }}" method="POST" enctype="multipart/form-data" class="space-y-8 bg-white p-10 md:p-12 rounded-[3rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Nombre -->
                    <div>
                        <label for="name" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Nombre de la Carrera</label>
                        <input type="text" name="name" id="name" required value="{{ old('name', $career->name) }}"
                            class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary font-bold placeholder-slate-300">
                    </div>

                    <!-- Categoria -->
                    <div>
                        <label for="category" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Categoría / Área</label>
                        <select name="category" id="category" required
                            class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary font-bold">
                            @foreach(['Ingeniería y Tecnología', 'Salud y Bienestar', 'Negocios y Sociales', 'Artes y Educación'] as $cat)
                                <option value="{{ $cat }}" {{ old('category', $career->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label for="tagline" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Frase Corta (Tagline)</label>
                    <input type="text" name="tagline" id="tagline" required value="{{ old('tagline', $career->tagline) }}"
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary font-bold placeholder-slate-300">
                </div>

                <!-- Color e Icono -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="color" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Color de Marca (Hex)</label>
                        <div class="flex gap-4">
                            <input type="color" name="color" id="color" value="{{ old('color', $career->color) }}"
                                class="w-16 h-14 bg-slate-50 border-none rounded-2xl p-1 cursor-pointer">
                            <input type="text" name="color_text" id="color_text" value="{{ old('color', $career->color) }}" readonly
                                class="flex-grow bg-slate-50 border-none rounded-2xl p-4 text-stitch-primary font-bold">
                        </div>
                    </div>

                    <div>
                        <label for="icon" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Icono (Opcional - Reemplazar)</label>
                        <div class="flex items-center gap-4">
                            @if($career->icon)
                                <div class="w-14 h-14 bg-slate-50 rounded-xl flex items-center justify-center p-2">
                                    <img src="{{ asset('storage/' . $career->icon) }}" class="w-full h-full object-contain">
                                </div>
                            @endif
                            <input type="file" name="icon" id="icon" accept="image/*"
                                class="flex-grow bg-slate-50 border-none rounded-2xl p-3 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary text-xs font-bold">
                        </div>
                    </div>
                </div>

                <!-- Descripcion -->
                <div>
                    <label for="description" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Descripción de la Carrera</label>
                    <textarea name="description" id="description" rows="5" required
                        class="w-full bg-slate-50 border-none rounded-2xl p-6 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary font-medium">{{ old('description', $career->description) }}</textarea>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full py-5 bg-stitch-secondary text-white rounded-[1.5rem] font-bold text-sm uppercase tracking-widest hover:opacity-90 transition-all shadow-lg shadow-stitch-secondary/20">
                        Guardar Cambios
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
