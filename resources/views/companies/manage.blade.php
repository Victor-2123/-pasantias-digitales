<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
                <div>
                    <h1 class="font-lexend text-4xl font-bold text-stitch-primary">Gestionar Empresas</h1>
                    <p class="text-stitch-on-surface-variant mt-2">Administra el catálogo de aliados estratégicos y patrocinadores.</p>
                </div>
                <a href="{{ route('companies.create') }}" class="inline-flex items-center gap-2 px-6 py-4 bg-stitch-primary text-white rounded-2xl font-bold hover:bg-stitch-secondary transition-all shadow-lg shadow-stitch-primary/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    Nueva Empresa
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
                            <th class="px-8 py-5">Empresa</th>
                            <th class="px-8 py-5">Sector</th>
                            <th class="px-8 py-5">Sitio Web</th>
                            <th class="px-8 py-5 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 text-stitch-primary font-bold">
                        @forelse($companies as $company)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center p-2">
                                            @if($company->logo && Storage::disk('public')->exists($company->logo))
                                                <img src="{{ asset('storage/' . $company->logo) }}" class="w-full h-full object-contain">
                                            @else
                                                <span class="text-xl">🏢</span>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold">{{ $company->name }}</p>
                                            <p class="text-[10px] text-gray-400 uppercase tracking-tighter">{{ $company->slug }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-xs px-3 py-1 bg-stitch-primary/5 text-stitch-primary rounded-full">{{ $company->sector }}</span>
                                </td>
                                <td class="px-8 py-6">
                                    @if($company->website)
                                        <a href="{{ $company->website }}" target="_blank" class="text-xs text-blue-500 hover:underline flex items-center gap-1">
                                            {{ parse_url($company->website, PHP_URL_HOST) }}
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        </a>
                                    @else
                                        <span class="text-xs text-gray-300">No disponible</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('companies.edit', $company) }}" class="p-2 text-slate-400 hover:text-stitch-primary transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('companies.destroy', $company) }}" method="POST" onsubmit="return confirm('¿Eliminar esta empresa?')">
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
                                <td colspan="4" class="px-8 py-20 text-center text-gray-400 font-medium">No hay empresas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
