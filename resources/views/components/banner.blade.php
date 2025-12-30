@props(['products'])

<div class="mb-8">
    <h3 class="text-2xl font-semibold mb-4">Products</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="bg-white dark:bg-gray-800 p-4 rounded shadow hover:shadow-lg transition">
                <img src="{{ $product->image_url ?? 'https://via.placeholder.com/150' }}" class="w-full h-40 object-cover rounded mb-2" alt="{{ $product->name }}">
                <h4 class="font-semibold text-lg">{{ $product->name }}</h4>
                <p class="text-gray-600 dark:text-gray-300">${{ number_format($product->price,2) }}</p>
                <a href="{{ route('cart.add', $product->id) }}" class="mt-2 inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-500">Add to Cart</a>
            </div>
        @endforeach
    </div>
</div>
