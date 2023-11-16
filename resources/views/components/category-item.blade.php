<div x-data="{ openCategory: null }">
    <li class="ml-4">
        <div class="flex">
            <div class="flex items-center cursor-pointer text-blue-500"
            x-on:click="@this.call('loadFiles', {{ json_encode($category) }}); 
            openCategory = (openCategory === '{{ $category->name }}' ? null : '{{ $category->name }}')" >
                {{ $category->name }}
            </div>
            <x-category-maintenance :category="$category"/>
        </div>

        <div x-cloak x-show="openCategory === '{{ $category['name'] }}'">
            @if (count($category['subcategories']) > 0)
                <ul>
                    @foreach ($category['subcategories'] as $subcategory)
                        <x-category-item :category="$subcategory" />
                    @endforeach
                </ul>
            @endif
        </div>
    </li>
</div>
