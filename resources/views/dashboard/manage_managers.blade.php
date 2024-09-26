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
    <main class="flex-grow bg-custom min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="bg-white bg-opacity-90 rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Gestion des Managers</h3>
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
                                @foreach ($managers as $manager)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $manager->firstname }} {{ $manager->lastname }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $manager->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $manager->phone }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($manager->status) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('toggle.user.status', $manager) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 font-medium text-white {{ $manager->status === 'enable' ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} rounded-md">
                                                    {{ $manager->status === 'enable' ? 'Bloquer' : 'Débloquer' }}
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