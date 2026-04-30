<section class="space-y-6">
    <header>
        <h2 class="text-xl font-bold text-red-600 font-lexend">
            Zona de Peligro
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Una vez que se elimine tu cuenta, todos sus recursos y datos se eliminarán de forma permanente. Antes de eliminar tu cuenta, descarga cualquier dato o información que desees conservar.
        </p>
    </header>

    <button 
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-6 py-3 bg-red-50 text-red-600 text-xs font-bold rounded-stitch border border-red-100 hover:bg-red-100 transition-all uppercase tracking-widest"
    >
        Eliminar Cuenta Permanentemente
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-10">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-bold text-stitch-primary font-lexend">
                ¿Estás seguro de que deseas eliminar tu cuenta?
            </h2>

            <p class="mt-4 text-sm text-stitch-on-surface-variant leading-relaxed">
                Esta acción no se puede deshacer. Todos tus progresos, retos y certificados se perderán para siempre. Por favor, ingresa tu contraseña para confirmar la eliminación permanente.
            </p>

            <div class="mt-8">
                <x-input-label for="password" value="Contraseña de Confirmación" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-stitch"
                    placeholder="Escribe tu contraseña aquí..."
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-10 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-6 py-3 border border-gray-200 text-gray-400 text-xs font-bold rounded-stitch hover:bg-gray-50 transition-colors uppercase">
                    Cancelar
                </button>

                <button type="submit" class="px-6 py-3 bg-red-600 text-white text-xs font-bold rounded-stitch hover:bg-red-700 transition-all uppercase tracking-widest shadow-lg shadow-red-200">
                    Confirmar Eliminación
                </button>
            </div>
        </form>
    </x-modal>
</section>
