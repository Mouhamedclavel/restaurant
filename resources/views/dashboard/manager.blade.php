@extends('layouts.app')

@section('content')
    @include('partials.dashboard_navbar')
    <main class="flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Tableau de bord Manager</h2>
                    <p class="text-gray-600">Bienvenue, {{ $user->firstname }} {{ $user->lastname }}!</p>
                    <!-- Ajoutez ici le contenu spécifique au manager -->
                </div>
            </div>
        </div>
    </main>
@endsection