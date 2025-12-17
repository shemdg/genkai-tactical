<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
    @foreach($categories as $category)
        <a href="{{ route('categories.show', $category->slug) }}" class="group block">
            <img src="https://images.unsplash.com/photo-1643502858916-be910fe145a3?q=80&w=627&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="aspect-square w-full rounded-sm object-cover">

            <div class="mt-3">
                <h3 class="font-medium text-tertiary group-hover:underline group-hover:underline-offset-4">
                    {{ $category->name }}
                </h3>

                <p class="mt-1 text-sm text-tertiary">{{ $category->products_count }} products</p>
            </div>
        </a>
    @endforeach
</div>
