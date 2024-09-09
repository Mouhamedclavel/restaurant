@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-sm bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-4 py-3">
            <h2 class="text-xl font-light text-center text-soft-text mb-4">Inscription</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="space-y-3">
                    <div>
                        <label for="firstname" class="block text-xs font-medium text-soft-text mb-1">Prénom</label>
                        <input type="text" name="firstname" id="firstname" class="w-full px-2 py-1 text-sm border border-soft-secondary rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-soft-primary focus:border-soft-primary" required>
                    </div>
                    <div>
                        <label for="lastname" class="block text-xs font-medium text-soft-text mb-1">Nom</label>
                        <input type="text" name="lastname" id="lastname" class="w-full px-2 py-1 text-sm border border-soft-secondary rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-soft-primary focus:border-soft-primary" required>
                    </div>
                    <div>
                        <label for="phone" class="block text-xs font-medium text-soft-text mb-1">Téléphone</label>
                        <input type="text" name="phone" id="phone" class="w-full px-2 py-1 text-sm border border-soft-secondary rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-soft-primary focus:border-soft-primary" required>
                    </div>
                    <div>
                        <label for="email" class="block text-xs font-medium text-soft-text mb-1">Email</label>
                        <input type="email" name="email" id="email" class="w-full px-2 py-1 text-sm border border-soft-secondary rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-soft-primary focus:border-soft-primary" required>
                    </div>
                    <div>
                        <label for="password" class="block text-xs font-medium text-soft-text mb-1">Mot de passe</label>
                        <input type="password" name="password" id="password" class="w-full px-2 py-1 text-sm border border-soft-secondary rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-soft-primary focus:border-soft-primary" required>
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-xs font-medium text-soft-text mb-1">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-2 py-1 text-sm border border-soft-secondary rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-soft-primary focus:border-soft-primary" required>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="w-full bg-custom-btn hover:bg-custom-btn-hover text-white text-sm font-medium py-1.5 px-3 rounded-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-custom-btn focus:ring-offset-2">
                        S'inscrire
                    </button>
                </div>
            </form>
            <div class="mt-4 text-center text-sm">
                <p class="text-soft-text">Vous avez déjà un compte ?</p>
                <a href="{{ route('login') }}" class="text-custom-btn hover:underline">Connectez-vous ici</a>
            </div>
        </div>
    </div>
</div>
@endsection