<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen" x-data="{ 
        search: '', 
        selectedSector: 'all',
        companies: {{ $companies->map(fn($c) => [
            'id' => $c->id,
            'name' => $c->name, 
            'sector' => $c->sector ?? 'Otros', 
            'description' => $c->description ?? '',
            'slug' => $c->slug,
            'logo' => $c->logo ?? '🏢',
            'challenges_count' => $c->challenges->count()
        ])->toJson() }},
        matches(name, description, sector) {
            const s = this.search.toLowerCase();
            const n = name.toLowerCase();
            const d = (description || '').toLowerCase();
            const sectorMatch = this.selectedSector === 'all' || this.selectedSector === sector;
            return (n.includes(s) || d.includes(s)) && sectorMatch;
        },
        countMatches(sector) {
            return this.companies.filter(c => this.matches(c.name, c.description, c.sector) && (sector === 'all' || c.sector === sector)).length;
        }
    }">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            {{-- Header & Search --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-12">
                <div class="max-w-xl">
                    <h1 class="font-lexend text-4xl font-extrabold text-stitch-primary mb-6">Empresas Participantes</h1>
                    <p class="text-stitch-on-surface-variant text-base leading-relaxed">
                        Conecta con organizaciones líderes de la industria que están buscando talento e innovación. Explora
                        sus desafíos actuales y descubre cómo puedes contribuir a su crecimiento.
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
                        placeholder="Buscar por nombre o descripción..." 
                        class="w-full pl-12 pr-4 py-3 bg-white border border-gray-200 rounded-stitch focus:border-stitch-primary focus:ring-4 focus:ring-stitch-primary/10 transition-all text-sm shadow-sm"
                    >
                </div>
            </div>

            <!-- Sector Filters -->
            <div class="flex flex-wrap gap-2 mb-10 pb-6 border-b border-gray-200">
                <button @click="selectedSector = 'all'" :class="selectedSector === 'all' ? 'bg-stitch-primary text-white shadow-lg shadow-stitch-primary/20' : 'bg-white text-stitch-on-surface-variant border border-gray-200 hover:bg-gray-50'" class="px-5 py-2 text-xs font-bold rounded-full transition-all uppercase tracking-widest">
                    Todos los Sectores
                </button>
                @php
                    $sectors = $companies->pluck('sector')->unique()->filter()->values();
                @endphp
                @foreach($sectors as $sector)
                    <button 
                        @click="selectedSector = '{{ $sector }}'" 
                        :class="selectedSector === '{{ $sector }}' ? 'bg-stitch-primary text-white shadow-lg shadow-stitch-primary/20' : 'bg-white text-stitch-on-surface-variant border border-gray-200 hover:bg-gray-50'" 
                        class="px-5 py-2 text-xs font-bold rounded-full transition-all uppercase tracking-widest flex items-center gap-2"
                    >
                        {{ $sector }}
                        <span class="opacity-40 text-[10px]" x-text="companies.filter(c => c.sector === '{{ $sector }}').length"></span>
                    </button>
                @endforeach
            </div>

            @if($companies->isEmpty())
                <div class="text-center py-24 bg-white rounded-[2.5rem] border border-gray-100 shadow-sm">
                    <div class="text-6xl mb-6">🏢</div>
                    <p class="text-gray-400 italic font-medium">Aún no hay empresas registradas.</p>
                </div>
            @else
                {{-- 2-Column Card Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($companies as $company)
                        @php
                            $sectorStyles = [
                                'Tecnología'          => ['border' => '#3B82F6', 'badge_bg' => '#EFF6FF', 'badge_text' => '#2563EB', 'link' => '#2563EB', 'icon_bg' => '#F1F5F9'],
                                'Salud'               => ['border' => '#10B981', 'badge_bg' => '#ECFDF5', 'badge_text' => '#059669', 'link' => '#059669', 'icon_bg' => '#F1F5F9'],
                                'Finanzas'            => ['border' => '#F59E0B', 'badge_bg' => '#FFFBEB', 'badge_text' => '#D97706', 'link' => '#D97706', 'icon_bg' => '#F1F5F9'],
                                'Diseño & Creatividad'=> ['border' => '#8B5CF6', 'badge_bg' => '#F5F3FF', 'badge_text' => '#7C3AED', 'link' => '#7C3AED', 'icon_bg' => '#F1F5F9'],
                                'Negocios'            => ['border' => '#EC4899', 'badge_bg' => '#FDF2F8', 'badge_text' => '#DB2777', 'link' => '#DB2777', 'icon_bg' => '#F1F5F9'],
                            ];
                            $s = $sectorStyles[$company->sector] ?? ['border' => '#6B7280', 'badge_bg' => '#F9FAFB', 'badge_text' => '#374151', 'link' => '#374151', 'icon_bg' => '#F1F5F9'];
                        @endphp

                        <div x-show="matches('{{ $company->name }}', '{{ $company->description }}', '{{ $company->sector }}')"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100">
                            <a href="{{ route('companies.show', $company->slug) }}"
                               class="group bg-white rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col h-full border border-gray-100"
                               style="border-top: 5px solid {{ $s['border'] }};">

                                <div class="p-10 flex flex-col flex-1 space-y-6">

                                    {{-- Card Header: icon + sector badge --}}
                                    <div class="flex justify-between items-start">
                                        <div class="rounded-2xl p-4 text-4xl shadow-inner transition-transform group-hover:scale-110" style="background-color: {{ $s['icon_bg'] }};">
                                            {{ $company->logo ?? '🏢' }}
                                        </div>
                                        @if($company->sector)
                                            <span class="text-[10px] font-black px-4 py-2 rounded-full uppercase tracking-widest mt-2"
                                                  style="background-color: {{ $s['badge_bg'] }}; color: {{ $s['badge_text'] }};">
                                                {{ $company->sector }}
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Card Body --}}
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold text-stitch-primary mb-3 group-hover:text-stitch-secondary transition-colors font-lexend">
                                            {{ $company->name }}
                                        </h2>
                                        <p class="text-sm text-stitch-on-surface-variant leading-relaxed line-clamp-3 font-medium">
                                            {{ $company->description ?? 'Empresa aliada de Pasantías Digitales comprometida con el desarrollo de talento joven.' }}
                                        </p>
                                    </div>

                                    {{-- Card Footer --}}
                                    <div class="pt-6 border-t border-gray-50 flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full bg-stitch-secondary animate-pulse"></span>
                                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">
                                                {{ $company->challenges->count() }} 
                                                {{ $company->challenges->count() === 1 ? 'desafío' : 'desafíos' }}
                                            </span>
                                        </div>
                                        <span class="inline-flex items-center gap-2 text-sm font-bold transition-all group-hover:gap-3"
                                              style="color: {{ $s['link'] }};">
                                            Explorar
                                            <svg class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                            </svg>
                                        </span>
                                    </div>

                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Empty State Search -->
                <div x-show="countMatches(selectedSector) === 0" class="text-center py-24 bg-white rounded-[2.5rem] border border-gray-100 shadow-sm mt-8">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-stitch-primary font-lexend">No hay empresas que coincidan</h3>
                    <p class="text-stitch-on-surface-variant text-sm mt-2">Intenta ajustando los filtros o el término de búsqueda.</p>
                    <button @click="search = ''; selectedSector = 'all'" class="mt-8 text-xs font-bold text-stitch-secondary uppercase tracking-widest hover:underline">Ver todas las empresas</button>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
