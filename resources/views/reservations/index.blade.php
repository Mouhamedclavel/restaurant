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

    @include('partials.dashboard_navbar', ['user' => auth()->user()])
    <main class="flex-grow bg-custom min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <h1 class="text-2xl font-semibold mb-6 text-white">Mes réservations</h1>

            @if($reservations->isEmpty())
                <p class="text-white">Vous n'avez pas encore de réservation.</p>
            @else
                <div class="bg-white bg-opacity-80 shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Numéro de réservation</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Heure</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Table</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre de personnes</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white bg-opacity-80 divide-y divide-gray-200">
                            @foreach($reservations as $reservation)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->reservation_date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->reservation_time }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Table {{ $reservation->table->number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->number_of_guests }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($reservation->status === 'confirmed') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            @switch($reservation->status)
                                                @case('pending')
                                                    En attente
                                                    @break
                                                @case('confirmed')
                                                    Confirmée
                                                    @break
                                                @case('cancelled')
                                                    Annulée
                                                    @break
                                                @default
                                                    {{ ucfirst($reservation->status) }}
                                            @endswitch
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($reservation->status === 'pending')
                                            <form action="{{ route('reservations.cancel', $reservation) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Annuler</button>
                                            </form>
                                        @endif
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