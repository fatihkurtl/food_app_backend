<form wire:submit.prevent="editCarousel({{ $carouselId }})" enctype="multipart/form-data" class="space-y-6">
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
        <!-- Başlık -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Başlık</label>
            <input type="text" wire:model="title" id="title" name="title" value="{{ old('title') }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300">
            @error('title')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Açıklama -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Açıklama</label>
            <textarea id="description" wire:model="description" name="description" rows="4"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm resize-none dark:bg-gray-700 dark:text-gray-300"></textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Fotoğraf Yükleme -->
        <div class="mb-4">
            <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Carousel Fotoğrafı</label>
            <input type="file" wire:model="photo" id="photo" name="photo"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300"
                accept="image/*">
            @error('photo')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
            <!-- Önizleme Alanı -->
            @if ($existingPhoto && is_string($existingPhoto))
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $existingPhoto) }}" alt="Fotoğraf Önizlemesi" class="w-32 h-32 object-cover rounded-md">
                </div>
            @elseif($existingPhoto)
                <div class="mt-4">
                    <img src="{{ $existingPhoto->temporaryUrl() }}" alt="Fotoğraf Önizlemesi" class="w-32 h-32 object-cover rounded-md">
                </div>
            @endif
        </div>

        <!-- Aktif Durumu -->
        <div class="mb-4 flex items-center space-x-4">
            <div class="items-center">
                <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">Aktif Durumu</span>
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="is_active" wire:model.boolean="is_active" class="sr-only peer" />
                    <div
                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                    </div>
                </label>
                @error('is_active')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button type="submit"
            class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
            Düzenle
        </button>
    </div>
</form>
