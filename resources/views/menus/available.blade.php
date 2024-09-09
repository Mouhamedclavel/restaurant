@extends('layouts.app')

@section('content')
    @include('partials.dashboard_navbar', ['user' => $user])
    <main class="flex-grow">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <h1 class="text-2xl font-semibold mb-6">Menus disponibles</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($availableMenus as $menu)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if($menu->photo)
                            <img src="{{ asset('storage/' . $menu->photo) }}" alt="{{ $menu->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">Pas d'image</span>
                            </div>
                        @endif
                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-2">{{ $menu->name }}</h2>
                            <p class="text-gray-600 mb-4">{{ Str::limit($menu->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-custom-btn">{{ number_format($menu->price, 0, ',', ' ') }} FCFA</span>
                                <a href="{{ route('menus.show', $menu->id) }}" class="bg-custom-btn hover:bg-custom-btn-hover text-white text-sm font-medium py-2 px-4 rounded">
                                    Voir détails
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">Aucun menu disponible pour le moment.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $availableMenus->links() }}
            </div>
        </div>
    </main>
@endsection