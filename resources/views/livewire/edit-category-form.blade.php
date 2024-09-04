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

    <!-- Kategori Düzenleme Formu -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Kategori Düzenle</h2>

        <form wire:submit.prevent="editCategory" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label for="edited_category_name"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori
                    Adı</label>
                <input type="text" wire:model="edited_category_name" id="category_name" name="category_name"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300">
                @error('category_name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="edited_category_name_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Kategori Adı (EN)
                </label>
                <input type="text" wire:model="edited_category_name_en" id="edited_category_name_en"
                    name="edited_category_name_en"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300">
                @error('edited_category_name_en')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="edited_photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori
                    Fotoğrafı</label>
                <input type="file" wire:model="edited_photo" id="edited_photo" name="edited_photo"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300"
                    accept="image/*">
                @error('edited_photo')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
                @if ($photo && is_string($photo))
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $photo) }}" alt="Fotoğraf Önizlemesi"
                            class="w-32 h-32 object-cover rounded-md">
                    </div>
                @elseif ($photo)
                    <div class="mt-4">
                        <img src="{{ $photo->temporaryUrl() }}" alt="Mevcut Fotoğraf"
                            class="w-32 h-32 object-cover rounded-md">
                    </div>
                @endif
            </div>

            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                Düzenle
            </button>
        </form>
    </div>
</div>
