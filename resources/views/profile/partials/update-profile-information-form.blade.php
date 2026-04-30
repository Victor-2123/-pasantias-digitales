    <header class="flex justify-between items-start">
        <div>
            <h2 class="text-lg font-medium text-gray-900">
                Información del Perfil
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                Actualiza la información de tu perfil y la dirección de correo electrónico de tu cuenta.
            </p>
        </div>
        
        @if(auth()->user()->user_type === 'estudiante')
        <div x-data="{ openOnboarding: false }">
            <button type="button" @click="openOnboarding = true" class="px-4 py-2 bg-stitch-secondary text-white text-xs font-bold rounded-stitch hover:bg-stitch-secondary/90 transition-all shadow-lg shadow-stitch-secondary/20 uppercase tracking-widest">
                Completar Perfil
            </button>

            <!-- Floating Modal -->
            <div x-show="openOnboarding" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="openOnboarding = false"></div>
                    
                    <div class="relative bg-white rounded-[2.5rem] shadow-2xl w-full max-w-2xl overflow-hidden border border-stitch-outline/10 z-10">
                        <div class="grid md:grid-cols-12">
                            <!-- Left Blue Panel -->
                            <div class="hidden md:flex md:col-span-4 bg-stitch-primary p-8 flex-col justify-between text-white relative overflow-hidden">
                                <div class="relative z-10">
                                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mb-6">
                                        <span class="text-xl">✨</span>
                                    </div>
                                    <h2 class="font-lexend text-xl font-bold leading-tight">Tu Perfil</h2>
                                    <p class="text-white/70 text-xs mt-3">Mantén tu información actualizada para destacar ante las empresas.</p>
                                </div>
                                <div class="absolute -right-20 -bottom-20 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>
                            </div>

                            <!-- Right Form Panel -->
                            <div class="md:col-span-8 p-10">
                                <h3 class="text-xl font-bold text-stitch-primary font-lexend mb-6">Información Profesional</h3>
                                
                                <form method="POST" action="{{ route('onboarding.store') }}" enctype="multipart/form-data" class="space-y-4 text-left">
                                    @csrf
                                    <div>
                                        <x-input-label for="modal_school" value="Escuela o Institución" />
                                        <x-text-input id="modal_school" name="school" type="text" class="mt-1 block w-full text-sm" :value="old('school', $user->school)" required />
                                    </div>

                                    <div>
                                        <x-input-label for="modal_age" value="Edad" />
                                        <x-text-input id="modal_age" name="age" type="number" class="mt-1 block w-full text-sm" :value="old('age', $user->age)" required min="15" />
                                    </div>

                                    <div>
                                        <x-input-label for="modal_bio" value="Biografía Corta" />
                                        <textarea id="modal_bio" name="bio" rows="3" required class="mt-1 block w-full border-gray-300 focus:border-stitch-primary focus:ring-stitch-primary rounded-stitch shadow-sm text-sm">{{ old('bio', $user->bio) }}</textarea>
                                    </div>

                                    <div class="pt-4 flex gap-3">
                                        <button type="submit" class="flex-1 py-3 bg-stitch-primary text-white text-xs font-bold rounded-stitch hover:bg-stitch-primary/90 transition-all uppercase tracking-widest shadow-lg shadow-stitch-primary/20">
                                            Guardar Cambios
                                        </button>
                                        <button type="button" @click="openOnboarding = false" class="px-4 py-3 border border-gray-200 text-gray-400 text-xs font-bold rounded-stitch hover:bg-gray-50 transition-colors uppercase">
                                            Cerrar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="flex items-center gap-6" x-data="{ photoPreview: null }">
            <div class="relative group">
                <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-stitch-primary/10 shadow-sm bg-gray-100 flex items-center justify-center">
                    <template x-if="!photoPreview">
                        @if($user->profile_photo)
                            <img src="{{ asset('storage/'.$user->profile_photo) }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-3xl font-bold text-stitch-primary opacity-30">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        @endif
                    </template>
                    <template x-if="photoPreview">
                        <img :src="photoPreview" class="w-full h-full object-cover">
                    </template>
                </div>
                
                <label for="profile_photo" class="absolute inset-0 flex flex-col items-center justify-center bg-black/40 text-white text-[10px] font-bold opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer rounded-full">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    CAMBIAR
                </label>
                <input type="file" id="profile_photo" name="profile_photo" class="hidden" accept="image/*" 
                    @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => { photoPreview = e.target.result; }; reader.readAsDataURL(file); }">
            </div>
            
            <div>
                <p class="text-sm font-bold text-stitch-primary">Foto de perfil</p>
                <p class="text-xs text-stitch-on-surface-variant">Haz clic en el círculo para escoger una imagen.</p>
                <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <!-- Portfolio Username -->
        <div>
            <x-input-label for="username" :value="__('Nombre de Usuario (URL del Portafolio)')" />
            <div class="flex items-center mt-1">
                <span class="bg-slate-50 border border-r-0 border-stitch-outline/20 rounded-l-stitch px-3 py-2 text-sm text-slate-400 font-medium">
                    {{ url('/u/') }}/
                </span>
                <x-text-input id="username" name="username" type="text" class="block w-full rounded-l-none" :value="old('username', $user->username)" placeholder="mi-nombre-profesional" />
            </div>
            <p class="text-[10px] text-slate-400 mt-1 uppercase font-bold tracking-widest">Este será tu enlace para compartir tu CV.</p>
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <!-- Privacy Toggle -->
        <div class="bg-slate-50 p-6 rounded-stitch border border-stitch-outline/10 mt-6">
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="font-bold text-stitch-primary">Portafolio Público</h4>
                    <p class="text-xs text-stitch-on-surface-variant">Permite que empresas y otros usuarios vean tus logros.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_public" value="1" class="sr-only peer" {{ old('is_public', $user->is_public) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-stitch-secondary"></div>
                </label>
            </div>
            
            @if($user->is_public && $user->username)
                <div class="mt-4 pt-4 border-t border-slate-200 flex items-center justify-between">
                    <span class="text-[10px] font-black uppercase tracking-widest text-emerald-500 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Perfil Visible
                    </span>
                    <a href="{{ route('portfolio.show', $user->username) }}" target="_blank" class="text-xs font-bold text-stitch-secondary hover:underline flex items-center gap-1">
                        Ver mi portafolio
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4">
            <x-primary-button class="bg-stitch-primary hover:bg-stitch-primary/90">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 font-medium"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
