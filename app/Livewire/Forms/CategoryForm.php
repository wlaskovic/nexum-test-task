<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryForm extends Form
{
    public ?Category $category;

    public $name;
    public $parent_id;
    public $isUpdating = false;

    public function rules(): array
    {
        return [];
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
        $this->name = $this->isUpdating ? $category->name : '';
        $this->parent_id = $this->isUpdating ? $category->parent_id : $category->id;
    }

    public function save()
    {
        DB::beginTransaction();
        try {
            Category::create([
                'parent_id' => $this->category->id,
                'name' => $this->name,
            ]);
        } catch (Exception $e) {
            Log::error('Error occured during category save: ' . json_encode($e->getMessage()));
            DB::rollBack();
        }
        DB::commit();

        session()->flash('message', 'Category created successfully!');

        redirect()->to('/');
    }

    public function update(): void
    {
        try {
            $this->category->update(
                $this->all()
            );
        } catch (Exception $e) {
            Log::error('Error occured during category update: ' . json_encode($e->getMessage()));
        }

        session()->flash('message', 'Category updated successfully!');

        redirect()->to('/');
    }
}
