@extends('layouts.app')

@section('content')
    @include('partials.dashboard_navbar', ['user' => $user])

    <div class="relative min-h-screen">
        <!-- Background image and overlay -->
        <div class="absolute inset-0 z-0 bg-cover bg-center" style="background-image: url('https://s3-alpha-sig.figma.com/img/50f1/de24/70c618c674904eddc922480f3caca474?Expires=1728259200&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=SOjcfTU3a3qfGdutlhKAT~zdAOrMpDhTaRCLFg1MDD6OKPoF5Jy2ksy~MGsu1yi2qgqdVfBtec-3fRlCmmUcPz6Jr6NyvQpbTLOX6FRdwy~LhJMTKwpnDMh9RkC5HjuNHuYw-BizbU7WHl4LXHEmHrTEDcRuqlpwkn5xrOX7sM9kNHunCFZke-PpVAQFmTBXUAp1xvOJHDAcInUnO8qgI3mP7CHvd~2756098rj5LFstt~cRhIDhAK5yl7bvcnQ3utGlTwUDU6AH6fAPQyDOHgT5p2LPs34Iou~34wN3j~V-hOqJR4FCoxutf-4WemjWclwCbl~I472HuOr2h8A2KA__');"></div>
        <div class="absolute inset-0 bg-black opacity-50 z-10"></div>

        <div class="container mx-auto px-4 py-8 relative z-20">
            <h1 class="text-3xl font-bold text-white mb-8">Tableau de bord Manager</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                @php
                    $dashboardItems = [
                        ['title' => 'Réservations', 'count' => $reservationsCount, 'color' => 'blue'],
                        ['title' => 'Commandes', 'count' => $ordersCount, 'color' => 'yellow'],
                        ['title' => 'Tables', 'count' => $tablesCount, 'color' => 'green'],
                        ['title' => 'Menus', 'count' => $menusCount, 'color' => 'red'],
                    ];
                @endphp

                @foreach($dashboardItems as $item)
                    <div class="bg-white bg-opacity-90 rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $item['title'] }}</h2>
                        <p class="text-3xl font-bold text-{{ $item['color'] }}-500">{{ $item['count'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white bg-opacity-90 rounded-lg shadow p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Commandes récentes</h2>
                    @if($recentOrders->isNotEmpty())
                        <ul class="divide-y divide-gray-200">
                            @foreach($recentOrders as $order)
                                <li class="py-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">{{ $order->menuItem->name ?? 'N/A' }}</p>
                                            <p class="text-sm text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                        <div>
                                            @php
                                                $statusColors = [
                                                    'pending' => 'yellow',
                                                    'processing' => 'blue',
                                                    'completed' => 'green',
                                                    'cancelled' => 'red',
                                                ];
                                                $statusColor = $statusColors[$order->status] ?? 'gray';
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $statusColor }}-100 text-{{ $statusColor }}-800">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">Aucune commande récente.</p>
                    @endif
                </div>

                <div class="bg-white bg-opacity-90 rounded-lg shadow p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Menus disponibles</h2>
                    @if($availableMenus->isNotEmpty())
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($availableMenus as $menu)
                                <div class="border rounded-lg p-4 bg-white">
                                    <h3 class="text-lg font-semibold text-gray-700">{{ $menu->name }}</h3>
                                    <p class="text-gray-600">{{ $menu->description }}</p>
                                    <p class="text-gray-800 font-bold">{{ $menu->price }} FCFA</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Aucun menu disponible.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection