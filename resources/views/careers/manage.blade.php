<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
                <div>
                    <h1 class="font-lexend text-4xl font-bold text-stitch-primary">Gestionar Carreras</h1>
                    <p class="text-stitch-on-surface-variant mt-2">Administra el catálogo de perfiles profesionales disponibles.</p>
                </div>
                <a href="{{ route('careers.create') }}" class="inline-flex items-center gap-2 px-6 py-4 bg-stitch-primary text-white rounded-2xl font-bold hover:bg-stitch-secondary transition-all shadow-lg shadow-stitch-primary/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    Nueva Carrera
                </a>
            </div>

            @if(session('success'))
                <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-2xl font-bold flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-[10px] font-black uppercase tracking-widest text-gray-400">
                            <th class="px-8 py-5">Carrera</th>
                            <th class="px-8 py-5">Categoría</th>
                            <th class="px-8 py-5">Tagline</th>
                            <th class="px-8 py-5 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 text-stitch-primary font-bold">
                        @forelse($careers as $career)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white shadow-sm" style="background-color: {{ $career->color }}">
                                            @if($career->icon && Storage::disk('public')->exists($career->icon))
                                                <img src="{{ asset('storage/' . $career->icon) }}" class="w-7 h-7 object-contain">
                                            @else
                                                <span class="text-xl">🎓</span>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold">{{ $career->name }}</p>
                                            <p class="text-[10px] text-gray-400 uppercase tracking-tighter">{{ $career->slug }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-xs px-3 py-1 bg-slate-100 rounded-full text-slate-500">{{ $career->category }}</span>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-xs text-gray-400 max-w-xs truncate">{{ $career->tagline }}</p>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('careers.edit', $career) }}" class="p-2 text-slate-400 hover:text-stitch-primary transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('careers.destroy', $career) }}" method="POST" onsubmit="return confirm('¿Eliminar esta carrera? Esto puede afectar a los retos vinculados.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center text-gray-400 font-medium">No hay carreras registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
