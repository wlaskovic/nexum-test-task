<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\Forms\CategoryForm;
use App\Models\Category;
use Illuminate\Validation\Rule;

class CreateCategory extends Component
{
    public CategoryForm $form;

    public function rules(): array
    {
        return [
            'form.name' => ['required', Rule::unique('categories', 'name')],
            'form.parent_id' => ['nullable', Rule::exists('categories', 'id')],
        ];
    }

    public function mount(Category $category)
    {
        $this->form->setCategory($category);
    }

    public function save()
    {
        $this->validate();

        $this->form->save();
    }

    public function render()
    {
        return view('livewire.create-category');
    }
}
