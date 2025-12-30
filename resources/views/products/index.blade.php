@extends('layouts.app')

@section('content')
 
<div class="py-8">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">Products</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
            @php
                // Check if image exists; fallback to test.jpg
                $imagePath = 'images/' . $product->image;
                if(!file_exists(public_path($imagePath))){
                    $imagePath = 'images/test.jpg';
                }
            @endphp

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition p-4 flex flex-col">
                
               {{-- Featured Products (only show 3) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-gray p-8 rounded shadow">
                <img src="{{ asset('images/product1.jpg') }}" class="w-full h-48 object-cover border-black border-8 ">
                <h3 class="mt-2 font-semibold  text-2xl">Headphones</h3>
                <p class="mt-4 font-bold text-gray-400">$150</p>
            </div>

            <div class="bg-gray p-8 rounded shadow">
                <img src="{{ asset('images/product2.png') }}" class="w-full h-48 object-cover border-white border-8">
                <h3 class="mt-2 font-semibold text-2xl">Loptaps</h3>
                <p class="mt-4 font-bold text-gray-400">$1,200</p>
            </div>

            <div class="bg-gray p-8 rounded shadow">
                <img src="{{ asset('images/product3.png') }}" class="w-full h-48 object-cover border-black border-8 ">
                <h3 class="mt-2 font-semibold text-2xl">Smartphones</h3>
                <p class="mt-4 font-bold text-gray-400">$800</p>
            </div>
        </div>

                <form action="{{ url('/cart/add/'.$product->id) }}" method="POST" class="mt-auto add-to-cart-form">
                    @csrf
                    <button type="submit" 
                            class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2 rounded shadow transition">
                        Add to Cart
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>


<script>
    // Intercept Add to Cart and show alert
    const forms = document.querySelectorAll('.add-to-cart-form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e){
            e.preventDefault();
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message || 'Product added to cart!');
            })
            .catch(err => alert('Error adding product!'));
        });
    });
</script>
@endsection
