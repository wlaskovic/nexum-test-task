<div x-data="{ showAddCategoryModal: false, showUpdateCategoryModal: false, showUploadDocumentModal: false, showManagePermissionsModal: false }" class="flex items-center space-x-4">

    <button
    x-on:click="showAddCategoryModal = true"
    class="text-blue-500 block text-left p-2 cursor-pointer"
    >
        <i class="fas fa-plus"></i> 
    </button>

    <button
        x-on:click="showUpdateCategoryModal = true"
        class="text-blue-500 block text-left p-2 cursor-pointer"
    >
        <i class="fas fa-pen"></i>
    </button>

    <button
        x-on:click="showUploadDocumentModal = true"
        class="text-blue-500 block text-left p-2 cursor-pointer"
    >
        <i class="fas fa-upload"></i> 
    </button>

    <button
        x-on:click="showManagePermissionsModal = true"
        class="text-blue-500 block text-left p-2 cursor-pointer"
    >
        <i class="fas fa-lock"></i> 
    </button>

    <div x-cloak x-show="showAddCategoryModal" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-slate-100">
        <livewire:create-category :category="$category" />
    </div>
    <div x-cloak x-show="showUpdateCategoryModal" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-slate-100">
        <livewire:update-category :category="$category" />
    </div>
    <div x-cloak x-show="showUploadDocumentModal" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-slate-100">
        <livewire:upload-document :category="$category" />
    </div>
    <div x-cloak x-show="showManagePermissionsModal" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-slate-100">
        <livewire:manage-permissions :category="$category" />
    </div>
</div>
