<x-app-layout>
    <!-- Premium Header Hero -->
    <div class="bg-stitch-primary pt-16 pb-32 overflow-hidden relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div>
                    <h1 class="font-lexend text-4xl md:text-5xl font-black text-white mb-4">
                        Centro de Control
                    </h1>
                    <p class="text-white/70 text-lg max-w-xl font-medium leading-relaxed">
                        Bienvenido, <span class="text-white font-bold">{{ Auth::user()->name }}</span>. Aquí tienes una visión general del impacto de Pasantías Digitales en la comunidad estudiantil.
                    </p>
                </div>
                <div class="flex items-center gap-4">
                    <span class="px-4 py-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full text-white text-xs font-bold uppercase tracking-widest">
                        Admin Analytics
                    </span>
                    <div class="w-12 h-12 bg-stitch-secondary rounded-2xl flex items-center justify-center text-white shadow-lg shadow-stitch-secondary/20 animate-pulse">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                </div>
            </div>
        </div>
        <!-- Decorative Background Shapes -->
        <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute -left-20 -top-20 w-80 h-80 bg-stitch-secondary/10 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 -mt-16 pb-20 relative z-20">
        <!-- KPI Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <!-- Estudiantes KPI -->
            <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 group hover:-translate-y-2 transition-all duration-300">
                <div class="flex justify-between items-start mb-6">
                    <div class="p-4 bg-blue-50 rounded-2xl text-blue-600 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <span class="text-[10px] font-black text-blue-500 bg-blue-50 px-3 py-1 rounded-full uppercase tracking-tighter">Total Activos</span>
                </div>
                <h3 class="text-5xl font-black text-stitch-primary mb-2">{{ $stats['total_students'] }}</h3>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Estudiantes Inscritos</p>
            </div>

            <!-- Mentores KPI -->
            <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 group hover:-translate-y-2 transition-all duration-300">
                <div class="flex justify-between items-start mb-6">
                    <div class="p-4 bg-amber-50 rounded-2xl text-amber-600 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <span class="text-[10px] font-black text-amber-500 bg-amber-50 px-3 py-1 rounded-full uppercase tracking-tighter">Guías Expertos</span>
                </div>
                <h3 class="text-5xl font-black text-stitch-secondary mb-2">{{ $stats['total_mentors'] }}</h3>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Mentores Registrados</p>
            </div>

            <!-- Tareas KPI -->
            <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 group hover:-translate-y-2 transition-all duration-300">
                <div class="flex justify-between items-start mb-6">
                    <div class="p-4 bg-emerald-50 rounded-2xl text-emerald-600 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-[10px] font-black text-emerald-500 bg-emerald-50 px-3 py-1 rounded-full uppercase tracking-tighter">Entregas Hoy</span>
                </div>
                <h3 class="text-5xl font-black text-emerald-500 mb-2">{{ $stats['total_tasks'] }}</h3>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Tareas Completadas</p>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            
            <!-- Vocational Chart Section -->
            <div class="lg:col-span-3 bg-white p-10 md:p-12 rounded-[3rem] shadow-xl shadow-slate-200/40 border border-slate-100">
                <div class="flex items-center justify-between mb-10">
                    <div>
                        <h4 class="font-lexend text-2xl font-bold text-stitch-primary">Distribución Vocacional</h4>
                        <p class="text-sm text-gray-400 mt-1">Preferencias por áreas académicas</p>
                    </div>
                    <div class="flex gap-2">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                        <div class="w-3 h-3 bg-amber-500 rounded-full"></div>
                        <div class="w-3 h-3 bg-violet-500 rounded-full"></div>
                    </div>
                </div>
                
                <div class="relative h-80 flex items-center justify-center">
                    <canvas id="vocationalChart"></canvas>
                    <!-- Center Metric -->
                    <div class="absolute flex flex-col items-center justify-center pointer-events-none">
                        <span class="text-4xl font-black text-stitch-primary">{{ array_sum($vocationalDistribution->toArray()) }}</span>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Tests Totales</span>
                    </div>
                </div>

                <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($vocationalDistribution as $label => $total)
                        @php
                            $colors = match($label) {
                                'Ingeniería y Tecnología' => ['bg' => 'bg-blue-500', 'text' => 'text-blue-600', 'soft' => 'bg-blue-50'],
                                'Salud y Bienestar' => ['bg' => 'bg-emerald-500', 'text' => 'text-emerald-600', 'soft' => 'bg-emerald-50'],
                                'Negocios y Sociales' => ['bg' => 'bg-amber-500', 'text' => 'text-amber-600', 'soft' => 'bg-amber-50'],
                                'Artes y Educación' => ['bg' => 'bg-violet-500', 'text' => 'text-violet-600', 'soft' => 'bg-violet-50'],
                                default => ['bg' => 'bg-slate-500', 'text' => 'text-slate-600', 'soft' => 'bg-slate-50']
                            };
                        @endphp
                        <div class="p-4 {{ $colors['soft'] }} rounded-2xl">
                            <p class="text-[10px] font-black {{ $colors['text'] }} uppercase tracking-widest mb-1">{{ explode(' ', $label)[0] }}</p>
                            <p class="text-xl font-black text-stitch-primary">{{ $total }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Activity List -->
            <div class="lg:col-span-2 bg-white p-10 md:p-12 rounded-[3rem] shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden relative">
                <h4 class="font-lexend text-2xl font-bold text-stitch-primary mb-10 flex items-center gap-3">
                    Usuarios Recientes
                </h4>
                
                <div class="space-y-8 relative z-10">
                    @foreach($recentUsers as $user)
                        <div class="flex items-center justify-between group transition-all">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center text-stitch-primary font-black shadow-sm group-hover:bg-stitch-primary group-hover:text-white transition-all">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-stitch-primary group-hover:text-stitch-secondary transition-colors">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-400 font-medium">{{ $user->email }}</p>
                                </div>
                            </div>
                            <span class="text-[9px] font-black px-3 py-1.5 rounded-full uppercase tracking-tighter border {{ $user->user_type === 'estudiante' ? 'border-blue-100 text-blue-500 bg-blue-50' : 'border-amber-100 text-amber-500 bg-amber-50' }}">
                                {{ $user->user_type }}
                            </span>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    <a href="{{ route('usuarios.index') }}" class="flex items-center justify-center gap-3 w-full py-5 bg-stitch-primary text-white rounded-[1.5rem] text-xs font-bold uppercase tracking-widest hover:bg-stitch-secondary transition-all shadow-lg shadow-stitch-primary/20 group">
                        Ver Directorio Completo
                        <svg class="w-4 h-4 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('vocationalChart').getContext('2d');
            const data = {
                labels: {!! json_encode($vocationalDistribution->keys()) !!},
                datasets: [{
                    data: {!! json_encode($vocationalDistribution->values()) !!},
                    backgroundColor: [
                        '#3B82F6', // Ingeniería
                        '#10B981', // Salud
                        '#F59E0B', // Negocios
                        '#8B5CF6'  // Artes
                    ],
                    hoverOffset: 20,
                    borderWidth: 8,
                    borderColor: '#ffffff',
                    borderRadius: 10
                }]
            };

            new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            padding: 16,
                            titleFont: { size: 14, family: 'Lexend', weight: 'bold' },
                            bodyFont: { size: 13, family: 'Lexend' },
                            cornerRadius: 12,
                            displayColors: true
                        }
                    },
                    cutout: '82%'
                }
            });
        });
    </script>
</x-app-layout>
