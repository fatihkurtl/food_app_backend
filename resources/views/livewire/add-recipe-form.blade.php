<form wire:submit.prevent="addRecipe" enctype="multipart/form-data" class="space-y-6">
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

    @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <!-- Tarif Başlığı -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tarif Başlığı</label>
            <input type="text" wire:model="title" id="title" name="title" value="{{ old('title') }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300">
            @error('title')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Fotoğraf Yükleme -->
        <div class="mb-4">
            <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tarif
                Fotoğrafı</label>
            <input type="file" wire:model="photo" id="photo" name="photo"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300"
                accept="image/*">
            @error('photo')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Kategori Seçimi ve Popüler Tarif Toggle -->
        <div class="mb-4 flex items-center space-x-4">
            <div class="w-1/2">
                <label for="category"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                <select id="category" wire:model="category_id" name="category"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300">
                    <option value="" disabled selected>Kategori Seçin</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="items-center">
                <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">Popüler Tarif</span>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="is_popular" wire:model.boolean="is_popular" class="sr-only peer">
                    <div
                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                    </div>
                </label>
                @error('category')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Tarif İçeriği -->
        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tarif
                İçeriği</label>
            {{-- <textarea id="content" wire:model="content" name="content" rows="6"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm resize-none dark:bg-gray-700 dark:text-gray-300"></textarea> --}}
            <x-markdown wire:model="content" />
            {{-- <div id="content-preview"
                class="mt-4 border border-gray-300 rounded-md p-2 bg-gray-50 dark:bg-gray-800 dark:border-gray-600">
                <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">Önizleme</h3>
                <p id="preview-text" class="mt-2 text-gray-700 dark:text-gray-300">Burada tarif içeriği önizlemesi
                    görünecek.</p>
            </div> --}}
            @error('content')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
            Ekle
        </button>
    </div>
</form>


<script>
    // document.getElementById('content').addEventListener('input', function () {
    //     document.getElementById('preview-text').textContent = this.value || 'Burada tarif içeriği önizlemesi görünecek.';
    // });
</script>
