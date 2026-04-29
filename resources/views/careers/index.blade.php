<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="space-y-12">
                <div class="max-w-3xl">
                    <h1 class="font-lexend text-4xl font-bold text-stitch-primary mb-4">Catálogo de Carreras</h1>
                    <p class="text-stitch-on-surface-variant text-lg">
                        Explora carreras profesionales, conoce el día a día de expertos en la industria y encuentra el mentor perfecto para guiar tu ambición.
                    </p>
                </div>

                <div class="max-w-4xl mx-auto">
                    <div class="bg-white p-8 md:p-12 rounded-stitch border border-stitch-outline/10 shadow-sm">

                        <div class="mb-10 pb-6 border-b border-stitch-outline/10">
                            <h2 class="font-lexend text-2xl md:text-3xl font-bold text-stitch-primary">Zona Metropolitana</h2>
                            <p class="text-stitch-on-surface-variant text-base mt-2">Tampico, Madero y Altamira</p>
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
                            {{-- Dynamic groups from database --}}
                            @forelse($grouped as $categoryKey => $careers)
                                @php $meta = $categoryMeta[$categoryKey] ?? ['label' => $categoryKey, 'colorClass' => 'text-stitch-primary', 'dotClass' => 'bg-stitch-primary/50']; @endphp
                                <div>
                                    <h3 class="text-xs md:text-sm font-bold {{ $meta['colorClass'] }} uppercase tracking-wider mb-6">
                                        {{ $meta['label'] }}
                                    </h3>
                                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 text-sm md:text-base text-stitch-on-surface-variant">
                                        @foreach($careers as $career)
                                            <li class="flex items-center gap-2">
                                                <div class="w-1.5 h-1.5 rounded-full {{ $meta['dotClass'] }}"></div>
                                                <a href="{{ route('careers.show', $career->slug) }}"
                                                   class="hover:text-stitch-primary hover:underline transition-colors">
                                                    {{ $career->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @empty
                                {{-- Fallback if DB is empty --}}
                                <p class="text-stitch-on-surface-variant italic text-center py-8">
                                    No hay carreras disponibles. Ejecuta el seeder para cargar el catálogo.
                                </p>
                            @endforelse
                        </div>

                    </div>
                </div>

                <!-- Call to Action -->
                <div class="bg-stitch-primary-container p-12 rounded-[2rem] text-center text-white relative overflow-hidden">
                    <div class="relative z-10 space-y-6">
                        <h2 class="font-lexend text-3xl font-bold">¿No estás seguro por dónde empezar?</h2>
                        <p class="text-white/80 max-w-2xl mx-auto">Realiza nuestro test de habilidades de 5 minutos para encontrar las carreras que mejor se adaptan a tus intereses y fortalezas naturales.</p>
                        <a href="{{ route('vocacional.test') }}" id="btn-realizar-test"
                           class="inline-block px-8 py-3 bg-stitch-secondary text-white rounded-stitch font-bold hover:scale-105 transition-transform">
                            Realizar Test de Habilidades
                        </a>
                    </div>
                    <div class="absolute -left-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
