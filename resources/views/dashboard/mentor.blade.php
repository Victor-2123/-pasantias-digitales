<x-app-layout>
    <div class="py-12" x-data="{ openTaskModal: false }">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-8">
                
                <!-- Main Content -->
                <div class="lg:col-span-8 space-y-8">
                    <!-- Welcome Hero -->
                    <div class="p-10 rounded-[2rem] bg-stitch-primary text-white relative overflow-hidden shadow-2xl">
                        <div class="relative z-10 space-y-4">
                            <h1 class="font-lexend text-4xl font-bold">¡Hola, {{ explode(' ', auth()->user()->name)[0] ?? 'Estudiante' }}!</h1>
                            <p class="text-lg text-white/80 max-w-md">No tienes ningún curso creado.</p>
                            <div class="pt-4 flex gap-4">
                                <a href="#" class="px-6 py-2.5 bg-white text-stitch-primary rounded-stitch font-bold text-sm hover:bg-white/90 transition-colors">+ Crear curso nuevo</a>
                            </div>
                        </div>
                        <!-- Abstract decoration -->
                        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-stitch-secondary/20 rounded-full blur-3xl"></div>
                        <div class="absolute right-10 top-10 w-24 h-24 border-4 border-white/10 rounded-full"></div>
                    </div>

                    <!-- Quick Stats (KPIs) -->
                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-white p-6 rounded-stitch border border-stitch-outline/10 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition-transform">
                            <div class="w-12 h-12 rounded-full bg-[#E3F2FD] text-[#1976D2] flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-stitch-on-surface-variant font-medium">Estudiantes</p>
                                <h3 class="text-xl font-bold text-stitch-primary">0</h3>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-stitch border border-stitch-outline/10 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition-transform">
                            <div class="w-12 h-12 rounded-full bg-[#F3E5F5] text-[#8E24AA] flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-stitch-on-surface-variant font-medium">Cursos Activos</p>
                                <h3 class="text-xl font-bold text-stitch-primary">0</h3>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-stitch border border-stitch-outline/10 shadow-sm flex items-center gap-4 hover:-translate-y-1 transition-transform">
                            <div class="w-12 h-12 rounded-full bg-[#FFF8E1] text-[#FFA000] flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-stitch-on-surface-variant font-medium">Calificación</p>
                                <h3 class="text-xl font-bold text-stitch-primary">- / 5</h3>
                            </div>
                        </div>
                    </div>

                    <!-- Active Challenges -->
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <h2 class="font-lexend text-2xl font-bold text-stitch-primary">Mis cursos</h2>
                            <a href="#" class="text-sm font-bold text-stitch-secondary hover:underline flex items-center gap-1">Ver todos <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg></a>
                        </div>

                        <div class="bg-white p-8 rounded-stitch border border-stitch-outline/10 shadow-sm text-center flex flex-col items-center justify-center py-12">
                            <div class="w-16 h-16 bg-stitch-background rounded-full flex items-center justify-center mb-4 text-stitch-on-surface-variant">
                                <svg class="w-8 h-8 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <p class="text-stitch-on-surface-variant italic">No hay cursos disponibles.</p>
                        </div>
                    </div>


                </div>

                <!-- Sidebar / Next Deliveries -->
                <div class="lg:col-span-4 space-y-8 sticky top-8 self-start">
                    <!-- To-Do tasks -->
                    <div class="bg-white p-8 rounded-stitch border border-stitch-outline/10 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="font-lexend text-xl font-bold text-stitch-primary">Entregas Pendientes</h2>
                            <span class="bg-[#FEE2E2] text-[#DC2626] text-xs font-bold px-2 py-1 rounded-full">0 nuevas</span>
                        </div>
                        <div class="p-6 rounded-stitch bg-stitch-background text-center py-8">
                            <p class="text-stitch-on-surface-variant italic text-sm">No tienes tareas por calificar en este momento.</p>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white p-8 rounded-stitch border border-stitch-outline/10 shadow-sm">
                        <h2 class="font-lexend text-xl font-bold text-stitch-primary mb-6">Actividad Reciente</h2>
                        
                        <div class="relative pl-4 space-y-6 before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-stitch-outline/20 before:to-transparent">
                            
                            <!-- Empty State for Activity -->
                            <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group border-l-2 border-transparent p-2 text-center w-full">
                                <p class="text-stitch-on-surface-variant italic text-sm w-full text-center py-2">No hay actividad reciente.</p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
</x-app-layout>
