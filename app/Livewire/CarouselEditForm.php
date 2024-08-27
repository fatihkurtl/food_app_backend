<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Component;

use App\Models\CarouselPhotos;
use Illuminate\Support\Facades\Storage;

class CarouselEditForm extends Component
{
    use WithFileUploads;
    public $carouselId;
    public $title;
    public $description;

    #[Validate(['photo.*' => 'image|max:2024'])]
    public $photo;

    public $existingPhoto;

    public $is_active = false;


    public function editCarousel()
    {
        $this->validate();

        $carousel = CarouselPhotos::findOrFail($this->carouselId);
        $carousel->title = $this->title;
        $carousel->description = $this->description;
        $carousel->is_active = $this->is_active;

        if ($this->photo) {
            if ($carousel->image_path) {
                if (Storage::disk('public')->exists($carousel->image_path)) {
                    Storage::disk('public')->delete($carousel->image_path);
                }
            }

            $path = $this->photo->store('carousel_photos', 'public');
            $carousel->image_path = $path;
        }

        $carousel->save();

        session()->flash('success', 'Carousel fotoğrafı başarıyla düzenlendi.');

        return redirect()->route('admin.carousel.photos');
    }

    public function mount($id)
    {
        $this->carouselId = $id;

        $carousel = CarouselPhotos::find($this->carouselId);

        if ($carousel) {
            $this->title = $carousel->title;
            $this->description = $carousel->description;
            $this->is_active = $carousel->is_active == 1 ? true : false;
            $this->photo = null;
            $this->existingPhoto = $carousel->image_path;
        } else {
            session()->flash('error', 'Carousel fotoğrafı bulunamadı!');
            return redirect()->route('admin.carousel.photos');
        }
    }

    public function render()
    {
        return view('livewire.carousel-edit-form');
    }
}
