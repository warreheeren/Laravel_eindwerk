<a href="{{ route('favorites.toggle', $product) }}" class="group text-2xl bg-white px-4 py-1">

    @if (Auth::check() && Auth::user()->favorites()->where('product_id', $product->id)->count() > 0)
        <i class="group-hover:hidden text-red-500 fa-solid fa-heart"></i>
        <i class="hidden group-hover:inline text-red-500 fa-solid fa-heart"></i>
    @else
        <i class="group-hover:hidden fa-solid fa-heart"></i>
        <i class="hidden group-hover:inline fa-solid fa-heart"></i>
    @endif
</a>
