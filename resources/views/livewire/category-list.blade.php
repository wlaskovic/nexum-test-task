<div>
    <ul>
        @foreach ($categories as $category)
            <x-category-item :category="$category" />
        @endforeach
    </ul>

    @if ($selectedCategory)
    <div class="mt-20">
        <h2 class="bg-blue-500 text-white font-bold p-2 mt-2 rounded-lg ">Documents for {{ $selectedCategory->name }}</h2>
        <ul>
            @foreach ($documents as $document)
                <li>
                    <a  href="{{ route('download', $document->id) }}" 
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        {{ $document['display_name'] }}
                    </a> 
                    - ver.{{ number_format($document['version'], 1, '.') }}
                </li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
