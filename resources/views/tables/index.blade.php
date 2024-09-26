@extends('layouts.app')

@section('content')

    @include('partials.dashboard_navbar', ['user' => $user])
    <main class="flex-grow">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Gestion des Tables</h2>
                <button onclick="openModal()" class="bg-custom-btn hover:bg-custom-btn-hover text-white font-bold py-2 px-4 rounded">
                    Ajouter une table
                </button>
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
                                    <button onclick="openModal({{ $table->id }})" class="text-indigo-600 hover:text-indigo-900 mr-2">Modifier</button>
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

    <!-- Modal -->
    <div id="tableModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Ajouter/Modifier une table
                    </h3>
                    <div class="mt-2">
                        <form id="tableForm" method="POST">
                            @csrf
                            <div id="method"></div>
                            <div class="space-y-3">
                                <div>
                                    <label for="number" class="block text-sm font-medium text-gray-700">Numéro</label>
                                    <input type="number" name="number" id="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                </div>
                                <div>
                                    <label for="location" class="block text-sm font-medium text-gray-700">Emplacement</label>
                                    <select name="location" id="location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                        @foreach($locations as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="capacity" class="block text-sm font-medium text-gray-700">Capacité</label>
                                    <input type="number" name="capacity" id="capacity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                </div>
                                <div>
                                    <label for="is_available" class="inline-flex items-center">
                                        <input type="checkbox" name="is_available" id="is_available" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="1" checked>
                                        <span class="ml-2 text-sm text-gray-600">Disponible</span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" form="tableForm" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Enregistrer
                    </button>
                    <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(tableId = null) {
            const modal = document.getElementById('tableModal');
            const form = document.getElementById('tableForm');
            const methodDiv = document.getElementById('method');

            if (tableId) {
                // Mode édition
                form.action = `/tables/${tableId}`;
                methodDiv.innerHTML = '<input type="hidden" name="_method" value="PUT">';
                
                // Récupérer les données de la table et remplir le formulaire
                fetch(`/tables/${tableId}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('number').value = data.number;
                        document.getElementById('location').value = data.location;
                        document.getElementById('capacity').value = data.capacity;
                        document.getElementById('is_available').checked = data.is_available;
                    });
            } else {
                // Mode création
                form.action = '/tables';
                methodDiv.innerHTML = '';
                form.reset();
            }

            modal.classList.remove('hidden');
        }

        function closeModal() {
            const modal = document.getElementById('tableModal');
            modal.classList.add('hidden');
        }
    </script>
@endsection