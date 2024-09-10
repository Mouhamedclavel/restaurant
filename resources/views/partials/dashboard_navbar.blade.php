<nav class="bg-white shadow-sm">
    <div class="container mx-auto px-3 sm:px-4 lg:px-6">
        <div class="flex justify-between h-14">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <span class="text-xl font-semibold text-custom-btn">{{ config('app.name', 'Laravel') }}</span>
                </div>
                <div class="hidden sm:ml-4 sm:flex sm:space-x-6">
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'border-custom-btn' : 'border-transparent' }} text-soft-text hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Dashboard
                    </a>
                    @if($user->role === 'admin')
                        <a href="{{ route('manage.managers') }}" class="{{ request()->routeIs('manage.managers') ? 'border-custom-btn' : 'border-transparent' }} text-soft-text hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Gestion des managers
                        </a>
                        <a href="{{ route('manage.customers') }}" class="{{ request()->routeIs('manage.customers') ? 'border-custom-btn' : 'border-transparent' }} text-soft-text hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Gestion des clients
                        </a>
                        <a href="{{ route('menu.index') }}" class="{{ request()->routeIs('menu.*') ? 'border-custom-btn' : 'border-transparent' }} text-soft-text hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Gestion des menus
                        </a>
                        <a href="{{ route('tables.index') }}" class="{{ request()->routeIs('tables.*') ? 'border-custom-btn' : 'border-transparent' }} text-soft-text hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Gestion des tables
                        </a>
                    @elseif($user->role === 'manager')
                        <a href="{{ route('menu.index') }}" class="{{ request()->routeIs('menu.*') ? 'border-custom-btn' : 'border-transparent' }} text-soft-text hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Gestion des menus
                        </a>
                        <a href="{{ route('tables.index') }}" class="{{ request()->routeIs('tables.*') ? 'border-custom-btn' : 'border-transparent' }} text-soft-text hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Gestion des tables
                        </a>
                        <a href="#" class="{{ request()->is('reports*') ? 'border-custom-btn' : 'border-transparent' }} text-soft-text hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Rapports
                        </a>
                    @else
                        <a href="{{ route('user.orders') }}" class="{{ request()->routeIs('user.orders') ? 'border-custom-btn' : 'border-transparent' }} text-soft-text hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Mes commandes
                        </a>
                        <a href="{{ route('user.reservations') }}" class="{{ request()->routeIs('user.reservations') ? 'border-custom-btn' : 'border-transparent' }} text-soft-text hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Mes réservations
                        </a>
                        <a href="{{ route('menus.available') }}" class="{{ request()->routeIs('menus.available') ? 'border-custom-btn' : 'border-transparent' }} text-soft-text hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Menus disponibles
                        </a>
                        <a href="#" class="{{ request()->is('profile*') ? 'border-custom-btn' : 'border-transparent' }} text-soft-text hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Mon profil
                        </a>
                    @endif
                </div>
            </div>
            <div class="hidden sm:ml-4 sm:flex sm:items-center space-x-3">
                <span class="text-soft-text text-sm">
                    {{ ucfirst($user->role) }} : {{ $user->firstname }} {{ $user->lastname }}
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-custom-btn hover:bg-custom-btn-hover text-white text-sm font-medium py-1.5 px-3 rounded">
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>