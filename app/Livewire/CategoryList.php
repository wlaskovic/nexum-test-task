<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Document;
use Illuminate\View\View;

class CategoryList extends Component
{
    public $openCategory;
    public $selectedCategory;
    public $documents;

    public function render(): View
    {
        $categories = Category::where('parent_id', null)->get();

        return view('livewire.category-list', [
            'categories' => $categories,
        ]);
    }

    public function loadFiles(Category $category): void
    {
        $this->selectedCategory = $category;
        $this->documents = Document::where('category_id', $category->id)
                            ->where('user_id', auth()->id())
                            ->orderBy('created_at', 'asc')
                            ->orderBy('version_name', 'asc')
                            ->get();
    }
}
