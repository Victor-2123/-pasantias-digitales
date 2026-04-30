<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            
            <div class="mb-10">
                <a href="{{ route('careers.manage') }}" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest text-gray-400 hover:text-stitch-primary transition-colors mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                    Volver a gestión
                </a>
                <h1 class="font-lexend text-4xl font-bold text-stitch-primary">Nueva Carrera</h1>
                <p class="text-stitch-on-surface-variant mt-2">Registra un nuevo perfil profesional en el catálogo.</p>
            </div>

            <form action="{{ route('careers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8 bg-white p-10 md:p-12 rounded-[3rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Nombre -->
                    <div>
                        <label for="name" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Nombre de la Carrera</label>
                        <input type="text" name="name" id="name" required value="{{ old('name') }}"
                            class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary font-bold placeholder-slate-300"
                            placeholder="Ej: Licenciatura en Diseño UI/UX">
                    </div>

                    <!-- Categoria -->
                    <div>
                        <label for="category" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Categoría / Área</label>
                        <select name="category" id="category" required
                            class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary font-bold">
                            <option value="Ingeniería y Tecnología">Ingeniería y Tecnología</option>
                            <option value="Salud y Bienestar">Salud y Bienestar</option>
                            <option value="Negocios y Sociales">Negocios y Sociales</option>
                            <option value="Artes y Educación">Artes y Educación</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="tagline" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Frase Corta (Tagline)</label>
                    <input type="text" name="tagline" id="tagline" required value="{{ old('tagline') }}"
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary font-bold placeholder-slate-300"
                        placeholder="Ej: Crea experiencias digitales memorables.">
                </div>

                <!-- Color e Icono -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="color" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Color de Marca (Hex)</label>
                        <div class="flex gap-4">
                            <input type="color" name="color" id="color" value="{{ old('color', '#3B82F6') }}"
                                class="w-16 h-14 bg-slate-50 border-none rounded-2xl p-1 cursor-pointer">
                            <input type="text" name="color_text" id="color_text" value="{{ old('color', '#3B82F6') }}" readonly
                                class="flex-grow bg-slate-50 border-none rounded-2xl p-4 text-stitch-primary font-bold">
                        </div>
                    </div>

                    <div>
                        <label for="icon" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Icono (Imagen SVG/PNG)</label>
                        <input type="file" name="icon" id="icon" accept="image/*"
                            class="w-full bg-slate-50 border-none rounded-2xl p-3 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary text-xs font-bold">
                    </div>
                </div>

                <!-- Descripcion -->
                <div>
                    <label for="description" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-3">Descripción de la Carrera</label>
                    <textarea name="description" id="description" rows="5" required
                        class="w-full bg-slate-50 border-none rounded-2xl p-6 focus:ring-2 focus:ring-stitch-primary/20 text-stitch-primary font-medium"
                        placeholder="Describe de qué trata esta carrera..."></textarea>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full py-5 bg-stitch-primary text-white rounded-[1.5rem] font-bold text-sm uppercase tracking-widest hover:bg-stitch-secondary transition-all shadow-lg shadow-stitch-primary/20">
                        Crear Carrera
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
