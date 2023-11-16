<div class="fixed inset-0 z-50 flex items-center justify-center" x-data="{ confirmDeleteModal: false}">
    <div class="bg-white p-8 rounded shadow-lg w-96">

            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ $form->isUpdating ? 'Update' : 'New '}} category
                </h3>
                <button x-on:click="showAddCategoryModal = false, showUpdateCategoryModal = false" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div>
                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>

                        <input type="text" wire:model="form.name" id="name" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                        @error('form.name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
            
                    <div class="flex items-center p-6 space-x-2 rounded-b dark:border-gray-600">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >Save</button>

                        @if ($form->isUpdating)
                            <button type="button" x-on:click="confirmDeleteModal = true" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                Delete
                            </button>
                        @endif

                    </div>
                    
                </form>
            </div>

            <div x-cloak x-show="confirmDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="bg-white p-8 rounded shadow-lg">
                    <p class="text-gray-700 text-lg mb-4">Are you sure you want to delete this category?</p>
                    <div class="flex justify-end">
                        <button wire:click="delete" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Yes, delete
                        </button>
                        <button x-on:click="confirmDeleteModal = false" class="text-gray-500 hover:text-gray-700 ml-4">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
    </div>
</div>