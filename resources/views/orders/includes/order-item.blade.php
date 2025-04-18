<div class="flex gap-4 border border-gray-200 p-4">
    <div class="w-24">
        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
    </div>

    <div class="flex-1">
        <a href="{{ route('brands.show', $product->brand) }}"
            class="hover:underline text-gray-500">{{ $product->brand->name }}</a>
        <h1 class="text-lg">
            <a href="{{ route('products.show', $product) }}" class="hover:underline">{{ $product->name }}</a>
        </h1>
        <p class="text-sm text-gray-800">Maat: {{ $product->pivot->size }}</p>

        <div class="text-right border-t border-gray-500 pt-2 mt-4 flex justify-between">
            <span class="font-normal text-gray-500">{{ $product->pivot->quantity }} ×
                &euro;{{ number_format($product->price, 2, ',', '.') }}</span>
            <span class="font-semibold">
                &euro;{{ number_format($product->price * $product->pivot->quantity, 2, ',', '.') }}</span>
        </div>
    </div>
</div>
