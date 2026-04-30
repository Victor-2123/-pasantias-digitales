<section>
    <header>
        <h2 class="text-xl font-bold text-stitch-primary font-lexend">
            Seguridad de la Cuenta
        </h2>

        <p class="mt-1 text-sm text-stitch-on-surface-variant">
            Asegúrate de que tu cuenta esté usando una contraseña larga y aleatoria para mantenerte seguro.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('put')

        <div class="max-w-md">
            <x-input-label for="update_password_current_password" value="Contraseña Actual" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full border-gray-300 focus:border-stitch-primary focus:ring-stitch-primary rounded-stitch" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="max-w-md">
            <x-input-label for="update_password_password" value="Nueva Contraseña" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full border-gray-300 focus:border-stitch-primary focus:ring-stitch-primary rounded-stitch" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="max-w-md">
            <x-input-label for="update_password_password_confirmation" value="Confirmar Nueva Contraseña" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full border-gray-300 focus:border-stitch-primary focus:ring-stitch-primary rounded-stitch" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button class="bg-stitch-primary hover:bg-stitch-primary/90">
                Actualizar Contraseña
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-stitch-secondary font-bold"
                >Contraseña actualizada correctamente.</p>
            @endif
        </div>
    </form>
</section>
