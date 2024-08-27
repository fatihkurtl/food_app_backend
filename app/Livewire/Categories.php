<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

use App\Models\Categories as CategoriesModel;
use Illuminate\Support\Facades\Storage;

class Categories extends Component
{
    use WithFileUploads;
    public $categories = [];

    #[Validate('max:255')]
    public $category_name;

    #[Validate(['photo.*' => 'image|max:2024'])]
    public $photo;

    public $photoPreview; 


    public function updatedPhoto()
    {
        if ($this->photo) {
            $this->photoPreview = $this->photo->temporaryUrl();
        }
    } 

    public function addCategory()
    {
        $this->validate([
            'category_name' => 'required|max:255',
            'photo' => 'nullable|image|max:2024',
        ], [
            'category_name.required' => 'Kategori adı zorunludur.',
            'category_name.max' => 'Kategori adı en fazla 255 karakter olmalıdır.',
            'photo.image' => 'Fotoğraf geçerli bir resim dosyası olmalıdır.',
            'photo.max' => 'Fotoğraf boyutu en fazla 2MB olmalıdır.',
        ]);

        $existingCategory = CategoriesModel::where('name', $this->category_name)->first();

        if ($existingCategory) {
            session()->flash('error', 'Bu kategori zaten mevcut.');
            return;
        }

        $category = new CategoriesModel();
        $category->name = $this->category_name;

        if ($this->photo) {
            $path = $this->photo->store('categories', 'public');
            $category->image = $path;
        }

        $category->save();

        session()->flash('success', 'Kategori eklendi.');

        $this->category_name = '';
        $this->photo = null;

        // dd($this->category_name, $this->photo, $existingCategory->image);
    }

    public function mount()
    {
        $this->categories = CategoriesModel::all();
        // $this->categories = [
        //     [
        //         'name' => 'Ana Yemekler',
        //         'photo_url' => 'https://via.placeholder.com/400x200?text=Ana+Yemekler',
        //     ],
        //     [
        //         'name' => 'Tatlılar',
        //         'photo_url' => 'https://via.placeholder.com/400x200?text=Tatlılar',
        //     ],
        //     [
        //         'name' => 'Çorbalar',
        //         'photo_url' => 'https://via.placeholder.com/400x200?text=Çorbalar',
        //     ],
        //     [
        //         'name' => 'Salatalar',
        //         'photo_url' => 'https://via.placeholder.com/400x200?text=Salatalar',
        //     ],
        //     [
        //         'name' => 'Aperatifler',
        //         'photo_url' => 'https://via.placeholder.com/400x200?text=Aperatifler',
        //     ],
        //     [
        //         'name' => 'İçecekler',
        //         'photo_url' => 'https://via.placeholder.com/400x200?text=İçecekler',
        //     ],
        //     [
        //         'name' => 'Deniz Ürünleri',
        //         'photo_url' => 'https://via.placeholder.com/400x200?text=Deniz+Ürünleri',
        //     ],
        //     [
        //         'name' => 'Hamur İşleri',
        //         'photo_url' => 'https://via.placeholder.com/400x200?text=Hamur+İşleri',
        //     ],
        // ];
    }

    public function render()
    {
        return view('livewire.categories');
    }
}
