<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @if(Auth::user()->user_type === 'maestro')
                <div class="bg-white p-16 text-center rounded-[2rem] border border-stitch-outline/10 shadow-xl mt-8 flex flex-col items-center">
                    <div class="w-24 h-24 bg-stitch-background rounded-full flex items-center justify-center mb-6 text-[#1976D2]">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h2 class="font-lexend text-2xl font-bold text-stitch-primary mb-4">Sección en construcción</h2>
                    <p class="text-stitch-on-surface-variant max-w-lg">Aún no hemos configurado el apartado de "Mis Retos" para el panel de administración de los mentores. Estamos trabajando en ello.</p>
                    <a href="{{ route('dashboard.mentor') }}" class="mt-8 px-6 py-3 bg-stitch-primary text-white rounded-stitch font-bold text-sm hover:opacity-90 transition-opacity">Volver al Inicio</a>
                </div>
            @else
                <div class="mb-8 flex items-end justify-between">
                <div>
                    <h1 class="font-lexend text-3xl font-bold text-stitch-primary">Mis Cursos</h1>
                    <p class="text-stitch-on-surface-variant mt-2">Gestiona tu aprendizaje y completa tus tareas pendientes.</p>
                </div>
            </div>

            <div class="grid lg:grid-cols-12 gap-8">
                <!-- Course List (Left Column) -->
                <div class="lg:col-span-8 space-y-6">
                    <!-- Course Card: Redes -->
                    <div class="bg-white rounded-stitch border border-stitch-outline/10 shadow-sm overflow-hidden flex flex-col md:flex-row group transition-all hover:shadow-md">
                        <div class="md:w-64 bg-stitch-primary relative overflow-hidden flex-shrink-0 min-h-[200px]">
                            <!-- Abstract Graphic -->
                            <div class="absolute top-[-20px] -right-4 w-32 h-32 bg-stitch-secondary/30 rounded-full blur-2xl"></div>
                            <div class="absolute bottom-[-10px] -left-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                            
                            <div class="relative z-10 w-full h-full flex flex-col items-center justify-center p-6 text-center text-white">
                                <svg class="w-12 h-12 mb-3 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                <span class="font-lexend font-bold text-xl tracking-wide">Redes</span>
                            </div>
                        </div>

                        <div class="p-6 md:p-8 flex flex-col justify-between flex-grow">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <h2 class="font-lexend text-2xl font-bold text-stitch-primary group-hover:text-stitch-secondary transition-colors">Redes</h2>
                                    <span class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-xs font-bold uppercase tracking-wider">Activo</span>
                                </div>
                                <p class="text-stitch-on-surface-variant text-sm leading-relaxed mb-6">
                                    En este curso aprenderás desde los fundamentos de la comunicación de datos hasta la configuración avanzada de routers y switches. Diseñado para quienes buscan certificarse y gestionar infraestructuras de red robustas, escalables y seguras en entornos empresariales modernos.
                                </p>
                            </div>

                            <!-- Course Progress/Details -->
                            <div class="flex items-center gap-6 mt-auto pt-4 border-t border-stitch-outline/10">
                                <div class="flex-1">
                                    <div class="flex justify-between text-xs text-stitch-on-surface font-semibold mb-1">
                                        <span>Progreso general</span>
                                        <span>0%</span>
                                    </div>
                                    <div class="w-full h-1.5 bg-stitch-background rounded-full overflow-hidden">
                                        <div class="h-full bg-stitch-secondary w-0 rounded-full"></div>
                                    </div>
                                </div>
                                <a href="#" class="px-6 py-2.5 bg-stitch-primary text-white rounded-stitch font-bold text-sm hover:opacity-90 transition-opacity whitespace-nowrap">
                                    Ir al aula
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Assignments Sidebar (Right Column) -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-white p-6 md:p-8 rounded-stitch border border-stitch-outline/10 shadow-sm sticky top-8 self-start">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-stitch-secondary/10 rounded-stitch flex items-center justify-center text-stitch-secondary">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                            </div>
                            <h2 class="font-lexend text-lg font-bold text-stitch-primary">Tareas Pendientes</h2>
                        </div>
                        
                        <div class="space-y-4">
                            <!-- Assignment Item -->
                            <div class="p-4 rounded-stitch border border-stitch-outline/10 hover:border-stitch-secondary/30 transition-colors cursor-pointer group">
                                <div class="flex items-start gap-3">
                                    <div class="mt-1">
                                        <div class="w-5 h-5 rounded border-2 border-stitch-outline/30 group-hover:border-stitch-secondary flex items-center justify-center transition-colors"></div>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-sm text-stitch-primary mb-1 group-hover:text-stitch-secondary transition-colors">Enlistar los componentes de una red y una pc</h4>
                                        <p class="text-xs text-stitch-on-surface-variant flex items-center gap-1 mt-2">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                                            De: Redes
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
