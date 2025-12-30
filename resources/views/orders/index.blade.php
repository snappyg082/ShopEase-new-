@extends('layouts.app')

@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- Page Header --}}
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                📦 Your Orders
            </h1>
        </div>

        {{-- Empty State --}}
        @if($orders->isEmpty())
            <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-10 text-center">
                <p class="text-gray-600 dark:text-gray-300 text-lg">
                    You haven't placed any orders yet.
                </p>
                <a href="{{ route('shop.products') }}"
                   class="inline-block mt-6 px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-500 transition">
                    🛍 Start Shopping
                </a>
            </div>
        @else

        {{-- Orders Table --}}
        <div class="bg-white dark:bg-gray-800 shadow rounded-xl overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                
                {{-- Table Header --}}
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                            Order ID
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                            Total Price
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                            Status
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                            Placed On
                        </th>
                    </tr>
                </thead>

                {{-- Table Body --}}
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($orders as $order)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                                #{{ $order->id }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-green-600">
                                ${{ number_format($order->total_price, 2) }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    {{ $order->status === 'completed'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                {{ $order->created_at->format('M d, Y · h:i A') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        @endif

    </div>
</div>
@endsection
