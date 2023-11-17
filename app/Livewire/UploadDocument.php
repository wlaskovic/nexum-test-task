<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\Document;
use App\Models\CategoryUserPermission;
use App\Rules\CategoryPermissionRule;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class UploadDocument extends Component
{
    use WithFileUploads;

    public ?Category $category;

    public $document;
    public $version = 1;
    public $category_id;
    public $display_name;
    public $ext;

    public function mount(Category $category): void
    {
        $this->category_id = $category->id;
    }

    public function save(): void
    {
        $this->validate([
            'document' => [
                'required',
                'max:2048',
                'mimes:jpeg,png,pdf,docx',
                new CategoryPermissionRule(auth()->id(), $this->category_id, CategoryUserPermission::UPLOAD),
            ],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'display_name' => ['required', 'min:5'],
        ]);

        DB::beginTransaction();
        try {
            list($filename, $extension) = explode('.', $this->document->getClientOriginalName(), 2);

            $document = Document::where('original_name', $this->document->getClientOriginalName())->latest()->first();
            
            if (!empty($document)) {
                $this->version += $document['version'];
            }

            $filename = $filename . '-' . $this->version . '.' . $extension;

            $this->document->storeAs(auth()->id() . DIRECTORY_SEPARATOR . $this->category_id, $filename, 'public_uploads');


            Document::create([
                'category_id' => $this->category_id,
                'version' => $this->version,
                'user_id' => auth()->id(),
                'original_name' => $this->document->getClientOriginalName(),
                'display_name' => $this->display_name,
                'version_name' => $filename,
            ]);
        } catch (Exception $e) {
            Log::error('Error occured during document save: ' . json_encode($e->getMessage()));
            DB::rollBack();
        }
        DB::commit();

        session()->flash('message', 'Document uploaded successfully!');

        redirect()->to('/');
    }

    public function render(): View
    {
        return view('livewire.upload-document');
    }
}
