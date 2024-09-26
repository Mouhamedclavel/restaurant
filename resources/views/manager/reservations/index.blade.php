@extends('layouts.app')

@section('content')
    @include('partials.dashboard_navbar', ['user' => auth()->user()])
    <main class="flex-grow">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('https://s3-alpha-sig.figma.com/img/50f1/de24/70c618c674904eddc922480f3caca474?Expires=1728259200&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=SOjcfTU3a3qfGdutlhKAT~zdAOrMpDhTaRCLFg1MDD6OKPoF5Jy2ksy~MGsu1yi2qgqdVfBtec-3fRlCmmUcPz6Jr6NyvQpbTLOX6FRdwy~LhJMTKwpnDMh9RkC5HjuNHuYw-BizbU7WHl4LXHEmHrTEDcRuqlpwkn5xrOX7sM9kNHunCFZke-PpVAQFmTBXUAp1xvOJHDAcInUnO8qgI3mP7CHvd~2756098rj5LFstt~cRhIDhAK5yl7bvcnQ3utGlTwUDU6AH6fAPQyDOHgT5p2LPs34Iou~34wN3j~V-hOqJR4FCoxutf-4WemjWclwCbl~I472HuOr2h8A2KA__');"></div>

<!-- Overlay pour améliorer la lisibilité -->
<div class="absolute inset-0 bg-black opacity-60 z-10"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <h1 class="text-2xl font-semibold mb-6">Gestion des réservations</h1>
            

            @if($reservations->isEmpty())
                <p class="text-gray-500">Aucune réservation n'a été effectuée.</p>
            @else
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Heure</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Table</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Personnes</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($reservations as $reservation)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->user->firstname }} {{ $reservation->user->lastname }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->formatted_reservation_date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->reservation_time }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Table {{ $reservation->table->number }} ({{ $reservation->table->capacity }} pers.)</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->number_of_guests }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($reservation->status === 'confirmed') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst($reservation->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('manager.reservations.update-status', $reservation) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>En attente</option>
                                                <option value="confirmed" {{ $reservation->status === 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                                                <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $reservations->links() }}
                </div>
            @endif
        </div>
    </main>
@endsection