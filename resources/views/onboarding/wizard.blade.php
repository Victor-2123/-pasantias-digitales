@extends('layouts.guest')

@section('content')
    <div class="min-h-screen bg-stitch-background flex items-center justify-center p-4">
        <div class="max-w-2xl w-full bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-stitch-outline/10">
            <div class="grid md:grid-cols-12">
                
                <!-- Left decoration -->
                <div class="hidden md:flex md:col-span-4 bg-stitch-primary p-8 flex-col justify-between text-white relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mb-6 backdrop-blur-sm">
                            <span class="text-2xl">✨</span>
                        </div>
                        <h2 class="font-lexend text-2xl font-bold leading-tight">¡Casi listo!</h2>
                        <p class="text-white/70 text-sm mt-4">Solo unos pasos más para que las empresas te conozcan mejor.</p>
                    </div>
                    
                    <div class="relative z-10 space-y-6">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-white"></div>
                            <span class="text-xs font-medium text-white">Información Básica</span>
                        </div>
                        <div class="flex items-center gap-3 opacity-50">
                            <div class="w-2 h-2 rounded-full bg-white/50"></div>
                            <span class="text-xs font-medium text-white">Biografía</span>
                        </div>
                    </div>

                    <!-- Decorative elements -->
                    <div class="absolute -right-20 -bottom-20 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>
                </div>

                <!-- Right form -->
                <div class="md:col-span-8 p-10 md:p-12">
                    <div class="mb-8">
                        <h1 class="text-2xl font-bold text-stitch-primary font-lexend">Completa tu Perfil</h1>
                        <p class="text-stitch-on-surface-variant text-sm mt-2">Queremos brindarte la mejor experiencia personalizada.</p>
                    </div>

                    <form method="POST" action="{{ route('onboarding.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- School -->
                        <div>
                            <x-input-label for="school" value="Escuela o Institución" />
                            <x-text-input id="school" name="school" type="text" class="mt-1 block w-full" :value="old('school')" required autofocus placeholder="Ej. Instituto Tecnológico de..." />
                            <x-input-error class="mt-2" :messages="$errors->get('school')" />
                        </div>

                        <!-- Age -->
                        <div>
                            <x-input-label for="age" value="Edad" />
                            <x-text-input id="age" name="age" type="number" class="mt-1 block w-full" :value="old('age')" required min="15" max="100" />
                            <x-input-error class="mt-2" :messages="$errors->get('age')" />
                        </div>

                        <!-- Bio -->
                        <div>
                            <x-input-label for="bio" value="Biografía Corta" />
                            <textarea id="bio" name="bio" rows="3" required class="mt-1 block w-full border-gray-300 focus:border-stitch-primary focus:ring-stitch-primary rounded-stitch shadow-sm text-sm" placeholder="Cuéntanos un poco sobre ti y tus metas profesionales...">{{ old('bio') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                        </div>

                        <div class="pt-4 space-y-4">
                            <x-primary-button class="w-full justify-center py-3 text-sm font-bold bg-stitch-primary hover:bg-stitch-primary/90 shadow-lg shadow-stitch-primary/20">
                                Finalizar y Empezar
                            </x-primary-button>
                            
                            <div class="text-center">
                                <a href="{{ route('dashboard') }}" class="text-xs text-stitch-on-surface-variant hover:text-stitch-primary transition-colors underline">
                                    Saltar por ahora e ir al Dashboard
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
