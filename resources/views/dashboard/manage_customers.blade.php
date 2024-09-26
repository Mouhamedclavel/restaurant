@extends('layouts.app')

@section('content')
<div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('https://s3-alpha-sig.figma.com/img/50f1/de24/70c618c674904eddc922480f3caca474?Expires=1728259200&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=SOjcfTU3a3qfGdutlhKAT~zdAOrMpDhTaRCLFg1MDD6OKPoF5Jy2ksy~MGsu1yi2qgqdVfBtec-3fRlCmmUcPz6Jr6NyvQpbTLOX6FRdwy~LhJMTKwpnDMh9RkC5HjuNHuYw-BizbU7WHl4LXHEmHrTEDcRuqlpwkn5xrOX7sM9kNHunCFZke-PpVAQFmTBXUAp1xvOJHDAcInUnO8qgI3mP7CHvd~2756098rj5LFstt~cRhIDhAK5yl7bvcnQ3utGlTwUDU6AH6fAPQyDOHgT5p2LPs34Iou~34wN3j~V-hOqJR4FCoxutf-4WemjWclwCbl~I472HuOr2h8A2KA__');"></div>
<div class="absolute inset-0 bg-black opacity-60 z-10"></div>

@include('partials.dashboard_navbar', ['user' => $user])

<main class="flex-grow relative z-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Gestion des Clients</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Téléphone</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($customers as $customer)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $customer->firstname }} {{ $customer->lastname }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $customer->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $customer->phone }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($customer->status) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('toggle.user.status', $customer) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 font-medium text-white {{ $customer->status === 'enable' ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} rounded-md">
                                                {{ $customer->status === 'enable' ? 'Bloquer' : 'Débloquer' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
