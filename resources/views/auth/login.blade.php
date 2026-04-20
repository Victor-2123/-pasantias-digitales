<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- User Type Selection -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4 text-center">¿Qué tipo de usuario eres?</h2>
        <div class="grid grid-cols-2 gap-3" id="login-user-type">
            <!-- Estudiante Option -->
            <button type="button" class="user-type-btn py-3 px-3 rounded-lg border-2 border-gray-300 hover:border-indigo-400 transition-all duration-200 text-center cursor-pointer" 
                data-type="estudiante" onclick="selectUserType('estudiante')">
                <div class="text-xl mb-1">👨‍🎓</div>
                <div class="text-sm font-medium text-gray-900">Estudiante</div>
                <div class="text-xs text-gray-600">Alumno</div>
            </button>

            <!-- Maestro Option -->
            <button type="button" class="user-type-btn py-3 px-3 rounded-lg border-2 border-gray-300 hover:border-indigo-400 transition-all duration-200 text-center cursor-pointer" 
                data-type="maestro" onclick="selectUserType('maestro')">
                <div class="text-xl mb-1">👨‍🏫</div>
                <div class="text-sm font-medium text-gray-900">Maestro</div>
                <div class="text-xs text-gray-600">Profesor</div>
            </button>
        </div>
    </div>

    <form method="POST" action="{{ route('login') }}" id="login-form">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        let selectedUserType = 'estudiante'; // Default
        
        function selectUserType(type) {
            selectedUserType = type;
            
            // Update button styles
            document.querySelectorAll('.user-type-btn').forEach(btn => {
                if (btn.dataset.type === type) {
                    btn.className = 'user-type-btn py-3 px-3 rounded-lg border-2 border-indigo-600 bg-indigo-50 transition-all duration-200 text-center cursor-pointer';
                } else {
                    btn.className = 'user-type-btn py-3 px-3 rounded-lg border-2 border-gray-300 hover:border-indigo-400 transition-all duration-200 text-center cursor-pointer';
                }
            });
        }
        
        // Set initial state
        document.addEventListener('DOMContentLoaded', function() {
            selectUserType('estudiante');
        });
        
        // You can use selectedUserType for tracking on the server if needed
        // For now, it's just for visual feedback
    </script>
</x-guest-layout>
