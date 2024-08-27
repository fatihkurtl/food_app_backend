<?php

namespace App\Livewire;

use Livewire\Attributes\Validate; 
use Livewire\WithFileUploads;
use Livewire\Component;

use App\Models\Categories;
use App\Models\Recipes;
use App\Models\PopularRecipes;

class AddRecipeForm extends Component
{
    use WithFileUploads;
    public $categories;

    #[Validate('required')]
    public $title;
    
    #[Validate(['photo.*' => 'image|max:2024'])]
    public $photo;

    #[Validate('required')]
    public $category_id;
    public $is_popular = false;

    #[Validate('required')]
    public $content;

    public function addRecipe()
    {
        $this->validate([
            'title' => 'required',
            'photo' => 'required',
            'category_id' => 'required',
            'content' => 'required',
        ], [
            'title.required' => 'Tarif adı zorunludur.',
            'photo.required' => 'Tarif fotoğrafı zorunludur.',
            'category_id.required' => 'Kategori zorunludur.',
            'content.required' => 'Tarif içeriği zorunludur.',
        ]);

        $recipe = Recipes::where('name', $this->title)->first();
        $category = Categories::find($this->category_id);
        // $popular_recipes = PopularRecipes::all();

        if ($recipe) {
            $this->addError('title', 'Bu tarif zaten mevcut.');
        } else {
            if ($this->photo) {
                $path = $this->photo->store('recipes', 'public');

                $saved_recipe = Recipes::create([
                    'name' => $this->title,
                    'image' => $path,
                    'category_id' => $category->id,
                    'content' => $this->content,
                    'is_popular' => $this->is_popular,
                ]);

                $saved_recipe->save();

                if ($this->is_popular) {
                    PopularRecipes::updateOrCreate(
                        ['recipe_id' => $saved_recipe->id],
                        ['recipe_id' => $saved_recipe->id]
                    );
                }
                
                session()->flash('success', 'Tarif eklendi.');
                $this->reset();
                return redirect()->route('admin.recipes');
            }
        }
        
    }

    public function toggleIsPopular()
    {
        $this->is_popular = ! $this->is_popular;
    }

    public function mount()
    {
        // $this->categories = [
        //     (object) ['id' => 1, 'name' => 'Ana Yemek'],
        //     (object) ['id' => 2, 'name' => 'Tatlı'],
        //     (object) ['id' => 3, 'name' => 'Ara Öğün'],
        // ];

        $this->categories = Categories::all();

        $this->category_id = '';
    }
    public function render()
    {
        return view('livewire.add-recipe-form');
    }
}
