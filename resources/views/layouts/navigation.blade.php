<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ Auth::user()->user_type === 'maestro' ? route('dashboard.mentor') : route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @php
                        $dashboardRoute = match(Auth::user()->user_type) {
                            'maestro' => route('dashboard.mentor'),
                            'administrador' => route('admin.dashboard'),
                            default => route('dashboard'),
                        };
                    @endphp
                    <x-nav-link :href="$dashboardRoute" :active="request()->routeIs('dashboard*') || request()->routeIs('admin.dashboard')">
                        {{ __('Inicio') }}
                    </x-nav-link>
                    @if (Auth::user()->user_type === 'administrador')
                        <x-nav-link :href="route('usuarios.index')" :active="request()->routeIs('usuarios.index')">
                            {{ __('Gestión Usuarios') }}
                        </x-nav-link>
                        <x-nav-link :href="route('careers.manage')" :active="request()->routeIs('careers.*')">
                            {{ __('Carreras') }}
                        </x-nav-link>
                        <x-nav-link :href="route('companies.manage')" :active="request()->routeIs('companies.manage')">
                            {{ __('Empresas') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->user_type === 'maestro')
                        <x-nav-link :href="route('challenges.manage')" :active="request()->routeIs('challenges.*')">
                            {{ __('Gestionar Retos') }}
                        </x-nav-link>
                        <x-nav-link :href="route('courses.index')" :active="request()->routeIs('courses.index')">
                            {{ __('Entregas') }}
                        </x-nav-link>
                        <x-nav-link href="#" :active="false">
                            {{ __('Estudiantes') }}
                        </x-nav-link>
                        <x-nav-link href="#" :active="false">
                            {{ __('Reportes') }}
                        </x-nav-link>
                    @elseif(Auth::user()->user_type === 'estudiante')
                        <x-nav-link :href="route('courses.index')" :active="request()->routeIs('courses.index')">
                            {{ __('Mis Cursos') }}
                        </x-nav-link>
                        <x-nav-link :href="route('companies.index')" :active="request()->routeIs('companies.*')">
                            {{ __('Empresas Aliadas') }}
                        </x-nav-link>
                        <x-nav-link :href="route('portfolio.index')" :active="request()->routeIs('portfolio.index')">
                            {{ __('Perfiles Públicos') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Right Side: Notifications and User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                <!-- Notifications Bell -->
                <div class="relative">
                    <x-dropdown align="right" width="w-96">
                        <x-slot name="trigger">
                            <button class="relative inline-flex items-center p-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31a8.967 8.967 0 0 1-2.312-6.022c0-4.474-3.484-8.113-7.857-8.113s-7.857 3.639-7.857 8.113c0 2.457-.991 4.678-2.585 6.262M14.857 17.082a23.848 23.848 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                                </svg>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                                        {{ auth()->user()->unreadNotifications->count() }}
                                    </span>
                                @endif
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Notificaciones') }}
                            </div>

                            <div class="max-h-64 overflow-y-auto">
                                @forelse(auth()->user()->unreadNotifications as $notification)
                                    <x-dropdown-link :href="route('notifications.read', $notification->id)" class="border-b border-gray-100">
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-gray-800">{{ $notification->data['message'] }}</span>
                                            <span class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                                        </div>
                                    </x-dropdown-link>
                                @empty
                                    <div class="px-4 py-2 text-sm text-gray-500">
                                        {{ __('Sin notificaciones nuevas') }}
                                    </div>
                                @endforelse
                            </div>

                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <div class="border-t border-gray-100">
                                    <form method="POST" action="{{ route('notifications.markAllAsRead') }}">
                                        @csrf
                                        <button type="submit" class="block w-full px-4 py-2 text-left text-xs leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                            {{ __('Marcar todas como leídas') }}
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/'.Auth::user()->profile_photo) }}" class="w-8 h-8 rounded-full object-cover mr-2">
                            @endif
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="$dashboardRoute" :active="request()->routeIs('dashboard*') || request()->routeIs('admin.dashboard')">
                {{ __('Inicio') }}
            </x-responsive-nav-link>

            @if(Auth::user()->user_type === 'administrador')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Panel de Control') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('usuarios.index')" :active="request()->routeIs('usuarios.index')">
                    {{ __('Gestión Usuarios') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('careers.manage')" :active="request()->routeIs('careers.*')">
                    {{ __('Carreras') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('companies.manage')" :active="request()->routeIs('companies.manage')">
                    {{ __('Empresas') }}
                </x-responsive-nav-link>
            @endif

            @if(Auth::user()->user_type === 'maestro')
                <x-responsive-nav-link :href="route('challenges.manage')" :active="request()->routeIs('challenges.*')">
                    {{ __('Gestionar Retos') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('courses.index')" :active="request()->routeIs('courses.index')">
                    {{ __('Entregas') }}
                </x-responsive-nav-link>
            @elseif(Auth::user()->user_type === 'estudiante')
                <x-responsive-nav-link :href="route('courses.index')" :active="request()->routeIs('courses.index')">
                    {{ __('Mis Cursos') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('companies.index')" :active="request()->routeIs('companies.*')">
                    {{ __('Empresas Aliadas') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Perfil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Cerrar sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
