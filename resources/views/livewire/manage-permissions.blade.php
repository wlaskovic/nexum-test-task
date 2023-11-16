<div class="fixed inset-0 z-50 flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-lg w-96">

            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Permissions for {{ $category->name }}
                </h3>
                <button x-on:click="showManagePermissionsModal = false" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div>
            
                <form wire:submit.prevent="updatePermissions">
                    <label>
                        <input type="checkbox" wire:model="permissions" value="{{ $uploadPermission }}">
                        Upload
                    </label>

                    <label>
                        <input type="checkbox" wire:model="permissions" value="{{ $downloadPermission }}">
                        Download
                    </label>
            
                    <div class="flex items-center p-6 space-x-2 rounded-b dark:border-gray-600">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >Update</button>
                    </div>
                </form>
            </div>

    </div>
</div>