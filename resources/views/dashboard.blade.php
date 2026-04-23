<x-app-layout>
    <div class="py-12" x-data="{ openTaskModal: false, fileName: '' }">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-8">
                
                <!-- Main Content -->
                <div class="lg:col-span-8 space-y-8">
                    <!-- Welcome Hero -->
                    <div class="p-10 rounded-[2rem] bg-stitch-primary text-white relative overflow-hidden shadow-2xl">
                        <div class="relative z-10 space-y-4">
                            <h1 class="font-lexend text-4xl font-bold">¡Hola, {{ explode(' ', auth()->user()->name)[0] ?? 'Estudiante' }}!</h1>
                            <p class="text-lg text-white/80 max-w-md">Aún no te has inscrito a ningún plan de carrera. Explora nuestras opciones y <span class="text-stitch-secondary-container font-bold">comienza tu primer reto</span>.</p>
                            <div class="pt-4 flex gap-4">
                                <a href="{{ route('careers.index') }}" class="px-6 py-2.5 bg-white text-stitch-primary rounded-stitch font-bold text-sm hover:bg-white/90 transition-colors">Explorar Carreras</a>
                            </div>
                        </div>
                        <!-- Abstract decoration -->
                        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-stitch-secondary/20 rounded-full blur-3xl"></div>
                        <div class="absolute right-10 top-10 w-24 h-24 border-4 border-white/10 rounded-full"></div>
                    </div>

                    <!-- Active Challenges -->
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <h2 class="font-lexend text-2xl font-bold text-stitch-primary">Retos Activos</h2>
                            <a href="#" class="text-sm font-bold text-stitch-secondary hover:underline flex items-center gap-1">Ver todos <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg></a>
                        </div>

                        <div class="bg-white p-8 rounded-stitch border border-stitch-outline/10 shadow-sm text-center flex flex-col items-center justify-center py-12">
                            <div class="w-16 h-16 bg-stitch-background rounded-full flex items-center justify-center mb-4 text-stitch-on-surface-variant">
                                <svg class="w-8 h-8 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <p class="text-stitch-on-surface-variant italic">Aún no hay retos disponibles.</p>
                        </div>
                    </div>

                    <!-- Feedback Hub -->
                    <div class="bg-white p-8 rounded-stitch border border-stitch-outline/10 shadow-sm mt-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-stitch-primary/5 rounded-full flex items-center justify-center text-stitch-primary">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                            </div>
                            <div>
                                <h2 class="font-lexend text-xl font-bold text-stitch-primary">Feedback Hub</h2>
                                <p class="text-xs text-stitch-on-surface-variant">Comentarios recientes de mentores</p>
                            </div>
                        </div>

                        <div class="p-6 rounded-stitch bg-stitch-background text-center py-8">
                            <p class="text-stitch-on-surface-variant italic text-sm">Aún no hay comentarios disponibles.</p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar / Next Deliveries -->
                <div class="lg:col-span-4 space-y-8 sticky top-8 self-start">
                    <div class="bg-white p-8 rounded-stitch border border-stitch-outline/10 shadow-sm">
                        <h2 class="font-lexend text-xl font-bold text-stitch-primary mb-6">Próximas Entregas</h2>
                        <div class="space-y-4">
                            <div @click="{{ (isset($hasSubmittedChallenge) && $hasSubmittedChallenge) ? '' : 'openTaskModal = true' }}" class="flex gap-4 p-4 rounded-stitch bg-stitch-background border border-stitch-outline/10 hover:border-stitch-secondary/30 transition-colors {{ (isset($hasSubmittedChallenge) && $hasSubmittedChallenge) ? '' : 'cursor-pointer' }} group">
                                <div class="flex-shrink-0 w-12 h-12 {{ (isset($hasSubmittedChallenge) && $hasSubmittedChallenge) ? 'bg-stitch-secondary text-white' : 'bg-white shadow-sm text-stitch-primary' }} rounded-stitch flex flex-col items-center justify-center font-bold group-hover:scale-105 transition-transform">
                                    @if(isset($hasSubmittedChallenge) && $hasSubmittedChallenge)
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    @else
                                        <span class="text-[10px] uppercase text-stitch-on-surface-variant">Hoy</span>
                                        <svg class="w-5 h-5 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    @endif
                                </div>
                                <div>
                                    @if(isset($hasSubmittedChallenge) && $hasSubmittedChallenge)
                                        <h4 class="font-bold text-stitch-on-surface-variant text-sm leading-tight line-through opacity-70">Enlistar los componentes de una red y una pc</h4>
                                        <p class="text-xs text-stitch-on-surface-variant mt-1 text-stitch-secondary font-bold">¡Completado!</p>
                                    @else
                                        <h4 class="font-bold text-stitch-primary text-sm leading-tight">Enlistar los componentes de una red y una pc</h4>
                                        <p class="text-xs text-stitch-on-surface-variant mt-1">Curso: Redes</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Achievement Card -->
                    <div class="p-6 rounded-stitch bg-stitch-secondary/10 border border-stitch-secondary/20">
                        <div class="flex items-center gap-4">
                            <div class="text-4xl">🏆</div>
                            <div>
                                <h4 class="font-bold text-stitch-primary">¡Bienvenido!</h4>
                                <p class="text-xs text-stitch-on-surface-variant">Inscríbete hoy y comienza tu racha.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Task Modal Floating Window -->
        <div x-show="openTaskModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                
                <div x-show="openTaskModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" @click="openTaskModal = false" aria-hidden="true"></div>

                <!-- Center align trick -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="openTaskModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-[2rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-stitch-outline/10">
                    <form method="POST" action="{{ route('challenges.submit', 1) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="bg-white px-6 pt-8 pb-6 sm:p-8 sm:pb-6">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                    <span class="px-3 py-1 bg-stitch-secondary/10 text-stitch-secondary rounded-full text-xs font-bold uppercase tracking-wider mb-4 inline-block">Redes</span>
                                    <h3 class="text-xl leading-6 font-lexend font-bold text-stitch-primary mb-2" id="modal-title">
                                        Enlistar componentes de res y PC
                                    </h3>
                                    <div class="mt-3">
                                        <p class="text-sm text-stitch-on-surface-variant leading-relaxed">
                                            <strong>Especificaciones:</strong> Elabora un documento donde enlistes detalladamente los componentes clave de hardware de una computadora (CPU, RAM, etc.) en conjunto con los dispositivos principales de comunicación (Routers, Switches, etc.).
                                        </p>
                                    </div>
                                    
                                    <!-- File Upload Area -->
                                    <div class="mt-6 border-2 border-dashed border-stitch-primary/30 rounded-stitch p-8 flex flex-col items-center justify-center bg-stitch-primary/5 hover:bg-stitch-primary/10 transition-colors cursor-pointer text-center relative group">
                                        <input type="file" name="file" accept=".pdf,.docx" @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" />
                                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mb-3 shadow-sm group-hover:scale-110 transition-transform">
                                            <svg class="h-6 w-6 text-stitch-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                        </div>
                                        <p class="text-sm font-bold text-stitch-primary" x-text="fileName ? fileName : 'Cargar archivo'"></p>
                                        <p class="text-xs text-stitch-on-surface-variant mt-1 px-4" x-show="!fileName">Arrastra tu documento o haz clic aquí (.pdf, .docx)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-stitch-background/50 px-6 py-4 sm:px-8 sm:flex border-t border-stitch-outline/10 gap-3">
                            <button type="submit" class="w-full inline-flex justify-center items-center rounded-stitch border border-transparent px-6 py-3 bg-stitch-primary text-sm font-bold text-white hover:bg-stitch-primary/90 focus:outline-none transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Entregar Tarea
                            </button>
                            <button type="button" @click="openTaskModal = false" class="mt-3 sm:mt-0 w-full inline-flex justify-center items-center rounded-stitch border border-stitch-outline/20 px-6 py-3 bg-white text-sm font-bold text-stitch-on-surface hover:bg-gray-50 focus:outline-none transition-colors">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
