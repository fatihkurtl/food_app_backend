<div>

    @if (session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <!-- Kategori Ekleme Formu -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Yeni Kategori Ekle</h2>

        <form wire:submit.prevent="addCategory" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label for="category_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori
                    Adı</label>
                <input type="text" wire:model="category_name" id="category_name" name="category_name"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300">
                @error('category_name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror                
            </div>
            <div>
                <label for="category_name_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Kategori Adı (EN)
                </label>
                <input type="text" wire:model="category_name_en" id="category_name_en" name="category_name_en"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300">
                @error('category_name_en')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Kategori Fotoğrafı
                </label>
                <input type="file" wire:model="photo" id="photo" name="photo"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300"
                    accept="image/*">
                @error('photo')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
                @if ($photo)
                    <div class="mt-4">
                        <img src="{{ $photo->temporaryUrl() }}" alt="Fotoğraf Önizlemesi"
                            class="w-32 h-32 object-cover rounded-md">
                    </div>
                @endif
            </div>

            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                Ekle
            </button>
        </form>
    </div>

    <!-- Kategoriler Grid -->
    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Kategoriler</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($categories as $category)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <img class="w-full h-40 object-cover rounded-md mb-4" src="{{ asset('storage/' . $category->image) }}"
                    alt="{{ $category->name }}">
                <a href="{{ route('admin.category.recipes', $category->id) }}"
                    class="text-lg font-semibold hover:underline text-gray-900 dark:text-white mb-2">{{ $category->name }}</a>

                <div class="mt-4 flex justify-between">
                    <a href="{{ route('admin.category.recipes', $category->id) }}"
                        class="text-blue-500 hover:underline">Düzenle</a>
                    <button type="button" class="text-red-500 hover:underline"
                        wire:click="deleteCategory({{ $category->id }})">Sil</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
