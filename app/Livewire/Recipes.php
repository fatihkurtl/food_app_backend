<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Recipes as RecipesModel;

class Recipes extends Component
{

    public $recipes;
    public $categories;

    public function deleteRecipe($id)
    {
        $recipe = RecipesModel::find($id);
        if ($recipe) {
            $recipe->delete();
            session()->flash('success', 'Tarif silindi.');
        } else {
            session()->flash('error', 'Tarif bulunamadı!');
        }
    }   

    public function mount()
    {
        $this->recipes = RecipesModel::all();
    }

    public function render()
    {
        return view('livewire.recipes');
    }
}
