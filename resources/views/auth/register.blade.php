<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', session('reg_name'))" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', session('reg_email'))" required autocomplete="username" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- User Type Selection -->
                                    @if(session('reg_user_type'))
                                        <input type="hidden" name="user_type" value="{{ session('reg_user_type') }}" />
                                    @else
                                        <div class="grid grid-cols-2 gap-4 mt-3">
                                            <!-- Estudiante Option -->
                                            <label class="relative flex items-center p-4 border-2 rounded-lg cursor-pointer transition-all duration-200" id="estudiante-option" 
                                                :class="selected === 'estudiante' ? 'border-indigo-600 bg-indigo-50' : 'border-gray-300 hover:border-indigo-400'">
                                                <input type="radio" name="user_type" value="estudiante" class="w-4 h-4 text-indigo-600" 
                                                    {{ old('user_type') === 'estudiante' ? 'checked' : '' }} required onchange="updateSelection('estudiante')" />
                                                <div class="ms-3 text-center flex-1">
                                                    <div class="text-sm font-semibold text-gray-900">👨‍🎓 Estudiante</div>
                                                    <div class="text-xs text-gray-600 mt-1">Acceso a cursos y tareas</div>
                                                </div>
                                            </label>

                                            <!-- Maestro Option -->
                                            <label class="relative flex items-center p-4 border-2 rounded-lg cursor-pointer transition-all duration-200" id="maestro-option"
                                                :class="selected === 'maestro' ? 'border-indigo-600 bg-indigo-50' : 'border-gray-300 hover:border-indigo-400'">
                                                <input type="radio" name="user_type" value="maestro" class="w-4 h-4 text-indigo-600" 
                                                    {{ old('user_type') === 'maestro' ? 'checked' : '' }} required onchange="updateSelection('maestro')" />
                                                <div class="ms-3 text-center flex-1">
                                                    <div class="text-sm font-semibold text-gray-900">👨‍🏫 Maestro</div>
                                                    <div class="text-xs text-gray-600 mt-1">Crear y gestionar cursos</div>
                                                </div>
                                            </label>
                                        </div>
                                    @endif
                        <div class="text-xs text-gray-600 mt-1">Crear y gestionar cursos</div>
                    </div>
                </label>
            </div>
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        let selected = '{{ old('user_type', 'estudiante') }}';
        
        function updateSelection(type) {
            selected = type;
            const estudianteOption = document.getElementById('estudiante-option');
            const maestroOption = document.getElementById('maestro-option');
            
            if (type === 'estudiante') {
                estudianteOption.className = 'relative flex items-center p-4 border-2 rounded-lg cursor-pointer transition-all duration-200 border-indigo-600 bg-indigo-50';
                maestroOption.className = 'relative flex items-center p-4 border-2 rounded-lg cursor-pointer transition-all duration-200 border-gray-300 hover:border-indigo-400';
            } else {
                maestroOption.className = 'relative flex items-center p-4 border-2 rounded-lg cursor-pointer transition-all duration-200 border-indigo-600 bg-indigo-50';
                estudianteOption.className = 'relative flex items-center p-4 border-2 rounded-lg cursor-pointer transition-all duration-200 border-gray-300 hover:border-indigo-400';
            }
        }
        
        // Initialize on load
        document.addEventListener('DOMContentLoaded', function() {
            updateSelection(selected);
        });
    </script>
</x-guest-layout>
