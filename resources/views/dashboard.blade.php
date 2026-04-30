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
                            <p class="text-lg text-white/80 max-w-md">
                                @if($vocationalResult)
                                    Tu perfil vocacional dominante es
                                    <span class="text-white font-bold">{{ $vocationalResult->dominant_name }}</span>.
                                    Continúa explorando las carreras recomendadas.
                                @else
                                    Aún no has completado el test vocacional. ¡Descubre qué área va contigo!
                                @endif
                            </p>
                            <div class="pt-4 flex flex-wrap gap-3">
                                <a href="{{ route('careers.index') }}" class="px-6 py-2.5 bg-white text-stitch-primary rounded-stitch font-bold text-sm hover:bg-white/90 transition-colors">Explorar Carreras</a>
                                @if(!$vocationalResult)
                                    <a href="{{ route('vocacional.test') }}" class="px-6 py-2.5 bg-stitch-secondary text-white rounded-stitch font-bold text-sm hover:bg-stitch-secondary/90 transition-colors">Hacer Test Vocacional</a>
                                @endif
                            </div>
                        </div>
                        <!-- Abstract decoration -->
                        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-stitch-secondary/20 rounded-full blur-3xl"></div>
                        <div class="absolute right-10 top-10 w-24 h-24 border-4 border-white/10 rounded-full"></div>
                    </div>

                    <!-- Vocational Result Card -->
                    @if($vocationalResult)
                        @php
                            $colorMap = [
                                'blue'    => ['bg' => 'bg-gradient-to-br from-stitch-primary to-stitch-primary-container', 'badge' => 'bg-white/20', 'bar' => 'bg-stitch-primary'],
                                'emerald' => ['bg' => 'bg-gradient-to-br from-emerald-600 to-emerald-800', 'badge' => 'bg-white/20', 'bar' => 'bg-emerald-500'],
                                'amber'   => ['bg' => 'bg-gradient-to-br from-amber-500 to-amber-700',   'badge' => 'bg-white/20', 'bar' => 'bg-amber-500'],
                                'violet'  => ['bg' => 'bg-gradient-to-br from-violet-600 to-violet-800', 'badge' => 'bg-white/20', 'bar' => 'bg-violet-500'],
                            ];
                            $vc = $colorMap[$vocationalResult->color] ?? $colorMap['blue'];
                            $areas = [
                                ['key'=>'score_a','name'=>'Ingeniería y Tecnología','bar'=>'bg-stitch-primary','text'=>'text-stitch-primary'],
                                ['key'=>'score_b','name'=>'Salud y Bienestar','bar'=>'bg-emerald-500','text'=>'text-emerald-600'],
                                ['key'=>'score_c','name'=>'Negocios y Ciencias Soc.','bar'=>'bg-amber-500','text'=>'text-amber-600'],
                                ['key'=>'score_d','name'=>'Artes, Diseño y Educación','bar'=>'bg-violet-500','text'=>'text-violet-600'],
                            ];
                        @endphp
                        <div class="{{ $vc['bg'] }} rounded-2xl p-8 text-white shadow-lg relative overflow-hidden">
                            <div class="absolute -top-8 -right-8 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                            <div class="relative z-10">
                                <p class="text-white/70 text-xs uppercase tracking-widest font-semibold mb-2">Tu Perfil Vocacional Dominante</p>
                                <div class="flex items-center gap-4 mb-5">
                                    <span class="text-4xl">{{ $vocationalResult->icon }}</span>
                                    <h2 class="font-lexend text-2xl font-bold">{{ $vocationalResult->dominant_name }}</h2>
                                </div>
                                <!-- Score bars -->
                                <div class="space-y-3">
                                    @foreach($areas as $area)
                                        <div>
                                            <div class="flex justify-between text-xs mb-1">
                                                <span class="font-medium text-white/80">{{ $area['name'] }}</span>
                                                <span class="font-bold text-white">{{ $vocationalResult->{$area['key']} }}/30</span>
                                            </div>
                                            <div class="w-full bg-white/20 rounded-full h-1.5">
                                                <div class="h-1.5 bg-white rounded-full transition-all duration-700"
                                                     style="width: {{ round(($vocationalResult->{$area['key']} / 30) * 100) }}%"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Suggested careers -->
                                @if(count($vocationalResult->careers_suggested))
                                    <div class="mt-6 pt-5 border-t border-white/20">
                                        <p class="text-white/70 text-xs font-semibold uppercase tracking-wider mb-3">Carreras Sugeridas</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($vocationalResult->careers_suggested as $career)
                                                <span class="{{ $vc['badge'] }} backdrop-blur-sm px-3 py-1.5 rounded-full text-xs font-semibold text-white">{{ $career }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <a href="{{ route('vocacional.test') }}"
                                   class="inline-block mt-8 px-5 py-2 bg-white/20 hover:bg-white/30 text-white text-xs font-bold rounded-stitch transition-colors">
                                    🔄 Repetir el test
                                </a>
                            </div>
                        </div>
                    @else
                        <!-- Prompt to take test -->
                        <div class="bg-gradient-to-r from-white to-stitch-background border border-stitch-primary/10 rounded-[2rem] p-8 shadow-xl flex flex-col sm:flex-row items-center gap-8 relative overflow-hidden group">
                            <!-- Background decoration -->
                            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-stitch-primary/5 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                            
                            <div class="w-20 h-20 bg-white shadow-inner rounded-2xl flex items-center justify-center text-4xl flex-shrink-0 border border-stitch-primary/5 transform group-hover:rotate-12 transition-transform">🧭</div>
                            <div class="relative z-10 flex-1">
                                <h2 class="font-lexend text-2xl font-bold text-stitch-primary">Descubre tu perfil vocacional</h2>
                                <p class="text-stitch-on-surface-variant text-base mt-2 max-w-md">Responde 30 preguntas diseñadas por expertos y encuentra las carreras que mejor se adaptan a tus talentos y pasiones.</p>
                                <a href="{{ route('vocacional.test') }}" class="inline-flex items-center mt-5 px-8 py-3.5 bg-stitch-primary text-white text-sm font-extrabold rounded-xl shadow-lg shadow-stitch-primary/20 hover:bg-stitch-primary-container hover:shadow-stitch-primary/30 hover:-translate-y-1 transition-all active:scale-95">
                                    Iniciar Test Vocacional 
                                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    @endif

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
                                <h2 class="font-lexend text-xl font-bold text-stitch-primary">Feedback de Mentores</h2>
                                <p class="text-xs text-stitch-on-surface-variant">Retroalimentación sobre tus entregas</p>
                            </div>
                        </div>

                        @forelse(auth()->user()->taskSubmissions()->with('challenge')->whereNotNull('feedback')->latest('reviewed_at')->get() as $sub)
                            <div class="p-5 rounded-stitch bg-stitch-background border border-stitch-outline/10 mb-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-bold text-sm text-stitch-primary">{{ $sub->challenge->title ?? 'Reto' }}</span>
                                    <div class="flex items-center gap-2">
                                        @if($sub->score !== null)
                                            <span class="text-xs font-bold text-stitch-primary">{{ $sub->score }}/100</span>
                                        @endif
                                        @if($sub->status === 'approved')
                                            <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-xs font-bold">✓ Aprobada</span>
                                        @else
                                            <span class="px-2 py-0.5 bg-red-100 text-red-700 rounded-full text-xs font-bold">✗ Rechazada</span>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-sm text-stitch-on-surface-variant leading-relaxed">{{ $sub->feedback }}</p>
                                @if($sub->reviewed_at)
                                    <p class="text-xs text-stitch-on-surface-variant mt-2 opacity-60">{{ $sub->reviewed_at->format('d/m/Y H:i') }}</p>
                                @endif
                            </div>
                        @empty
                            <div class="p-6 rounded-stitch bg-stitch-background text-center py-8">
                                <p class="text-stitch-on-surface-variant italic text-sm">Aún no hay comentarios disponibles.</p>
                            </div>
                        @endforelse
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

                    {{-- Achievement / Downloads Card --}}
                    <div class="p-6 rounded-stitch border border-stitch-outline/10 bg-white shadow-sm space-y-3">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="text-3xl">🏆</div>
                            <div>
                                <h4 class="font-bold text-stitch-primary text-sm">Mis Logros</h4>
                                <p class="text-xs text-stitch-on-surface-variant">Descarga tus constancias</p>
                            </div>
                        </div>

                        @if($vocationalResult)
                            <a href="{{ route('certificates.vocacional') }}"
                               class="flex items-center gap-3 w-full px-4 py-3 rounded-stitch text-sm font-bold text-white transition-colors"
                               style="background-color: #1E3A5F;">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Reporte Vocacional (PDF)
                            </a>
                        @else
                            <div class="flex items-center gap-3 w-full px-4 py-3 rounded-stitch text-sm font-medium text-gray-400 bg-gray-50 cursor-not-allowed border border-dashed border-gray-200">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Reporte Vocacional (pendiente test)
                            </div>
                        @endif

                        <a href="{{ route('learning-paths.index') }}"
                           class="flex items-center gap-3 w-full px-4 py-3 rounded-stitch text-sm font-bold transition-colors"
                           style="background-color: #F5F3FF; color: #6D28D9; border: 1px solid #EDE9FE;">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Ver Mi Ruta de Aprendizaje
                        </a>
                    </div>
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

        <!-- Task Modal -->
        <div x-show="openTaskModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="openTaskModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" @click="openTaskModal = false" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="openTaskModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-[2rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-stitch-outline/10">
                    <form method="POST" action="{{ route('challenges.submit', 1) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="bg-white px-6 pt-8 pb-6 sm:p-8 sm:pb-6">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                    <span class="px-3 py-1 bg-stitch-secondary/10 text-stitch-secondary rounded-full text-xs font-bold uppercase tracking-wider mb-4 inline-block">Redes</span>
                                    <h3 class="text-xl leading-6 font-lexend font-bold text-stitch-primary mb-2" id="modal-title">
                                        Enlistar componentes de red y PC
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
