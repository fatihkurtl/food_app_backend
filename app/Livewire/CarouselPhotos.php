<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CarouselPhotos as CarouselPhotosModel;

class CarouselPhotos extends Component
{
    public $carousels;

    public function mount()
    {
        $this->carousels = CarouselPhotosModel::all();
    }

    public function deleteCarousel($id)
    {
        CarouselPhotosModel::destroy($id);
        session()->flash('success', 'Carousel fotoğrafı başarıyla silindi.');
        $this->mount();
    }

    public function render()
    {
        return view('livewire.carousel-photos');
    }
}
