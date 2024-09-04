<?php

namespace App\Livewire;

use App\Models\PopularRecipes;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Component;

use App\Models\Recipes;
use App\Models\Categories;

use Illuminate\Support\Facades\Storage;

class EditRecipeForm extends Component
{

    use WithFileUploads;

    public $recipe_id;

    public $categories;

    #[Validate('required')]
    public $title;

    #[Validate('required')]
    public $title_en;

    #[Validate(['photo.*' => 'image|max:2024'])]
    public $photo;

    public $existingImage;

    #[Validate('required')]
    public $category_id;
    public $is_popular = false;

    #[Validate('required')]
    public $content;

    #[Validate('required')]
    public $content_en;


    public function editRecipe($id)
    {
        $recipe = Recipes::findOrFail($id);
        
        $popular_recipes = PopularRecipes::all();
        $popular_recipes = $popular_recipes->where('recipe_id', $recipe->id)->first();
        
        if ($recipe) {
            $recipe->name = $this->title;
            $recipe->name_en = $this->title_en;
            $recipe->category_id = $this->category_id;
            $recipe->content = $this->content;
            $recipe->content_en = $this->content_en;
            
            if (!$popular_recipes) {
                $popular_recipes = new PopularRecipes();
            }
            
            if ($this->is_popular == false) {
                if ($popular_recipes->recipe_id == $recipe->id) {
                    $popular_recipes->delete();
                }
            } else {
                if ($popular_recipes->recipe_id != $recipe->id) {
                    $popular_recipes->recipe_id = $recipe->id;
                    $popular_recipes->save();
                }
            }
            
            if ($this->photo != null) {
                if ($recipe->image) {
                    if (Storage::disk('public')->exists($recipe->image)) {
                        Storage::disk('public')->delete($recipe->image);
                    }
                }
                
                $filename = $this->photo->store('recipes', 'public');
                $recipe->image = $filename;
                
            }
            $recipe->save();
            // dd($this->title_en, $this->content_en);
        }

        session()->flash('success', 'Tarif güncellendi.');
        return redirect()->route('admin.recipes');
    }

    public function mount($id)
    {
        $this->recipe_id = $id;
        $this->categories = Categories::all();

        $recipe = Recipes::findOrFail($id);
        if ($recipe) {
            $this->title = $recipe->name;
            $this->title_en = $recipe->name_en;
            $this->existingImage = $recipe->image;
            $this->category_id = $recipe->category_id;
            $this->content = $recipe->content;
            $this->content_en = $recipe->content_en;

            $popular_recipe = PopularRecipes::where('recipe_id', $recipe->id)->first();

            $this->is_popular = $popular_recipe ? true : false;
        } else {
            session()->flash('error', 'Tarif bulunamadı');
        }
    }
    public function render()
    {
        return view('livewire.edit-recipe-form');
    }
}
