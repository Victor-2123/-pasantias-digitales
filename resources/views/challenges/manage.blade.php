<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
                <div>
                    <h1 class="font-lexend text-4xl font-bold text-stitch-primary">Gestionar Mis Retos</h1>
                    <p class="text-stitch-on-surface-variant mt-2">Crea y administra los desafíos para tus estudiantes.</p>
                </div>
                <a href="{{ route('challenges.create') }}" class="inline-flex items-center gap-2 px-6 py-4 bg-stitch-primary text-white rounded-2xl font-bold hover:bg-stitch-secondary transition-all shadow-lg shadow-stitch-primary/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    Nuevo Desafío
                </a>
            </div>

            @if(session('success'))
                <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-2xl font-bold flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($challenges as $challenge)
                    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col group hover:shadow-md transition-all">
                        <div class="flex justify-between items-start mb-6">
                            <span class="px-3 py-1 bg-stitch-primary/5 text-stitch-primary text-[10px] font-black uppercase tracking-widest rounded-full">
                                {{ $challenge->difficulty }}
                            </span>
                            <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('challenges.edit', $challenge) }}" class="p-2 text-slate-400 hover:text-stitch-primary transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('challenges.destroy', $challenge) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este reto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <h3 class="text-xl font-bold text-stitch-primary mb-3">{{ $challenge->title }}</h3>
                        <p class="text-gray-500 text-sm line-clamp-2 mb-6 flex-grow">
                            {{ strip_tags($challenge->description) }}
                        </p>

                        <div class="pt-6 border-t border-slate-50 flex items-center justify-between text-[10px] font-bold uppercase tracking-widest text-gray-400">
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-10V4a1 1 0 011-1h2a1 1 0 011 1v3M12 12h1m-1 4h1m-4 4h1m-1 4h1"></path></svg>
                                {{ $challenge->career->name }}
                            </span>
                            @if($challenge->expires_at)
                                <span class="text-amber-500">
                                    Vence: {{ $challenge->expires_at->format('d/m/Y') }}
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-stitch-primary">No tienes retos creados</h3>
                        <p class="text-gray-400 mt-2">Comienza creando tu primer desafío para los estudiantes.</p>
                        <a href="{{ route('challenges.create') }}" class="mt-8 inline-block text-stitch-primary font-black uppercase text-xs tracking-widest border-b-2 border-stitch-primary pb-1">Crear Reto Ahora</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
