<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-16">
                <h1 class="font-lexend text-4xl font-extrabold text-stitch-primary mb-10">Empresas Participantes</h1>
                <p class="text-gray-500 text-base max-w-xl leading-relaxed">
                    Conecta con organizaciones líderes de la industria que están buscando talento e innovación. Explora
                    sus desafíos actuales y descubre cómo puedes contribuir a su crecimiento mientras impulsas tu
                    propia carrera profesional.
                </p>
            </div>

            @if($companies->isEmpty())
                <div class="text-center py-24 bg-white rounded-3xl border border-gray-100 shadow-sm">
                    <div class="text-6xl mb-4">🏢</div>
                    <p class="text-gray-400 italic">Aún no hay empresas registradas.</p>
                </div>
            @else
                {{-- 2-Column Card Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($companies as $company)
                        @php
                            $sectorStyles = [
                                'Tecnología'          => ['border' => '#3B82F6', 'badge_bg' => '#EFF6FF', 'badge_text' => '#2563EB', 'link' => '#2563EB', 'icon_bg' => '#F1F5F9'],
                                'Salud'               => ['border' => '#10B981', 'badge_bg' => '#ECFDF5', 'badge_text' => '#059669', 'link' => '#059669', 'icon_bg' => '#F1F5F9'],
                                'Finanzas'            => ['border' => '#F59E0B', 'badge_bg' => '#FFFBEB', 'badge_text' => '#D97706', 'link' => '#D97706', 'icon_bg' => '#F1F5F9'],
                                'Diseño & Creatividad'=> ['border' => '#8B5CF6', 'badge_bg' => '#F5F3FF', 'badge_text' => '#7C3AED', 'link' => '#7C3AED', 'icon_bg' => '#F1F5F9'],
                            ];
                            $s = $sectorStyles[$company->sector] ?? ['border' => '#6B7280', 'badge_bg' => '#F9FAFB', 'badge_text' => '#374151', 'link' => '#374151', 'icon_bg' => '#F1F5F9'];
                        @endphp

                        <a href="{{ route('companies.show', $company->slug) }}"
                           class="group bg-white rounded-3xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden flex flex-col"
                           style="border-top: 4px solid {{ $s['border'] }};">

                            <div class="p-10 flex flex-col flex-1 space-y-6">

                                {{-- Card Header: icon + sector badge --}}
                                <div class="flex justify-between items-start">
                                    <div class="rounded-2xl p-4 text-3xl" style="background-color: {{ $s['icon_bg'] }};">
                                        {{ $company->logo ?? '🏢' }}
                                    </div>
                                    @if($company->sector)
                                        <span class="text-xs font-bold px-5 py-3 rounded-full uppercase tracking-wide mt-2"
                                              style="background-color: {{ $s['badge_bg'] }}; color: {{ $s['badge_text'] }};">
                                            {{ $company->sector }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Card Body --}}
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900 mb-3 group-hover:opacity-80 transition-opacity">
                                        {{ $company->name }}
                                    </h2>
                                    <p class="text-sm text-gray-500 leading-relaxed line-clamp-3">
                                        {{ $company->description ?? 'Empresa aliada de Pasantías Digitales.' }}
                                    </p>
                                </div>

                                {{-- Card Footer --}}
                                <div class="pt-2 flex-1 flex items-end justify-between">
                                    <span class="text-xs font-semibold text-gray-400">
                                        {{ $company->challenges->count() }}
                                        {{ $company->challenges->count() === 1 ? 'desafío' : 'desafíos' }}
                                    </span>
                                    <span class="inline-flex items-center gap-1 text-sm font-semibold transition-colors"
                                          style="color: {{ $s['link'] }};">
                                        Ver Desafíos
                                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </div>

                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
