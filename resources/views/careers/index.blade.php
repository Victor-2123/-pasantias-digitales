<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen" x-data="{ 
        search: '', 
        selectedCategory: 'all',
        careers: {{ $careers->map(fn($c) => ['name' => $c->name, 'category' => $c->category, 'slug' => $c->slug])->toJson() }},
        matches(name, category) {
            const s = this.search.toLowerCase();
            const n = name.toLowerCase();
            const catMatch = this.selectedCategory === 'all' || this.selectedCategory === category;
            return n.includes(s) && catMatch;
        },
        countMatches(category) {
            return this.careers.filter(c => this.matches(c.name, c.category) && (category === 'all' || c.category === category)).length;
        }
    }">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="space-y-8">
                <!-- Header & Search -->
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div class="max-w-xl">
                        <h1 class="font-lexend text-4xl font-bold text-stitch-primary mb-4 text-balance">Catálogo de Carreras</h1>
                        <p class="text-stitch-on-surface-variant text-base leading-relaxed">
                            Explora carreras profesionales, conoce el día a día de expertos en la industria y encuentra el mentor perfecto para guiar tu ambición.
                        </p>
                    </div>
                    
                    <!-- Search Bar -->
                    <div class="w-full md:w-80 relative group">
                        <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-stitch-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input 
                            type="text" 
                            x-model="search"
                            placeholder="Buscar carrera o área..." 
                            class="w-full pl-12 pr-4 py-3 bg-white border border-gray-200 rounded-stitch focus:border-stitch-primary focus:ring-4 focus:ring-stitch-primary/10 transition-all text-sm shadow-sm"
                        >
                    </div>
                </div>

                <!-- Category Filters -->
                <div class="flex flex-wrap gap-2 pb-4 border-b border-gray-200">
                    <button @click="selectedCategory = 'all'" :class="selectedCategory === 'all' ? 'bg-stitch-primary text-white shadow-lg shadow-stitch-primary/20' : 'bg-white text-stitch-on-surface-variant border border-gray-200 hover:bg-gray-50'" class="px-5 py-2 text-xs font-bold rounded-full transition-all uppercase tracking-widest">
                        Todas
                    </button>
                    @php
                        $categories = [
                            'A' => 'Ingeniería y Tecnología',
                            'B' => 'Salud y Bienestar',
                            'C' => 'Negocios y Ciencias Sociales',
                            'D' => 'Artes, Diseño y Educación'
                        ];
                    @endphp
                    @foreach($categories as $key => $label)
                        <button 
                            @click="selectedCategory = '{{ $key }}'" 
                            :class="selectedCategory === '{{ $key }}' ? 'bg-stitch-primary text-white shadow-lg shadow-stitch-primary/20' : 'bg-white text-stitch-on-surface-variant border border-gray-200 hover:bg-gray-50'" 
                            class="px-5 py-2 text-xs font-bold rounded-full transition-all uppercase tracking-widest flex items-center gap-2"
                        >
                            {{ $label }}
                            <span class="opacity-40 text-[10px]" x-text="careers.filter(c => c.category === '{{ $key }}').length"></span>
                        </button>
                    @endforeach
                </div>

                <!-- Catalogue Grid -->
                <div class="bg-white p-8 md:p-12 rounded-[2.5rem] border border-gray-100 shadow-sm min-h-[400px]">
                    <div class="mb-10 pb-6 border-b border-gray-100 flex justify-between items-end">
                        <div>
                            <h2 class="font-lexend text-2xl md:text-3xl font-bold text-stitch-primary">Zona Metropolitana</h2>
                            <p class="text-stitch-on-surface-variant text-base mt-2">Tampico, Madero y Altamira</p>
                        </div>
                        <div class="text-right">
                            <span class="text-xs font-bold text-stitch-primary uppercase tracking-widest bg-stitch-primary/5 px-3 py-1 rounded-full">
                                <span x-text="countMatches(selectedCategory)"></span> Resultados
                            </span>
                        </div>
                    </div>

                    @php
                        $categoryMeta = [
                            'A' => ['label' => 'Ingeniería y Tecnología',    'colorClass' => 'text-stitch-secondary',  'dotClass' => 'bg-stitch-secondary/50'],
                            'B' => ['label' => 'Salud y Bienestar',           'colorClass' => 'text-red-500',            'dotClass' => 'bg-red-400'],
                            'C' => ['label' => 'Negocios y Ciencias Sociales','colorClass' => 'text-green-600',          'dotClass' => 'bg-green-500'],
                            'D' => ['label' => 'Artes, Diseño y Educación',  'colorClass' => 'text-purple-500',         'dotClass' => 'bg-purple-400'],
                        ];
                    @endphp

                    <div class="space-y-12">
                        @foreach($grouped as $categoryKey => $careersGroup)
                            @php $meta = $categoryMeta[$categoryKey] ?? ['label' => $categoryKey, 'colorClass' => 'text-stitch-primary', 'dotClass' => 'bg-stitch-primary/50']; @endphp
                            
                            <div x-show="countMatches('{{ $categoryKey }}') > 0" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                                <h3 class="text-xs md:text-sm font-bold {{ $meta['colorClass'] }} uppercase tracking-wider mb-6 flex items-center gap-3">
                                    {{ $meta['label'] }}
                                    <div class="flex-1 h-px bg-gray-100"></div>
                                </h3>
                                <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-4 gap-x-8">
                                    @foreach($careersGroup as $career)
                                        <li x-show="matches('{{ $career->name }}', '{{ $career->category }}')" 
                                            class="flex items-center gap-3 group/item">
                                            <div class="w-2 h-2 rounded-full {{ $meta['dotClass'] }} group-hover/item:scale-125 transition-transform"></div>
                                            <a href="{{ route('careers.show', $career->slug) }}"
                                               class="text-sm md:text-base text-stitch-on-surface-variant hover:text-stitch-primary hover:translate-x-1 transition-all inline-block font-medium">
                                                {{ $career->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach

                        <!-- Empty State -->
                        <div x-show="countMatches(selectedCategory) === 0" class="text-center py-20">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h4 class="text-lg font-bold text-stitch-primary font-lexend">No encontramos coincidencias</h4>
                            <p class="text-stitch-on-surface-variant text-sm mt-2">Intenta con otros términos de búsqueda o cambia la categoría.</p>
                            <button @click="search = ''; selectedCategory = 'all'" class="mt-6 text-xs font-bold text-stitch-secondary uppercase tracking-widest hover:underline">Limpiar filtros</button>
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
