@extends('layouts.app')

@section('content')
<style>
        .bg-custom {
            background-image: url('https://s3-alpha-sig.figma.com/img/50f1/de24/70c618c674904eddc922480f3caca474?Expires=1728259200&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=SOjcfTU3a3qfGdutlhKAT~zdAOrMpDhTaRCLFg1MDD6OKPoF5Jy2ksy~MGsu1yi2qgqdVfBtec-3fRlCmmUcPz6Jr6NyvQpbTLOX6FRdwy~LhJMTKwpnDMh9RkC5HjuNHuYw-BizbU7WHl4LXHEmHrTEDcRuqlpwkn5xrOX7sM9kNHunCFZke-PpVAQFmTBXUAp1xvOJHDAcInUnO8qgI3mP7CHvd~2756098rj5LFstt~cRhIDhAK5yl7bvcnQ3utGlTwUDU6AH6fAPQyDOHgT5p2LPs34Iou~34wN3j~V-hOqJR4FCoxutf-4WemjWclwCbl~I472HuOr2h8A2KA__');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>

    @include('partials.dashboard_navbar', ['user' => $user])
    <main class="flex-grow">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow-md overflow-hidden md:col-span-1">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Répartition des utilisateurs</h3>
                        <div style="height: 200px;">
                            <canvas id="userChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden md:col-span-2">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Utilisateurs récents</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($recentCustomers->merge($recentManagers)->sortByDesc('created_at')->take(5) as $user)
                                        <tr>
                                            <td class="px-4 py-2 whitespace-nowrap">{{ $user->firstname }} {{ $user->lastname }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap">{{ $user->email }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap">{{ ucfirst($user->role) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const ctx = document.getElementById('userChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Clients', 'Managers'],
                datasets: [{
                    data: [{{ $customerCount }}, {{ $managerCount }}],
                    backgroundColor: ['#4CAF50', '#2196F3'],
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