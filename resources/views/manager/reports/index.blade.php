@extends('layouts.app')

@section('content')
    @include('partials.dashboard_navbar', ['user' => auth()->user()])
    <main class="flex-grow">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <form action="{{ route('manager.reports.index') }}" method="GET" class="mb-6">
                <div class="flex items-center space-x-4">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Date de début</label>
                        <input type="date" name="start_date" id="start_date" value="{{ $startDate->format('Y-m-d') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">Date de fin</label>
                        <input type="date" name="end_date" id="end_date" value="{{ $endDate->format('Y-m-d') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="self-end">
                        <button type="submit" class="bg-custom-btn hover:bg-custom-btn-hover text-white font-bold py-2 px-4 rounded">
                            Filtrer
                        </button>
                    </div>
                </div>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h2 class="text-lg font-semibold mb-2">Commandes par jour</h2>
                    <div style="height: 200px;">
                        <canvas id="dailyOrdersChart"></canvas>
                    </div>
                </div>
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h2 class="text-lg font-semibold mb-2">Commandes par mois</h2>
                    <div style="height: 200px;">
                        <canvas id="monthlyOrdersChart"></canvas>
                    </div>
                </div>
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h2 class="text-lg font-semibold mb-2">Réservations par jour</h2>
                    <div style="height: 200px;">
                        <canvas id="dailyReservationsChart"></canvas>
                    </div>
                </div>
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h2 class="text-lg font-semibold mb-2">Réservations par mois</h2>
                    <div style="height: 200px;">
                        <canvas id="monthlyReservationsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const dailyOrdersData = @json($dailyOrders);
        const monthlyOrdersData = @json($monthlyOrders);
        const dailyReservationsData = @json($dailyReservations);
        const monthlyReservationsData = @json($monthlyReservations);

        // Fonction pour créer un graphique
        function createChart(ctx, labels, data, label, type = 'bar') {
            return new Chart(ctx, {
                type: type,
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Créer les graphiques
        createChart(
            document.getElementById('dailyOrdersChart').getContext('2d'),
            dailyOrdersData.map(item => item.date),
            dailyOrdersData.map(item => item.count),
            'Nombre de commandes'
        );

        createChart(
            document.getElementById('monthlyOrdersChart').getContext('2d'),
            monthlyOrdersData.map(item => `${item.year}-${item.month}`),
            monthlyOrdersData.map(item => item.count),
            'Nombre de commandes'
        );

        createChart(
            document.getElementById('dailyReservationsChart').getContext('2d'),
            dailyReservationsData.map(item => item.date),
            dailyReservationsData.map(item => item.count),
            'Nombre de réservations'
        );

        createChart(
            document.getElementById('monthlyReservationsChart').getContext('2d'),
            monthlyReservationsData.map(item => `${item.year}-${item.month}`),
            monthlyReservationsData.map(item => item.count),
            'Nombre de réservations'
        );
    </script>
@endsection