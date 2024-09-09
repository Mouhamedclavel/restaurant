@extends('layouts.app')

@section('content')
    @include('partials.dashboard_navbar', ['user' => $user])
    <main class="flex-grow">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Menu du Restaurant</h2>
                <a href="{{ route('menu.create') }}" class="bg-custom-btn hover:bg-custom-btn-hover text-white font-bold py-2 px-4 rounded">
                    Ajouter un item
                </a>
            </div>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Disponible</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($menuItems as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->name }}</td>
                                <td class="px-6 py-4">{{ Str::limit($item->description, 50) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ number_format($item->price, 2) }} €</td>
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
    </main>
@endsection