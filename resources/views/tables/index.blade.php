@extends('layouts.app')

@section('content')
    @include('partials.dashboard_navbar', ['user' => $user])
    <main class="flex-grow">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Gestion des Tables</h2>
                <a href="{{ route('tables.create') }}" class="bg-custom-btn hover:bg-custom-btn-hover text-white font-bold py-2 px-4 rounded">
                    Ajouter une table
                </a>
            </div>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Numéro</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Emplacement</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacité</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Disponible</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($tables as $table)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $table->number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $table->location }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $table->capacity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $table->is_available ? 'Oui' : 'Non' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('tables.edit', $table->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Modifier</a>
                                    <form action="{{ route('tables.destroy', $table->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette table ?')">Supprimer</button>
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