<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            
            <!-- Header -->
            <div class="mb-12 text-center max-w-2xl mx-auto">
                <h1 class="font-lexend text-4xl font-black text-stitch-primary mb-4 tracking-tight">Directorio de Talentos</h1>
                <p class="text-stitch-on-surface-variant text-lg">Conoce a los estudiantes que están transformando su futuro. Explora sus logros, insignias y perfiles profesionales.</p>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($students as $student)
                    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/40 overflow-hidden group transition-all hover:-translate-y-2">
                        <!-- Top Decor -->
                        <div class="h-24 bg-stitch-primary relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-stitch-secondary/20 rounded-full -translate-y-1/2 translate-x-1/2 blur-2xl"></div>
                        </div>

                        <!-- Content -->
                        <div class="px-8 pb-10 -mt-12 relative z-10 text-center">
                            <!-- Avatar -->
                            <div class="w-24 h-24 mx-auto rounded-[2rem] bg-white p-1.5 shadow-lg mb-4">
                                <div class="w-full h-full rounded-[1.5rem] bg-slate-100 overflow-hidden">
                                    @if($student->profile_photo)
                                        <img src="{{ asset('storage/' . $student->profile_photo) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <h3 class="font-lexend font-bold text-xl text-stitch-primary group-hover:text-stitch-secondary transition-colors line-clamp-1">{{ $student->name }}</h3>
                            <p class="text-xs font-medium text-slate-400 mb-6 truncate">{{ $student->school ?? 'Estudiante' }}</p>

                            <!-- Mini Badges or Info -->
                            <div class="flex items-center justify-center gap-2 mb-8">
                                @if($student->vocationalTestResult)
                                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-emerald-100">
                                        {{ $student->vocationalTestResult->dominant_area }}
                                    </span>
                                @endif
                                <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-blue-100">
                                    Activo
                                </span>
                            </div>

                            <a href="{{ route('portfolio.show', $student->username) }}" class="inline-flex items-center justify-center w-full py-4 bg-stitch-primary text-white rounded-2xl font-bold text-xs uppercase tracking-widest hover:bg-stitch-secondary transition-all shadow-lg shadow-stitch-primary/10">
                                Ver Perfil Completo
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 005.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h2 class="font-lexend text-2xl font-bold text-stitch-primary mb-2">No hay perfiles públicos todavía</h2>
                        <p class="text-slate-500">Sé el primero en hacer tu perfil público desde la configuración.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-16">
                {{ $students->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
