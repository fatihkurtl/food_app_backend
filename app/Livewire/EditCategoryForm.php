<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

use App\Models\Categories as CategoriesModel;
use Illuminate\Support\Facades\Storage;

class EditCategoryForm extends Component
{
    use WithFileUploads;

    public $photo;

    public $edited_category_id;
    public $edited_category_name;
    public $edited_photo;


    public function editCategory()
    {
        $this->validate([
            'edited_category_name' => 'required|max:255',
            'edited_photo' => 'nullable|image|max:2024',
        ], [
            'edited_category_name.required' => 'Kategori adı zorunludur.',
            'edited_category_name.max' => 'Kategori adı en fazla 255 karakter olmalıdır.',
            'edited_photo.image' => 'Fotoğraf geçerli bir resim dosyası olmalıdır.',
            'edited_photo.max' => 'Fotoğraf boyutu en fazla 2MB olmalıdır.',
        ]);

        $category = CategoriesModel::find($this->edited_category_id);
        if ($category) {
            $category->name = $this->edited_category_name;

            if ($this->edited_photo) {
                if ($category->image) {
                    if (Storage::disk('public')->exists($category->image)) {
                        Storage::disk('public')->delete($category->image);
                    }
                }
                $path = $this->edited_photo->store('categories', 'public');
                $category->image = $path;
            }

            $category->save();

            session()->flash('success', 'Kategori bilgileri yenilendi.');
            return redirect()->route('admin.categories');
        }
    }
    public function mount($id)
    {
        $this->edited_category_id = $id;
        $this->edited_category_name = CategoriesModel::find($id)->name;

        $this->edited_photo = CategoriesModel::find($id)->image;
    }
    public function render()
    {
        return view('livewire.edit-category-form');
    }
}
