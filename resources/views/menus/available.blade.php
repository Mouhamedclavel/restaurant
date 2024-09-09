@extends('layouts.app')

@section('content')
    @include('partials.dashboard_navbar', ['user' => $user])
    <main class="flex-grow">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <h1 class="text-2xl font-semibold mb-6">Menus disponibles</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($availableMenus as $menu)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
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
                                <button onclick="openOrderModal({{ $menu->id }}, '{{ $menu->name }}', {{ $menu->price }})" class="bg-custom-btn hover:bg-custom-btn-hover text-white text-sm font-medium py-2 px-4 rounded">
                                    Commander
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">Aucun menu disponible pour le moment.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $availableMenus->links() }}
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div id="orderModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
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
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-custom-btn text-base font-medium text-white hover:bg-custom-btn-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-btn sm:ml-3 sm:w-auto sm:text-sm">
                            Confirmer la commande
                        </button>
                        <button type="button" onclick="closeOrderModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-btn sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
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
    </script>
@endsection