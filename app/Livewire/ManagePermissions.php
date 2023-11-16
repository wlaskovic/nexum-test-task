<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\View\View;
use App\Models\CategoryUserPermission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ManagePermissions extends Component
{
    public $categoryPermission;
    public $permissions = [];
    public $category;

    public function mount(Category $category): void
    {
        $this->categoryPermission = CategoryUserPermission::getUserPermission(auth()->id(), $category->id);
        $this->permissions = CategoryUserPermission::revertPermissions($this->categoryPermission);
        $this->category = $category;
    }

    public function updatePermissions()
    {
        DB::beginTransaction();
        try {
            CategoryUserPermission::updateOrCreate([
                'category_id' => $this->category->id,
                'user_id' => auth()->id(),
            ],
            [
                'permissions' => CategoryUserPermission::calculatePermission($this->permissions),
            ]);
        } catch (Exception $e) {
            Log::error('Error occured during category save: ' . json_encode($e->getMessage()));
            DB::rollBack();
        }
        DB::commit();

        session()->flash('message', 'Permissions updated successfully!');

        redirect()->to('/');
    }

    public function render(): View
    {
        $uploadPermission = CategoryUserPermission::UPLOAD;
        $downloadPermission = CategoryUserPermission::DOWNLOAD;
        
        return view('livewire.manage-permissions', compact('uploadPermission', 'downloadPermission'));
    }
}
