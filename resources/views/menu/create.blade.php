@extends('layouts.app')

@section('content')
    @include('partials.dashboard_navbar', ['user' => $user])
    <main class="flex-grow">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-4 py-3">
                    <h2 class="text-xl font-light text-center text-soft-text mb-4">Ajouter un nouvel item au menu</h2>
                    <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-3">
                            <div>
                                <label for="name" class="block text-xs font-medium text-soft-text mb-1">Nom</label>
                                <input type="text" name="name" id="name" class="w-full px-2 py-1 text-sm border border-soft-secondary rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-soft-primary focus:border-soft-primary" required>
                            </div>
                            <div>
                                <label for="description" class="block text-xs font-medium text-soft-text mb-1">Description</label>
                                <textarea name="description" id="description" rows="3" class="w-full px-2 py-1 text-sm border border-soft-secondary rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-soft-primary focus:border-soft-primary" required></textarea>
                            </div>
                            <div>
                                <label for="price" class="block text-xs font-medium text-soft-text mb-1">Prix</label>
                                <input type="number" step="0.01" name="price" id="price" class="w-full px-2 py-1 text-sm border border-soft-secondary rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-soft-primary focus:border-soft-primary" required>
                            </div>
                            <div>
                                <label for="category" class="block text-xs font-medium text-soft-text mb-1">Catégorie</label>
                                <select name="category" id="category" class="w-full px-2 py-1 text-sm border border-soft-secondary rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-soft-primary focus:border-soft-primary" required>
                                    <option value="entrée">Entrée</option>
                                    <option value="plat">Plat</option>
                                    <option value="dessert">Dessert</option>
                                    <option value="boisson">Boisson</option>
                                </select>
                            </div>
                            <div>
                                <label for="photo" class="block text-xs font-medium text-soft-text mb-1">Photo</label>
                                <input type="file" name="photo" id="photo" class="w-full px-2 py-1 text-sm border border-soft-secondary rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-soft-primary focus:border-soft-primary" accept="image/*">
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
                                Ajouter l'item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection