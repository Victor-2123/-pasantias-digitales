<x-app-layout>
    <div class="py-12 bg-stitch-background min-h-screen">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            
            <!-- CV Card -->
            <div class="bg-white rounded-[2.5rem] shadow-xl overflow-hidden border border-stitch-outline/10">
                
                <!-- Hero Header -->
                <div class="h-48 bg-stitch-primary relative">
                    <div class="absolute -bottom-16 left-12">
                        <div class="w-32 h-32 rounded-[2rem] border-4 border-white bg-gray-100 overflow-hidden shadow-lg">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/'.$user->profile_photo) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-stitch-secondary/10 text-stitch-secondary text-4xl font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Abstract decoration -->
                    <div class="absolute right-10 top-10 w-32 h-32 border-4 border-white/10 rounded-full"></div>
                </div>

                <!-- Profile Info -->
                <div class="pt-20 pb-12 px-12" x-data="{ onboardingModal: false }">
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                        <div>
                            <h1 class="text-3xl font-bold text-stitch-primary font-lexend">{{ $user->name }}</h1>
                            <div class="flex items-center gap-4 mt-2 text-stitch-on-surface-variant font-medium">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    {{ $user->school ?? 'Sin institución' }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                                    {{ $user->age ? $user->age . ' años' : 'Edad no especificada' }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="flex gap-3">
                            @if(auth()->id() === $user->id)
                                @if(!$user->is_profile_complete)
                                    <button @click="onboardingModal = true" class="px-6 py-3 bg-stitch-secondary text-white text-sm font-bold rounded-stitch hover:bg-stitch-secondary/90 transition-colors shadow-lg shadow-stitch-secondary/20">
                                        Completar Perfil
                                    </button>
                                @endif
                                <a href="{{ route('profile.edit') }}" class="px-6 py-3 bg-stitch-primary text-white text-sm font-bold rounded-stitch hover:bg-stitch-primary/90 transition-colors shadow-lg shadow-stitch-primary/20">
                                    Editar Perfil
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- ── Floating Onboarding Modal ── --}}
                    <div x-show="onboardingModal" 
                         class="fixed inset-0 z-50 overflow-y-auto"
                         style="display: none;"
                         x-transition:enter="ease-out duration-300"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100">
                        
                        <div class="flex items-center justify-center min-h-screen p-4">
                            <!-- Backdrop -->
                            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="onboardingModal = false"></div>

                            <!-- Modal Content -->
                            <div class="relative bg-white rounded-[2.5rem] shadow-2xl w-full max-w-2xl overflow-hidden border border-stitch-outline/10 z-10"
                                 x-transition:enter="ease-out duration-300"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100">
                                
                                <div class="grid md:grid-cols-12">
                                    <!-- Left Section (Blue) -->
                                    <div class="hidden md:flex md:col-span-4 bg-stitch-primary p-8 flex-col justify-between text-white relative overflow-hidden">
                                        <div class="relative z-10">
                                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mb-6">
                                                <span class="text-xl">✨</span>
                                            </div>
                                            <h2 class="font-lexend text-xl font-bold leading-tight">¡Casi listo!</h2>
                                            <p class="text-white/70 text-xs mt-3">Solo unos pasos más para que las empresas te conozcan mejor.</p>
                                        </div>
                                        
                                        <div class="relative z-10 space-y-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-1.5 h-1.5 rounded-full bg-white"></div>
                                                <span class="text-[10px] font-bold uppercase tracking-wider text-white">Información Básica</span>
                                            </div>
                                            <div class="flex items-center gap-3 opacity-50">
                                                <div class="w-1.5 h-1.5 rounded-full bg-white/50"></div>
                                                <span class="text-[10px] font-bold uppercase tracking-wider text-white">Foto de Perfil</span>
                                            </div>
                                        </div>
                                        <div class="absolute -right-20 -bottom-20 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>
                                    </div>

                                    <!-- Right Section (Form) -->
                                    <div class="md:col-span-8 p-10">
                                        <div class="mb-6">
                                            <h3 class="text-xl font-bold text-stitch-primary font-lexend">Completa tu Perfil</h3>
                                            <p class="text-stitch-on-surface-variant text-xs mt-1">Queremos brindarte la mejor experiencia personalizada.</p>
                                        </div>

                                        <form method="POST" action="{{ route('onboarding.store') }}" enctype="multipart/form-data" class="space-y-4">
                                            @csrf
                                            <div>
                                                <x-input-label for="school_modal" value="Escuela o Institución" />
                                                <x-text-input id="school_modal" name="school" type="text" class="mt-1 block w-full text-sm" :value="old('school', $user->school)" required placeholder="Ej. Instituto Tecnológico de..." />
                                            </div>

                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <x-input-label for="age_modal" value="Edad" />
                                                    <x-text-input id="age_modal" name="age" type="number" class="mt-1 block w-full text-sm" :value="old('age', $user->age)" required min="15" max="100" />
                                                </div>
                                                <div>
                                                    <x-input-label for="photo_modal" value="Foto de Perfil" />
                                                    <input id="photo_modal" name="profile_photo" type="file" accept="image/*" class="mt-1 block w-full text-[10px] text-gray-500 file:mr-2 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:bg-stitch-primary file:text-white" />
                                                </div>
                                            </div>

                                            <div>
                                                <x-input-label for="bio_modal" value="Biografía Corta" />
                                                <textarea id="bio_modal" name="bio" rows="3" required class="mt-1 block w-full border-gray-300 focus:border-stitch-primary focus:ring-stitch-primary rounded-stitch shadow-sm text-sm" placeholder="Cuéntanos un poco sobre ti...">{{ old('bio', $user->bio) }}</textarea>
                                            </div>

                                            <div class="pt-2 flex gap-3">
                                                <button type="submit" class="flex-1 py-3 bg-stitch-primary text-white text-xs font-bold rounded-stitch hover:bg-stitch-primary/90 transition-colors uppercase tracking-widest">
                                                    Finalizar y Empezar
                                                </button>
                                                <button type="button" @click="onboardingModal = false" class="px-4 py-3 border border-gray-200 text-gray-500 text-xs font-bold rounded-stitch hover:bg-gray-50 transition-colors">
                                                    Cerrar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-10 border-stitch-outline/10">

                    <!-- Content Grid -->
                    <div class="grid md:grid-cols-3 gap-12">
                        
                        <!-- Left: About Me -->
                        <div class="md:col-span-2 space-y-8">
                            <section>
                                <h3 class="text-xl font-bold text-stitch-primary font-lexend mb-4 flex items-center gap-2">
                                    <span class="text-2xl">📝</span> Sobre mí
                                </h3>
                                <p class="text-stitch-on-surface-variant leading-relaxed">
                                    {{ $user->bio ?? 'Este estudiante aún no ha redactado su biografía profesional.' }}
                                </p>
                            </section>

                            <section>
                                <h3 class="text-xl font-bold text-stitch-primary font-lexend mb-4 flex items-center gap-2">
                                    <span class="text-2xl">🚀</span> Actividad Reciente
                                </h3>
                                <div class="space-y-4">
                                    @forelse($user->submissions()->latest()->take(3)->get() as $submission)
                                        <div class="p-4 rounded-stitch border border-stitch-outline/10 hover:bg-stitch-background/50 transition-colors flex items-center justify-between">
                                            <div>
                                                <p class="font-bold text-sm text-stitch-primary">{{ $submission->challenge->title }}</p>
                                                <p class="text-xs text-stitch-on-surface-variant">{{ $submission->created_at->format('d M, Y') }}</p>
                                            </div>
                                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                                {{ $submission->status === 'approved' ? 'bg-green-100 text-green-700' : ($submission->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700') }}">
                                                {{ $submission->status === 'approved' ? 'Aprobado' : ($submission->status === 'rejected' ? 'Rechazado' : 'Pendiente') }}
                                            </span>
                                        </div>
                                    @empty
                                        <p class="text-sm italic text-stitch-on-surface-variant">Aún no hay entregas de desafíos.</p>
                                    @endforelse
                                </div>
                            </section>
                        </div>

                        <!-- Right: Stats & Contact -->
                        <div class="space-y-8">
                            <div class="p-6 bg-stitch-background/50 rounded-[2rem] border border-stitch-outline/10">
                                <h4 class="font-bold text-stitch-primary text-sm uppercase tracking-widest mb-4">Estadísticas</h4>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs text-stitch-on-surface-variant font-medium">Retos Completados</span>
                                        <span class="font-bold text-stitch-primary">{{ $user->submissions()->where('status', 'approved')->count() }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs text-stitch-on-surface-variant font-medium">Promedio</span>
                                        <span class="font-bold text-stitch-primary">{{ round($user->submissions()->whereNotNull('score')->avg('score') ?? 0) }}%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 border border-stitch-outline/10 rounded-[2rem]">
                                <h4 class="font-bold text-stitch-primary text-sm uppercase tracking-widest mb-4">Contacto</h4>
                                <div class="space-y-3">
                                    <p class="text-xs text-stitch-on-surface-variant flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                                        {{ $user->email }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
