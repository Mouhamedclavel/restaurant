<nav class="bg-white shadow-sm relative">
    <!-- Image d'arrière-plan -->
    <!-- <div class="absolute inset-0 z-0 bg-cover bg-center" style="background-image: url('https://s3-alpha-sig.figma.com/img/7629/5147/7a0ffa143ec5e0a7d0839dce5cceac0f?Expires=1728259200&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=nKGzTMOrnKQ71OZjNKIUYJt5N2pevwPHgMW7NKf2GsWTt9mAV8fOe16y2VntC8tgICDW0GarltYSHK5JeF9wpnsGQugbeEj5vNX3Ivvr5S0dCbBclCQZLlvcOyAF7~ECl6Go-xRVb8bAKh~-UAwh75Nf408BQVYs~pPpTQvVVmThGHcXt~Zyr~7P87aeN2~JRykjDWeRbcGM2GVMYaq13J0NJPwvPkztEUxexw8ryX9XjVU-lPpFoWN-NdhFpxvM11sN14jMe9YfAaELt4vI~IZcGhCngKPgFMSydQAnR-SNCxcEfB3D5FP1Wwx~8QebOJawmYXNnsXMEKjSpTLbQg__');"></div> -->
    
    <!-- Overlay pour améliorer la lisibilité -->
    <div class="absolute inset-0 bg-black opacity-30 z-10"></div>
    
    <div class="container mx-auto px-3 sm:px-4 lg:px-6 relative z-20">
        <div class="flex justify-between h-14">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto rounded-full mr-2"><span class="text-white text-sm">  Restaurant</span>
                </div>
                <div class="hidden sm:ml-4 sm:flex sm:space-x-6">
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'border-custom-btn' : 'border-transparent' }} text-white hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Dashboard
                    </a>
                    @if($user->role === 'admin')
                        <a href="{{ route('manage.managers') }}" class="{{ request()->routeIs('manage.managers') ? 'border-custom-btn' : 'border-transparent' }} text-white hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Gestion des managers
                        </a>
                        <a href="{{ route('manage.customers') }}" class="{{ request()->routeIs('manage.customers') ? 'border-custom-btn' : 'border-transparent' }} text-white hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Gestion des clients
                        </a>
                        <a href="{{ route('menu.index') }}" class="{{ request()->routeIs('menu.*') ? 'border-custom-btn' : 'border-transparent' }} text-white hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Gestion des menus
                        </a>
                        <a href="{{ route('tables.index') }}" class="{{ request()->routeIs('tables.*') ? 'border-custom-btn' : 'border-transparent' }} text-white hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Gestion des tables
                        </a>
                    @elseif($user->role === 'manager')
                        <a href="{{ route('menu.index') }}" class="{{ request()->routeIs('menu.*') ? 'border-custom-btn' : 'border-transparent' }} text-white hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            menus
                        </a>
                        <a href="{{ route('tables.index') }}" class="{{ request()->routeIs('tables.*') ? 'border-custom-btn' : 'border-transparent' }} text-white hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            tables
                        </a>
                        <a href="{{ route('manager.reservations.index') }}" class="{{ request()->routeIs('manager.reservations.*') ? 'border-custom-btn' : 'border-transparent' }} text-white hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            réservations
                        </a>
                        <a href="{{ route('manager.orders.index') }}" class="{{ request()->routeIs('manager.orders.*') ? 'border-custom-btn' : 'border-transparent' }} text-white hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            commandes
                        </a>
                        <a href="{{ route('manager.reports.index') }}" class="{{ request()->routeIs('manager.reports.*') ? 'border-custom-btn' : 'border-transparent' }} text-white hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Rapports
                        </a>
                    @else
                        <a href="{{ route('user.orders') }}" class="{{ request()->routeIs('user.orders') ? 'border-custom-btn' : 'border-transparent' }} text-white hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                           Commandes
                        </a>
                        <a href="{{ route('user.reservations') }}" class="{{ request()->routeIs('user.reservations') ? 'border-custom-btn' : 'border-transparent' }} text-white hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            réservations
                        </a>
                        <a href="{{ route('menus.available') }}" class="{{ request()->routeIs('menus.available') ? 'border-custom-btn' : 'border-transparent' }} text-white hover:border-custom-btn-hover hover:text-custom-btn-hover inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Menus
                        </a>
                    @endif
                </div>
            </div>
            <div class="hidden sm:ml-4 sm:flex sm:items-center space-x-3">
                <span class="text-white text-sm">
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