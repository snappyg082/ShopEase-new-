@extends('layouts.app')

{{-- Header --}}
@section('header')
<h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-900 tracking-wide">
    📦 My Orders
</h2>
@endsection

{{-- Page Content --}}
@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- Page Title --}}
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                Order History
            </h3>
            <p class="text-gray-600 dark:text-gray-300 mt-1">
                Review all your previous purchases.
            </p>
        </div>

        {{-- Orders Table --}}
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            @if($orders->count())
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                Order #
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                Date
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                Total
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($orders as $order)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                                    #{{ $order->id }}
                                </td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                    {{ $order->created_at->format('M d, Y') }}
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                {{-- Empty State --}}
                <div class="p-10 text-center">
                    <p class="text-gray-600 dark:text-gray-300">
                        You have not placed any orders yet.
                    </p>
                    <a href="{{ route('shop.products') }}"
                       class="inline-block mt-4 px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500 transition">
                        🛍 Start Shopping
                    </a>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
