@extends('layouts.app')

@section('content')
    @include('partials.dashboard_navbar', ['user' => $user])
    <main class="flex-grow">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow-md overflow-hidden md:col-span-1">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Résumé des commandes</h3>
                        <div style="height: 200px;">
                            <p class="text-center text-gray-500 mt-8">Graphique à venir</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden md:col-span-2">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Commandes récentes</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Numéro</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-4 py-2 whitespace-nowrap">1001</td>
                                        <td class="px-4 py-2 whitespace-nowrap">01/05/2023</td>
                                        <td class="px-4 py-2 whitespace-nowrap">En cours</td>
                                        <td class="px-4 py-2 whitespace-nowrap">25.00 €</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2 whitespace-nowrap">1002</td>
                                        <td class="px-4 py-2 whitespace-nowrap">30/04/2023</td>
                                        <td class="px-4 py-2 whitespace-nowrap">Terminée</td>
                                        <td class="px-4 py-2 whitespace-nowrap">32.50 €</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Menus disponibles</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <div class="border rounded-lg p-4">
                            <h4 class="font-semibold mb-2">Menu du jour</h4>
                            <p class="text-sm text-gray-600 mb-2">Entrée, plat, dessert du jour</p>
                            <p class="font-bold">15.00 €</p>
                            <a href="#" class="mt-2 inline-block bg-custom-btn hover:bg-custom-btn-hover text-white text-sm font-medium py-1.5 px-3 rounded">
                                Voir le menu
                            </a>
                        </div>
                        <div class="border rounded-lg p-4">
                            <h4 class="font-semibold mb-2">Menu végétarien</h4>
                            <p class="text-sm text-gray-600 mb-2">Salade, plat végétarien, dessert</p>
                            <p class="font-bold">18.00 €</p>
                            <a href="#" class="mt-2 inline-block bg-custom-btn hover:bg-custom-btn-hover text-white text-sm font-medium py-1.5 px-3 rounded">
                                Voir le menu
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const ctx = document.getElementById('orderChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['En cours', 'Terminées', 'Annulées'],
                datasets: [{
                    data: [1, 2, 3], // Exemple de données statiques
                    backgroundColor: ['#FFA500', '#4CAF50', '#F44336'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: false
                    }
                }
            }
        });
    </script>
@endsection