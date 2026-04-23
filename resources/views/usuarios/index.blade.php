<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mb-8 p-10 rounded-[2rem] bg-stitch-primary text-white relative overflow-hidden shadow-2xl">
                <div class="relative z-10">
                    <h1 class="font-lexend text-4xl font-bold">Directorio de Usuarios</h1>
                    <p class="text-lg text-white/80 mt-2 max-w-2xl">Aquí puedes consultar a todos los usuarios que forman parte de la plataforma, tanto estudiantes como mentores.</p>
                </div>
                <!-- Abstract decoration -->
                <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-stitch-secondary/20 rounded-full blur-3xl"></div>
                <div class="absolute right-10 top-10 w-24 h-24 border-4 border-white/10 rounded-full"></div>
            </div>

            <div class="bg-white rounded-stitch shadow-sm border border-stitch-outline/10 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-stitch-background text-stitch-primary font-lexend text-sm uppercase tracking-wider border-b border-stitch-outline/10">
                                <th class="p-4 font-bold">Nombre</th>
                                <th class="p-4 font-bold">Correo Electrónico</th>
                                <th class="p-4 font-bold">Rol</th>
                                <th class="p-4 font-bold">Fecha de Registro</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stitch-outline/10">
                            @forelse($users as $user)
                                <tr class="hover:bg-stitch-background/50 transition-colors">
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-stitch-secondary/10 text-stitch-secondary flex items-center justify-center font-bold font-lexend">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <span class="font-medium text-stitch-primary">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="p-4 text-stitch-on-surface-variant">{{ $user->email }}</td>
                                    <td class="p-4">
                                        @if($user->user_type === 'maestro')
                                            <span class="px-3 py-1 bg-[#F3E5F5] text-[#8E24AA] rounded-full text-xs font-bold uppercase tracking-wider">Mentor</span>
                                        @else
                                            <span class="px-3 py-1 bg-[#E3F2FD] text-[#1976D2] rounded-full text-xs font-bold uppercase tracking-wider">Estudiante</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-stitch-on-surface-variant text-sm">
                                        {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'Desconocido' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-8 text-center text-stitch-on-surface-variant italic">
                                        No se encontraron usuarios registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
