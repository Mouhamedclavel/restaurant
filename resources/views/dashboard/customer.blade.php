@extends('layouts.app')

@section('content')
    @include('partials.dashboard_navbar', ['user' => $user])
    <main class="flex-grow">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <h1 class="text-2xl font-semibold mb-6">Tableau de bord</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow-md overflow-hidden md:col-span-1">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Résumé des commandes</h3>
                        <div class="space-y-2">
                            <p>En attente : <span class="font-semibold">{{ $pendingOrdersCount }}</span></p>
                            <p>Terminées : <span class="font-semibold">{{ $completedOrdersCount }}</span></p>
                            <p>Annulées : <span class="font-semibold">{{ $cancelledOrdersCount }}</span></p>
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
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Menu</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($recentOrders as $order)
                                        <tr>
                                            <td class="px-4 py-2 whitespace-nowrap">{{ $order->id }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap">{{ $order->created_at->format('d/m/Y') }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap">{{ $order->menuItem->name }}</td>
                                            <td class="px-4 py-2 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($order->status === 'completed') bg-green-100 text-green-800
                                                    @else bg-red-100 text-red-800
                                                    @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-2 whitespace-nowrap">{{ number_format($order->price * $order->quantity, 0, ',', ' ') }} FCFA</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-4 py-2 text-center text-gray-500">Aucune commande récente</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Menus populaires</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($availableMenus as $menu)
                            <div class="border rounded-lg p-4">
                                <h4 class="font-semibold mb-2">{{ $menu->name }}</h4>
                                <p class="text-sm text-gray-600 mb-2">{{ Str::limit($menu->description, 50) }}</p>
                                <p class="font-bold">{{ number_format($menu->price, 0, ',', ' ') }} FCFA</p>
                                <a href="{{ route('menus.show', $menu->id) }}" class="mt-2 inline-block bg-custom-btn hover:bg-custom-btn-hover text-white text-sm font-medium py-1.5 px-3 rounded">
                                    Voir le menu
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection