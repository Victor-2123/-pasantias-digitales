<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $user->name }} | Portafolio Profesional</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        lexend: ['Lexend', 'sans-serif'],
                        inter: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'stitch-primary': '#0f172a',
                        'stitch-secondary': '#3b82f6',
                        'stitch-accent': '#10b981',
                        'stitch-background': '#f1f5f9',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-stitch-background font-inter text-slate-800 antialiased">
    
    <!-- Decorative Background Elements -->
    <div class="fixed top-0 left-0 w-full h-80 bg-stitch-primary z-0">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
        <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-stitch-background to-transparent"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 py-8 lg:py-12 relative z-10">
        
        <!-- Back Navigation -->
        <div class="mb-10">
            <a href="{{ url()->previous() == url()->current() ? route('portfolio.index') : url()->previous() }}" class="inline-flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-white/70 hover:text-white transition-colors group">
                <div class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                </div>
                Regresar
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <!-- Left Side: Profile Info -->
            <div class="lg:col-span-4 space-y-8">
                <!-- Profile Card -->
                <div class="bg-white rounded-[3rem] p-8 shadow-2xl shadow-slate-900/10 border border-white overflow-hidden relative group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-stitch-secondary/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-2xl"></div>
                    
                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div class="w-40 h-40 rounded-[2.5rem] bg-slate-50 overflow-hidden shadow-2xl border-8 border-slate-50 mb-6 group-hover:scale-105 transition-transform duration-500">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-200">
                                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                </div>
                            @endif
                        </div>

                        <h1 class="font-lexend text-3xl font-black text-stitch-primary mb-2 tracking-tight">{{ $user->name }}</h1>
                        
                        @if($vocationalResult)
                            <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-emerald-100 mb-6">
                                {{ $vocationalResult->dominant_area }}
                            </span>
                        @endif

                        <div class="w-full pt-6 border-t border-slate-50 space-y-4">
                            <div class="flex items-center gap-3 px-4 py-3 bg-slate-50 rounded-2xl border border-slate-100">
                                <svg class="w-4 h-4 text-stitch-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-10V4a1 1 0 011-1h2a1 1 0 011 1v3M12 12h1m-1 4h1m-4 4h1m-1 4h1"></path></svg>
                                <span class="text-xs font-bold text-slate-600 truncate">{{ $user->school ?? 'Estudiante' }}</span>
                            </div>
                            <div class="flex items-center gap-3 px-4 py-3 bg-slate-50 rounded-2xl border border-slate-100">
                                <svg class="w-4 h-4 text-stitch-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span class="text-xs font-bold text-slate-600 truncate">{{ $user->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Verification Card -->
                <div class="bg-stitch-primary rounded-[3rem] p-8 text-white relative overflow-hidden group shadow-2xl shadow-slate-900/20">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-stitch-secondary/20 rounded-full -translate-y-1/2 translate-x-1/2 blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="relative z-10 text-center">
                        <div class="w-14 h-14 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center mx-auto mb-4 border border-white/10">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L1 21h22L12 2zm0 3.99L19.53 19H4.47L12 5.99zM11 16h2v2h-2v-2zm0-7h2v5h-2V9z"/></svg>
                        </div>
                        <p class="text-[10px] font-black uppercase tracking-[0.3em] opacity-50 mb-1">Perfil Verificado</p>
                        <h4 class="font-lexend font-bold text-xl">Pasantías Digitales</h4>
                    </div>
                </div>
            </div>

            <!-- Right Side: Content -->
            <div class="lg:col-span-8 space-y-10">
                <!-- Bio Section -->
                <div class="bg-white rounded-[3rem] p-10 shadow-xl shadow-slate-200/50 border border-white">
                    <h2 class="font-lexend text-2xl font-bold text-stitch-primary mb-6 flex items-center gap-3">
                        <span class="w-2 h-8 bg-stitch-secondary rounded-full"></span>
                        Sobre mí
                    </h2>
                    <p class="text-slate-500 leading-relaxed text-xl font-medium italic">
                        "{{ $user->bio ?? 'Buscando transformar el futuro a través de pasantías digitales y retos de la vida real.' }}"
                    </p>
                </div>

                <!-- Accomplishments -->
                <div class="space-y-6">
                    <h2 class="font-lexend text-2xl font-bold text-stitch-primary flex items-center gap-3 px-4">
                        <span class="w-2 h-8 bg-stitch-secondary rounded-full"></span>
                        Insignias Ganadas
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($completedPaths as $path)
                            <div class="bg-white p-8 rounded-[3rem] border border-white shadow-xl shadow-slate-200/30 flex items-center gap-6 group hover:scale-[1.02] transition-all cursor-default">
                                <div class="w-20 h-20 rounded-[1.5rem] bg-stitch-primary text-white flex items-center justify-center text-4xl shadow-xl group-hover:rotate-6 transition-transform">
                                    @if($path->icon)
                                        <img src="{{ asset('storage/' . $path->icon) }}" class="w-12 h-12 object-contain filter invert">
                                    @else
                                        🏆
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-lexend font-bold text-lg text-stitch-primary mb-1">{{ $path->title }}</h4>
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-stitch-accent animate-pulse"></span>
                                        <span class="text-[10px] font-black uppercase tracking-widest text-stitch-accent">Certificado</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-20 px-10 bg-slate-100/50 rounded-[3rem] border-4 border-dashed border-white text-center">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm text-slate-300">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Aún recolectando logros...</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Progress Tracker -->
                <div class="bg-white rounded-[3rem] p-10 shadow-xl shadow-slate-200/50 border border-white">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="font-lexend text-2xl font-bold text-stitch-primary flex items-center gap-3">
                            <span class="w-2 h-8 bg-stitch-secondary rounded-full"></span>
                            Nivel de Carrera
                        </h2>
                        <span class="text-3xl font-black text-stitch-secondary">{{ count($completedPaths) * 20 }}%</span>
                    </div>
                    
                    <div class="w-full h-6 bg-slate-100 rounded-full overflow-hidden p-1 shadow-inner">
                        <div class="h-full bg-gradient-to-r from-stitch-secondary to-blue-400 rounded-full shadow-lg relative" style="width: {{ count($completedPaths) * 20 }}%">
                            <div class="absolute top-0 left-0 w-full h-full bg-white/20 animate-pulse"></div>
                        </div>
                    </div>
                    <p class="mt-4 text-xs font-bold text-slate-400 text-center uppercase tracking-widest">Basado en rutas de aprendizaje completadas</p>
                </div>
            </div>
        </div>

        <footer class="mt-20 pb-10 text-center">
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.4em] opacity-60">Verified Portfolio Service • Pasantías Digitales 2026</p>
        </footer>
    </div>

</body>
</html>
