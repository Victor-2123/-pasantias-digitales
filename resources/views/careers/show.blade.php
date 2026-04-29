<x-app-layout>
    @php
        $colorMap = [
            'blue'    => ['bg' => 'bg-stitch-primary',    'light' => 'bg-blue-50',    'text' => 'text-stitch-primary',   'badge' => 'bg-blue-100 text-blue-800',   'border' => 'border-blue-200'],
            'emerald' => ['bg' => 'bg-emerald-600',        'light' => 'bg-emerald-50', 'text' => 'text-emerald-700',      'badge' => 'bg-emerald-100 text-emerald-800','border' => 'border-emerald-200'],
            'amber'   => ['bg' => 'bg-amber-500',          'light' => 'bg-amber-50',   'text' => 'text-amber-700',        'badge' => 'bg-amber-100 text-amber-800',  'border' => 'border-amber-200'],
            'violet'  => ['bg' => 'bg-violet-600',         'light' => 'bg-violet-50',  'text' => 'text-violet-700',       'badge' => 'bg-violet-100 text-violet-800','border' => 'border-violet-200'],
        ];
        $c = $colorMap[$career->color] ?? $colorMap['blue'];

        $categoryLabels = [
            'A' => 'Ingeniería y Tecnología',
            'B' => 'Salud y Bienestar',
            'C' => 'Negocios y Ciencias Sociales',
            'D' => 'Artes, Diseño y Educación',
        ];
    @endphp

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-6 lg:px-8 space-y-8">

            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-stitch-on-surface-variant">
                <a href="{{ route('careers.index') }}" class="hover:text-stitch-primary transition-colors font-medium">Catálogo</a>
                <svg class="w-4 h-4 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="font-semibold {{ $c['text'] }}">{{ $career->name }}</span>
            </nav>

            {{-- Hero Card --}}
            <div class="{{ $c['bg'] }} rounded-[2rem] p-10 text-white relative overflow-hidden shadow-2xl">
                <div class="relative z-10 flex flex-col md:flex-row md:items-center gap-6">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center text-4xl flex-shrink-0">
                        {{ $career->icon }}
                    </div>
                    <div>
                        <span class="inline-block px-3 py-1 bg-white/20 text-white/90 rounded-full text-xs font-bold uppercase tracking-wider mb-3">
                            {{ $categoryLabels[$career->category] ?? 'General' }}
                        </span>
                        <h1 class="font-lexend text-3xl md:text-4xl font-bold leading-tight">{{ $career->name }}</h1>
                        @if($career->tagline)
                            <p class="text-white/80 text-lg mt-2 max-w-xl">{{ $career->tagline }}</p>
                        @endif
                    </div>
                </div>
                {{-- Decorative blobs --}}
                <div class="absolute -right-8 -bottom-8 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute right-24 top-4 w-20 h-20 border-4 border-white/10 rounded-full"></div>
            </div>

            {{-- Description Card --}}
            <div class="bg-white rounded-stitch border border-stitch-outline/10 shadow-sm p-8 space-y-4">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 {{ $c['light'] }} {{ $c['text'] }} rounded-lg flex items-center justify-center font-bold text-lg">ℹ</div>
                    <h2 class="font-lexend text-xl font-bold text-stitch-primary">Acerca de esta carrera</h2>
                </div>
                <p class="text-stitch-on-surface-variant leading-relaxed text-base">
                    {{ $career->description ?? 'Esta carrera ofrece una sólida formación profesional con salidas laborales de alta demanda en el mercado regional y nacional.' }}
                </p>
            </div>

            {{-- Challenges / Retos --}}
            @if($career->challenges->count())
                <div class="bg-white rounded-stitch border border-stitch-outline/10 shadow-sm p-8">
                    <h2 class="font-lexend text-xl font-bold text-stitch-primary mb-6 flex items-center gap-3">
                        <span class="text-2xl">🎯</span> Retos Disponibles
                    </h2>
                    <div class="space-y-4">
                        @foreach($career->challenges as $challenge)
                            <div class="flex items-start gap-4 p-5 rounded-stitch {{ $c['light'] }} border {{ $c['border'] }} hover:shadow-sm transition-shadow">
                                <div class="w-10 h-10 {{ $c['bg'] }} text-white rounded-lg flex items-center justify-center flex-shrink-0 font-bold text-sm">
                                    {{ $loop->iteration }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold {{ $c['text'] }} text-sm leading-snug">{{ $challenge->title }}</h3>
                                    <p class="text-xs text-stitch-on-surface-variant mt-1 leading-relaxed">{{ Str::limit($challenge->description, 120) }}</p>
                                    <span class="inline-block mt-2 px-2 py-0.5 {{ $c['badge'] }} rounded-full text-xs font-bold">
                                        {{ $challenge->difficulty }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- CTA --}}
            <div class="flex flex-col sm:flex-row gap-4 pb-8">
                <a href="{{ route('careers.index') }}"
                   class="flex-1 px-6 py-3.5 border-2 border-stitch-primary text-stitch-primary font-bold rounded-stitch text-center hover:bg-stitch-primary hover:text-white transition-all duration-200">
                    ← Ver todas las carreras
                </a>
                <a href="{{ route('vocacional.test') }}"
                   class="flex-1 px-6 py-3.5 {{ $c['bg'] }} text-white font-bold rounded-stitch text-center hover:scale-105 hover:shadow-md transition-all duration-200">
                    🧭 Hacer el Test Vocacional
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
