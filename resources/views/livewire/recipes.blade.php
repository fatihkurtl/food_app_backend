<div>
    @if (session()->has('success'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
        role="alert">
        {{ session('success') }}
    </div>
@endif

@if (session()->has('error'))
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
        role="alert">
        {{ session('error') }}
    </div>
@endif
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach ($recipes as $recipe)
        @if ($recipe)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <img class="w-full h-40 object-cover rounded-md mb-4" src="{{ asset('storage/' . $recipe->image) }}"
                    alt="{{ $recipe->title }}">
                <a href="{{ route('admin.recipes.edit', $recipe->id) }}"
                    class="text-lg font-semibold hover:underline text-gray-900 dark:text-white">{{ $recipe->name }}</a>
                <div class="mt-2">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Kategori: @if ($recipe->category) {{ $recipe->category->name }} @endif</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Favori Sayısı: {{ $recipe->likes_count }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Kayıt Sayısı: {{ $recipe->record_count }}</p>
                    {{-- <p class="text-sm text-gray-600 dark:text-gray-400">Paylaşım Sayısı: {{ $recipe-> }}</p> --}}
                </div>
                <div class="mt-4 flex justify-between">
                    <a href="{{ route('admin.recipes.edit', $recipe->id) }}"
                        class="text-blue-500 hover:underline">Düzenle</a>
                    <button wire:click="deleteRecipe({{ $recipe->id }})" type="submit" class="text-red-500 hover:underline">Sil</button>
                </div>
            </div>
        @endif
    @endforeach
</div>
</div>