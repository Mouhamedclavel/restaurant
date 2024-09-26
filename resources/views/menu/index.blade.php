@extends('layouts.app')

@section('content')
    @include('partials.dashboard_navbar', ['user' => $user])
    <main class="flex-grow relative min-h-screen">
        <!-- Image d'arrière-plan -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('https://s3-alpha-sig.figma.com/img/50f1/de24/70c618c674904eddc922480f3caca474?Expires=1728259200&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=SOjcfTU3a3qfGdutlhKAT~zdAOrMpDhTaRCLFg1MDD6OKPoF5Jy2ksy~MGsu1yi2qgqdVfBtec-3fRlCmmUcPz6Jr6NyvQpbTLOX6FRdwy~LhJMTKwpnDMh9RkC5HjuNHuYw-BizbU7WHl4LXHEmHrTEDcRuqlpwkn5xrOX7sM9kNHunCFZke-PpVAQFmTBXUAp1xvOJHDAcInUnO8qgI3mP7CHvd~2756098rj5LFstt~cRhIDhAK5yl7bvcnQ3utGlTwUDU6AH6fAPQyDOHgT5p2LPs34Iou~34wN3j~V-hOqJR4FCoxutf-4WemjWclwCbl~I472HuOr2h8A2KA__');"></div>

        <!-- Overlay pour améliorer la lisibilité -->
        <div class="absolute inset-0 bg-black opacity-60 z-10"></div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 relative z-20">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-white">Menu du Restaurant</h2>
                <a href="{{ route('menu.create') }}" class="bg-custom-btn hover:bg-custom-btn-hover text-white font-bold py-2 px-4 rounded">
                    Ajouter un item
                </a>
            </div>
            <div class="bg-white bg-opacity-80 rounded-lg shadow-md overflow-hidden backdrop-blur-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100 bg-opacity-90">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Prix</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Catégorie</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Disponible</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Photo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white bg-opacity-70 divide-y divide-gray-200">
                            @foreach ($menuItems as $item)
                                <tr class="hover:bg-gray-50 hover:bg-opacity-90">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->name }}</td>
                                    <td class="px-6 py-4">{{ Str::limit($item->description, 50) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($item->price, 2) }} FCFA</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->category }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->is_available ? 'Oui' : 'Non' }}</td>
                                    <td class="px-6 py-4">
                                        @if($item->photo)
                                            <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}" class="w-16 h-16 object-cover rounded">
                                        @else
                                            Pas de photo
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('menu.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Modifier</a>
                                        <form action="{{ route('menu.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet item ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection