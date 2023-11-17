<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\Forms\CategoryForm;
use App\Models\Category;
use Illuminate\View\View;
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

    public function mount(Category $category): void
    {
        $this->form->setCategory($category);
    }

    public function save(): void
    {
        $this->validate();

        $this->form->save();
    }

    public function render(): View
    {
        return view('livewire.create-category');
    }
}
