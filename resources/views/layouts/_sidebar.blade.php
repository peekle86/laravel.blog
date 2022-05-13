<div class="position-sticky" style="top: 2rem;">
    <div class="p-4 mb-3 bg-light shadow-sm rounded">
        <h4 class="fst-italic">About</h4>
        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac ante arcu. Nulla ornare quis ipsum eget lobortis. Praesent sed rhoncus diam. Nam ultricies eros id varius vestibulum. Vestibulum at tortor luctus, lacinia magna id, lacinia magna.</p>
    </div>

    <div class="p-4 bg-light shadow-sm rounded">
        <h4 class="fst-italic">Categories</h4>
        <ol class="list-unstyled mb-0">
            @foreach($menuCategories as $mc)
                <li><a href="{{ route('category.articles', ['slug' => $mc->slug]) }}">{{ $mc->title }}</a></li>
            @endforeach
        </ol>
    </div>
</div>
