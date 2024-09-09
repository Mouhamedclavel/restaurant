@extends('layouts.app')

@section('content')
    @include('partials.dashboard_navbar', ['user' => $user])
    <main class="flex-grow">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Ajouter un nouvel item au menu</h2>
                    <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Prix</label>
                            <input type="number" step="0.01" name="price" id="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                        <div class="mb-4">
                            <label for="category" class="block text-sm font-medium text-gray-700">Catégorie</label>
                            <select name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="entrée">Entrée</option>
                                <option value="plat">Plat</option>
                                <option value="dessert">Dessert</option>
                                <option value="boisson">Boisson</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                            <input type="file" name="photo" id="photo" class="mt-1 block w-full" accept="image/*">
                        </div>
                        <div class="mb-4">
                            <label for="is_available" class="inline-flex items-center">
                                <input type="checkbox" name="is_available" id="is_available" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="1" checked>
                                <span class="ml-2 text-sm text-gray-600">Disponible</span>
                            </label>
                        </div>
                        <div class="flex items-center justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Ajouter l'item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection