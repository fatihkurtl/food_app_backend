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

    <!-- Carousel Fotoğrafları Kartlar -->
    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Carousel Fotoğrafları</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($carousels as $carousel)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                @if ($carousel->image_path)
                    <img class="w-full h-40 object-cover rounded-md mb-4" src="{{ asset('storage/' . $carousel->image_path) }}"
                        alt="{{ $carousel->title }}">
                @else
                    <div class="w-full h-40 bg-gray-200 rounded-md mb-4 flex items-center justify-center">
                        <span class="text-gray-500">Resim Yok</span>
                    </div>
                @endif

                <a href="{{ route('admin.carousel.edit', $carousel->id) }}" class="text-lg font-semibold hover:underline text-gray-900 dark:text-white">
                    {{ $carousel->title ?: 'Başlık Yok' }}
                </a>
                <div class="mt-2">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Durum: 
                        <span class="{{ $carousel->is_active ? 'text-green-500' : 'text-red-500' }}">
                            {{ $carousel->is_active ? 'Aktif' : 'Pasif' }}
                        </span>
                    </p>
                </div>
                <div class="mt-4 flex justify-between">
                    <a href="{{ route('admin.carousel.edit', $carousel->id) }}" class="text-blue-500 hover:underline">Düzenle</a>
                    <button type="button" wire:click="deleteCarousel({{ $carousel->id }})" class="text-red-500 hover:underline">Sil</button>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 dark:text-gray-400 col-span-full">Hiç fotoğraf yok</p>
        @endforelse
    </div>
</div>