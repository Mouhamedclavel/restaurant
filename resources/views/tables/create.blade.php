@extends('layouts.app')

@section('content')
    @include('partials.dashboard_navbar', ['user' => $user])
    <main class="flex-grow">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-4 py-3">
                    <h2 class="text-xl font-light text-center text-soft-text mb-4">Ajouter une nouvelle table</h2>
                    <form action="{{ route('tables.store') }}" method="POST">
                        @csrf
                        <div class="space-y-3">
                            <div>
                                <label for="number" class="block text-xs font-medium text-soft-text mb-1">Numéro</label>
                                <input type="number" name="number" id="number" class="w-full px-2 py-1 text-sm border border-soft-secondary rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-soft-primary focus:border-soft-primary" required>
                            </div>
                            <div>
                                <label for="location" class="block text-xs font-medium text-soft-text mb-1">Emplacement</label>
                                <select name="location" id="location" class="w-full px-2 py-1 text-sm border border-soft-secondary rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-soft-primary focus:border-soft-primary" required>
                                    @foreach($locations as $value => $label)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="capacity" class="block text-xs font-medium text-soft-text mb-1">Capacité</label>
                                <input type="number" name="capacity" id="capacity" class="w-full px-2 py-1 text-sm border border-soft-secondary rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-soft-primary focus:border-soft-primary" required>
                            </div>
                            <div>
                                <label for="is_available" class="inline-flex items-center">
                                    <input type="checkbox" name="is_available" id="is_available" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="1" checked>
                                    <span class="ml-2 text-sm text-gray-600">Disponible</span>
                                </label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="w-full bg-custom-btn hover:bg-custom-btn-hover text-white text-sm font-medium py-1.5 px-3 rounded-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-custom-btn focus:ring-offset-2">
                                Ajouter la table
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection