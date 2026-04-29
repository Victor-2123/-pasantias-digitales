<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <!-- Hero -->
            <div class="mb-8 p-10 rounded-[2rem] bg-stitch-primary text-white relative overflow-hidden shadow-2xl">
                <div class="relative z-10">
                    <h1 class="font-lexend text-4xl font-bold">Gestión de Usuarios</h1>
                    <p class="text-lg text-white/80 mt-2 max-w-2xl">Administra las cuentas, roles y estados de todos los miembros de la plataforma.</p>
                </div>
                <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-stitch-secondary/20 rounded-full blur-3xl"></div>
                <div class="absolute right-10 top-10 w-24 h-24 border-4 border-white/10 rounded-full"></div>
            </div>

            @if(session('success'))
                <div class="mb-6 flex items-center gap-3 p-4 bg-green-50 border border-green-200 text-green-800 rounded-stitch text-sm font-semibold">
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Search Bar -->
            <form method="GET" action="{{ route('usuarios.index') }}" class="mb-6">
                <div class="relative max-w-lg">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-stitch-on-surface-variant" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input
                        id="search-users"
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="Buscar por nombre o correo..."
                        class="w-full pl-12 pr-4 py-3 border border-stitch-outline/30 rounded-stitch text-sm focus:outline-none focus:ring-2 focus:ring-stitch-primary/30 focus:border-stitch-primary transition bg-white shadow-sm"
                    >
                    @if($search ?? false)
                        <a href="{{ route('usuarios.index') }}" class="absolute right-4 top-1/2 -translate-y-1/2 text-stitch-on-surface-variant hover:text-stitch-primary text-xs font-bold">✕ Limpiar</a>
                    @endif
                </div>
            </form>

            @if($search ?? false)
                <p class="mb-4 text-sm text-stitch-on-surface-variant">
                    Mostrando <strong>{{ $users->count() }}</strong> resultado(s) para "<span class="text-stitch-primary font-semibold">{{ $search }}</span>"
                </p>
            @endif

            <!-- Users Table -->
            <div class="bg-white rounded-stitch shadow-sm border border-stitch-outline/10 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-stitch-background text-stitch-primary font-lexend text-sm uppercase tracking-wider border-b border-stitch-outline/10">
                                <th class="p-4 font-bold">Usuario</th>
                                <th class="p-4 font-bold">Correo Electrónico</th>
                                <th class="p-4 font-bold">Rol</th>
                                <th class="p-4 font-bold">Estado</th>
                                <th class="p-4 font-bold">Registro</th>
                                <th class="p-4 font-bold text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stitch-outline/10">
                            @forelse($users as $user)
                                <tr class="hover:bg-stitch-background/50 transition-colors {{ $user->is_suspended ? 'opacity-60' : '' }}">
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full {{ $user->is_suspended ? 'bg-gray-200 text-gray-400' : 'bg-stitch-secondary/10 text-stitch-secondary' }} flex items-center justify-center font-bold font-lexend flex-shrink-0">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <span class="font-medium text-stitch-primary">{{ $user->name }}</span>
                                                @if($user->is_suspended)
                                                    <span class="ml-2 text-xs text-red-500 font-semibold">(Suspendido)</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-stitch-on-surface-variant text-sm">{{ $user->email }}</td>
                                    <td class="p-4">
                                        {{-- Role badge --}}
                                        @if($user->user_type === 'maestro')
                                            <span class="px-3 py-1 bg-[#F3E5F5] text-[#8E24AA] rounded-full text-xs font-bold uppercase tracking-wider">Mentor</span>
                                        @elseif($user->user_type === 'administrador')
                                            <span class="px-3 py-1 bg-[#FFF3E0] text-[#E65100] rounded-full text-xs font-bold uppercase tracking-wider">Admin</span>
                                        @else
                                            <span class="px-3 py-1 bg-[#E3F2FD] text-[#1976D2] rounded-full text-xs font-bold uppercase tracking-wider">Estudiante</span>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        @if($user->is_suspended)
                                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">Suspendido</span>
                                        @else
                                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">Activo</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-stitch-on-surface-variant text-sm">
                                        {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'Desconocido' }}
                                    </td>
                                    <td class="p-4">
                                        <div class="flex items-center justify-end gap-2">
                                            {{-- Change Role form --}}
                                            @if(auth()->id() !== $user->id)
                                                <form method="POST" action="{{ route('usuarios.changeRole', $user) }}" class="flex items-center gap-1">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="user_type"
                                                            onchange="this.form.submit()"
                                                            class="text-xs border border-stitch-outline/30 rounded-lg px-2 py-1.5 focus:outline-none focus:ring-1 focus:ring-stitch-primary bg-white text-stitch-on-surface">
                                                        <option value="estudiante" {{ $user->user_type === 'estudiante' ? 'selected' : '' }}>Estudiante</option>
                                                        <option value="maestro"    {{ $user->user_type === 'maestro'    ? 'selected' : '' }}>Mentor</option>
                                                        <option value="administrador" {{ $user->user_type === 'administrador' ? 'selected' : '' }}>Admin</option>
                                                    </select>
                                                </form>

                                                {{-- Suspend / Reactivate --}}
                                                <form method="POST" action="{{ route('usuarios.toggleSuspend', $user) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="px-3 py-1.5 rounded-lg text-xs font-bold transition-colors {{ $user->is_suspended ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-red-100 text-red-700 hover:bg-red-200' }}">
                                                        {{ $user->is_suspended ? '✓ Reactivar' : '⊘ Suspender' }}
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-xs text-stitch-on-surface-variant italic">Tu cuenta</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-stitch-on-surface-variant italic">
                                        No se encontraron usuarios{{ ($search ?? false) ? " para \"$search\"" : '' }}.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Summary -->
            <div class="mt-4 text-xs text-stitch-on-surface-variant text-right">
                Total: {{ $users->count() }} usuario(s)
            </div>

        </div>
    </div>
</x-app-layout>
