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
            <h1 class="text-3xl font-semibold text-white">Menus disponibles</h1>
            <button onclick="openReservationModal()" class="bg-custom-btn hover:bg-custom-btn-hover text-white text-sm font-medium py-2 px-4 rounded transition duration-300 ease-in-out transform hover:scale-105">
                Réserver une table
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($availableMenus as $menu)
            <div class="bg-white bg-opacity-80 rounded-lg shadow-md overflow-hidden backdrop-blur-sm transition duration-300 ease-in-out transform hover:scale-105">
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
                        <button onclick="openOrderModal('{{ $menu->id }}', '{{ $menu->name }}', '{{ $menu->price }}')"
                            class="bg-custom-btn hover:bg-custom-btn-hover text-white text-sm font-medium py-2 px-4 rounded transition duration-300 ease-in-out transform hover:scale-105">
                            Commander
                        </button>

                    </div>
                </div>
            </div>
            @empty
            <p class="col-span-full text-center text-white text-lg">Aucun menu disponible pour le moment.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $availableMenus->links() }}
        </div>
    </div>
</main>

<!-- Modal de commande -->
<div id="orderModal" class="fixed z-50 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="orderForm" action="{{ route('orders.store') }}" method="POST">
                @csrf
                <input type="hidden" name="menu_item_id" id="menuItemId">
                <input type="hidden" name="price" id="menuItemPrice">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title"></h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Veuillez sélectionner la quantité :</p>
                                <input type="number" name="quantity" id="quantity" min="1" value="1" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-custom-btn focus:border-custom-btn sm:text-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-custom-btn text-base font-medium text-white hover:bg-custom-btn-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-btn sm:ml-3 sm:w-auto sm:text-sm transition duration-300 ease-in-out transform hover:scale-105">
                        Confirmer la commande
                    </button>
                    <button type="button" onclick="closeOrderModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-btn sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition duration-300 ease-in-out transform hover:scale-105">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de réservation -->
<div id="reservationModal" class="fixed z-50 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="reservationForm" action="{{ route('reservations.store') }}" method="POST">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Réserver une table</h3>
                            <div class="mt-2">
                                <div class="mb-4">
                                    <label for="table_id" class="block text-sm font-medium text-gray-700">Table</label>
                                    <select name="table_id" id="table_id" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-custom-btn focus:border-custom-btn sm:text-sm">
                                        <option value="">Sélectionnez une table</option>
                                        @foreach($availableTables as $table)
                                        <option value="{{ $table->id }}">Table {{ $table->number }} ({{ $table->capacity }} personnes)</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="reservation_date" class="block text-sm font-medium text-gray-700">Date de réservation</label>
                                    <input type="date" name="reservation_date" id="reservation_date" required class="mt-1 focus:ring-custom-btn focus:border-custom-btn block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div class="mb-4">
                                    <label for="reservation_time" class="block text-sm font-medium text-gray-700">Heure de réservation</label>
                                    <input type="time" name="reservation_time" id="reservation_time" required class="mt-1 focus:ring-custom-btn focus:border-custom-btn block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div class="mb-4">
                                    <label for="number_of_guests" class="block text-sm font-medium text-gray-700">Nombre de personnes</label>
                                    <input type="number" name="number_of_guests" id="number_of_guests" min="1" required class="mt-1 focus:ring-custom-btn focus:border-custom-btn block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-custom-btn text-base font-medium text-white hover:bg-custom-btn-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-btn sm:ml-3 sm:w-auto sm:text-sm transition duration-300 ease-in-out transform hover:scale-105">
                        Confirmer la réservation
                    </button>
                    <button type="button" onclick="closeReservationModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-btn sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition duration-300 ease-in-out transform hover:scale-105">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openOrderModal(menuId, menuName, menuPrice) {
        document.getElementById('orderModal').classList.remove('hidden');
        document.getElementById('modal-title').textContent = 'Commander ' + menuName;
        document.getElementById('menuItemId').value = menuId;
        document.getElementById('menuItemPrice').value = menuPrice;
    }

    function closeOrderModal() {
        document.getElementById('orderModal').classList.add('hidden');
    }

    function openReservationModal() {
        document.getElementById('reservationModal').classList.remove('hidden');
    }

    function closeReservationModal() {
        document.getElementById('reservationModal').classList.add('hidden');
    }
</script>
@endsection