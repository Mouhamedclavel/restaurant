@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Tableau de bord Client</h2>
        <p class="text-gray-600">Bienvenue, {{ $user->firstname }} {{ $user->lastname }}!</p>
        <!-- Ajoutez ici le contenu spécifique au client -->
        
        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                Déconnexion
            </button>
        </form>
    </div>
</div>
@endsection