<?php

namespace App\Livewire;

use Livewire\Attributes\Validate; 
use Livewire\WithFileUploads;
use Livewire\Component;

use App\Models\CarouselPhotos;

class AddCarouselPhotoForm extends Component
{
    use WithFileUploads;

    public $title;
    public $description;

    #[Validate(['photo.*' => 'image|max:2024'])]
    public $photo;
    public $is_active = false;


    public function addCarouselPhoto()
    {
        $this->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',            
            'photo' => 'required|image|max:2024',
        ], [
            'title.required' => 'Baslık alanı zorunludur.',
            'title.max' => 'Baslık alanı en fazla 255 karakter olmalıdır.',
            'photo.required' => 'Fotoğraf alanı zorunludur.',
            'photo.image' => 'Fotoğraf geçerli bir resim dosyası olmalıdır.',
            'photo.max' => 'Fotoğraf boyutu en fazla 2MB olmalıdır.',
        ]);

        $carousels = CarouselPhotos::where('title', $this->title)->first();
        if ($carousels) {
            session()->flash('error', 'Bu isimle kayıtlı carousel fotoğrafı mevcut.');
            return;
        } else {
            if ($this->photo) {
                $path = $this->photo->store('carousel_photos', 'public');
                $carousel = CarouselPhotos::create([
                    'title' => $this->title,
                    'description' => $this->description,
                    'image_path' => $path,
                    'is_active' => $this->is_active,
                ]);

                $carousel->save();

                session()->flash('success', 'Carousel fotoğrafı eklendi.');
                $this->reset();
                return redirect()->route('admin.carousel.photos');
            }
        }
    }


    public function render()
    {
        return view('livewire.add-carousel-photo-form');
    }
}
