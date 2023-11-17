<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\Forms\CategoryForm;
use App\Models\Category;
use App\Models\CategoryUserPermission;
use App\Rules\CategoryPermissionRule;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UpdateCategory extends Component
{
    public CategoryForm $form;

    public function mount(Category $category): void
    {
        $this->form->isUpdating = true;
        $this->form->setCategory($category);
    }
 
    public function save(): void
    {
        $this->validate([
            'form.name' => [
                'required',
                Rule::unique('categories', 'name')->ignore($this->form->category->id),
                new CategoryPermissionRule(auth()->id(), $this->form->category->id, CategoryUserPermission::UPLOAD),
            ],
            'form.parent_id' => ['nullable', Rule::exists('categories', 'id')],
        ]);

        $this->form->update();
    }
    
    public function delete(): void
    {
        $this->form->category->delete();
    }

    public function render(): View
    {
        return view('livewire.create-category');
    }
}
