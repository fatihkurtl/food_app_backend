@extends('layouts.admin.admin')

@section('content')
    <h1 class="text-center mb-6">Welcome to Food App Admin Home Page</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Total Users Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Toplam Kullanıcı</h2>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats->totalUsers }}</p>
        </div>

        <!-- Total Recipes Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Toplam Tarif</h2>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats->totalRecipes }}</p>
        </div>

        <!-- Total Categories Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Toplam Kategori</h2>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats->totalCategories }}</p>
        </div>

        <!-- Total Downloads Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Toplam İndirme</h2>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats->totalDownloads }}</p>
        </div>

    </div>
@endsection
