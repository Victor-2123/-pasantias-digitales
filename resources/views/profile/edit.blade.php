<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Hero Header Section -->
            <div class="relative overflow-hidden bg-stitch-primary rounded-[2.5rem] p-10 mb-10 shadow-2xl shadow-stitch-primary/20">
                <div class="relative z-10">
                    <h2 class="text-3xl font-bold text-white font-lexend mb-2">Configuración de Perfil</h2>
                    <p class="text-white/70 text-sm max-w-md">Administra tu información personal, seguridad y preferencias de la cuenta en un solo lugar.</p>
                </div>
                <!-- Decorative Elements -->
                <div class="absolute -right-10 -top-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute right-20 bottom-0 w-32 h-32 bg-stitch-secondary/20 rounded-full blur-2xl"></div>
                <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full border border-white/5 rounded-full scale-150"></div>
            </div>

            <div class="grid gap-8">
                <!-- Profile Information Card -->
                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden transition-all hover:shadow-md">
                    <div class="p-8 sm:p-10">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Delete User Card (Dangerous Area) -->
                <div class="bg-slate-50 rounded-[2rem] border-2 border-dashed border-red-100 overflow-hidden opacity-80 hover:opacity-100 transition-all">
                    <div class="p-8 sm:p-10">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
