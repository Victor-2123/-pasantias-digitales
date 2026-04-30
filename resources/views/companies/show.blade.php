<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Back link --}}
            <a href="{{ route('companies.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-stitch-on-surface-variant hover:text-stitch-primary transition-colors mb-8">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Todas las empresas
            </a>

            {{-- Company hero --}}
            <div class="bg-stitch-primary rounded-[2rem] p-10 text-white mb-10 relative overflow-hidden shadow-2xl">
                <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center gap-6">
                    <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center text-4xl flex-shrink-0">
                        {{ $company->logo ?? '🏢' }}
                    </div>
                    <div>
                        @if($company->sector)
                            <span class="text-xs font-bold bg-white/20 px-3 py-1 rounded-full mb-2 inline-block">{{ $company->sector }}</span>
                        @endif
                        <h1 class="font-lexend text-4xl font-bold">{{ $company->name }}</h1>
                        @if($company->description)
                            <p class="text-white/80 mt-2 max-w-xl text-sm leading-relaxed">{{ $company->description }}</p>
                        @endif
                        @if($company->website)
                            <a href="{{ $company->website }}" target="_blank"
                               class="mt-3 inline-flex items-center gap-1.5 text-xs font-bold bg-white/20 hover:bg-white/30 px-3 py-1.5 rounded-full transition-colors">
                                🌐 Visitar sitio web
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Challenges list --}}
            <h2 class="font-lexend text-2xl font-bold text-stitch-primary mb-6">
                Desafíos patrocinados por {{ $company->name }}
            </h2>

            @if($challenges->isEmpty())
                <div class="bg-white rounded-[1.5rem] border border-gray-100 shadow-sm p-12 text-center">
                    <div class="text-5xl mb-4">🔭</div>
                    <p class="text-stitch-on-surface-variant italic">Esta empresa aún no tiene desafíos publicados.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($challenges as $challenge)
                        <div class="bg-white rounded-[1.25rem] border border-gray-100 shadow-sm p-6 flex flex-col sm:flex-row sm:items-center gap-4 hover:shadow-md transition-shadow">
                            <div class="flex-1">
                                <div class="flex flex-wrap items-center gap-2 mb-1">
                                    @if($challenge->career)
                                        <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-stitch-primary/10 text-stitch-primary">
                                            {{ $challenge->career->name ?? $challenge->career->title ?? 'Área' }}
                                        </span>
                                    @endif
                                    @if($challenge->difficulty)
                                        <span class="text-xs font-semibold text-gray-400">{{ ucfirst($challenge->difficulty) }}</span>
                                    @endif
                                </div>
                                <h3 class="font-lexend font-bold text-stitch-primary text-lg">{{ $challenge->title }}</h3>
                                @if($challenge->description)
                                    <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $challenge->description }}</p>
                                @endif
                            </div>
                            @auth
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center gap-2 px-5 py-2.5 bg-stitch-primary text-white text-xs font-bold rounded-stitch cursor-default">
                                        Ver Desafío
                                    </span>
                                </div>
                            @endauth
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
