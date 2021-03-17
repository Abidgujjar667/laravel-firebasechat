<ul>
    @foreach ($categories as $category)
        <li>{{ $category->name }}</li>
        <ul>
            @foreach ($category->childrenCategories as $childCategory)
                @include('multilevel/child_category', ['child_category' => $childCategory])
            @endforeach
        </ul>
    @endforeach
</ul>