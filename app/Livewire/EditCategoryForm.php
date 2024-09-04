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

    #[Validate('required')]
    public $edited_category_name;

    #[Validate('required|max:255')]
    public $edited_category_name_en;

    #[Validate('image|max:2024')]
    public $edited_photo;


    public function editCategory()
    {
        // dd($this->edited_category_name_en);
        $category = CategoriesModel::find($this->edited_category_id);
        if ($category) {
            $category->name = $this->edited_category_name;
            if ($this->edited_category_name_en) {
                $category->name_en = $this->edited_category_name_en;
            }

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
        $this->edited_category_name_en = CategoriesModel::find($id)->name_en;

        $this->edited_photo = null;
        $this->photo = CategoriesModel::find($id)->image;
    }
    public function render()
    {
        return view('livewire.edit-category-form');
    }
}
