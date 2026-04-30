<x-app-layout>
    <div class="py-12" x-data="{ openTaskModal: false, fileName: '', selectedTask: { id: null, title: '', description: '', career: '' } }">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            @if(Auth::user()->user_type === 'maestro')
                <div class="mb-8 flex items-end justify-between">
                    <div>
                        <h1 class="font-lexend text-3xl font-bold text-stitch-primary">Panel de Evaluación</h1>
                        <p class="text-stitch-on-surface-variant mt-2">Revisa las entregas actuales de tus alumnos en el curso.</p>
                    </div>
                </div>
                <div class="bg-white rounded-stitch border border-stitch-outline/10 shadow-sm overflow-hidden">
                    <div class="p-6 md:p-8">
                        <h3 class="text-xl font-bold text-stitch-primary mb-6">Reto: {{ $challenge->title ?? 'Reto Actual' }}</h3>
                        
                        <div class="space-y-4">
                            @foreach($students as $student)
                            <div class="flex items-center justify-between p-4 rounded-stitch border border-stitch-outline/10 hover:border-stitch-secondary/30 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-stitch-primary/10 rounded-full flex items-center justify-center text-stitch-primary font-bold">
                                        {{ substr($student->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-sm text-stitch-primary">{{ $student->name }}</h4>
                                        <p class="text-xs text-stitch-on-surface-variant">{{ $student->email }}</p>
                                    </div>
                                </div>
                                
                                <div>
                                    @if($student->taskSubmissions->count() > 0)
                                        <a href="{{ route('submissions.download', $student->taskSubmissions->first()) }}" class="px-4 py-2 bg-stitch-secondary text-white rounded-stitch text-xs font-bold hover:opacity-90 transition-opacity flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                            Descargar Evidencia
                                        </a>
                                    @else
                                        <span class="px-4 py-2 border border-stitch-outline/20 text-stitch-on-surface-variant rounded-stitch text-xs font-bold flex items-center gap-2 bg-gray-50">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Falta Entregar
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            @if($students->isEmpty())
                                <p class="text-stitch-on-surface-variant text-center py-4">No hay estudiantes inscritos aún.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="mb-8">
                    <h1 class="font-lexend text-3xl font-bold text-stitch-primary">Mis Retos</h1>
                    <p class="text-stitch-on-surface-variant mt-2">Gestiona tu aprendizaje y completa tus tareas pendientes.</p>
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
                            @forelse($pendingChallenges as $task)
                                <!-- Assignment Item -->
                                <div @click="selectedTask = { id: {{ $task->id }}, title: '{{ addslashes($task->title) }}', description: '{{ addslashes($task->description) }}', career: '{{ $task->career->name ?? 'General' }}' }; openTaskModal = true" class="p-4 rounded-stitch border border-stitch-outline/10 hover:border-stitch-secondary/30 transition-colors cursor-pointer group">
                                    <div class="flex items-start gap-3">
                                        <div class="mt-1">
                                            <div class="w-5 h-5 rounded border-2 border-stitch-outline/30 group-hover:border-stitch-secondary flex items-center justify-center transition-colors"></div>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-sm text-stitch-primary mb-1 group-hover:text-stitch-secondary transition-colors">{{ $task->title }}</h4>
                                            <p class="text-xs text-stitch-on-surface-variant flex items-center gap-1 mt-2">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                                                De: {{ $task->career->name ?? 'General' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <div class="w-12 h-12 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <p class="text-sm text-stitch-on-surface-variant font-medium">¡Todo listo! No tienes tareas pendientes.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Task Modal -->
    <div x-show="openTaskModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="openTaskModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" @click="openTaskModal = false" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="openTaskModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-[2rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-stitch-outline/10">
                <form method="POST" :action="'/challenges/' + selectedTask.id + '/submit'" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white px-6 pt-8 pb-6 sm:p-8 sm:pb-6">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                <span class="px-3 py-1 bg-stitch-secondary/10 text-stitch-secondary rounded-full text-xs font-bold uppercase tracking-wider mb-4 inline-block" x-text="selectedTask.career"></span>
                                <h3 class="text-xl leading-6 font-lexend font-bold text-stitch-primary mb-2" id="modal-title" x-text="selectedTask.title"></h3>
                                <div class="mt-3">
                                    <p class="text-sm text-stitch-on-surface-variant leading-relaxed">
                                        <strong>Especificaciones:</strong> <span x-text="selectedTask.description"></span>
                                    </p>
                                </div>
                                <!-- File Upload Area -->
                                <div class="mt-6 border-2 border-dashed border-stitch-primary/30 rounded-stitch p-8 flex flex-col items-center justify-center bg-stitch-primary/5 hover:bg-stitch-primary/10 transition-colors cursor-pointer text-center relative group">
                                    <input type="file" name="file" accept=".pdf,.jpg,.jpeg,.png,.zip" @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" required />
                                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mb-3 shadow-sm group-hover:scale-110 transition-transform">
                                        <svg class="h-6 w-6 text-stitch-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                    </div>
                                    <p class="text-sm font-bold text-stitch-primary" x-text="fileName ? fileName : 'Cargar archivo'"></p>
                                    <p class="text-xs text-stitch-on-surface-variant mt-1 px-4" x-show="!fileName">Formatos permitidos: .pdf, .jpg, .png, .zip (Máx. 20MB)</p>
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
</x-app-layout>
