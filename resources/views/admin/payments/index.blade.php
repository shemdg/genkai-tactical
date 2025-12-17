<x-admin.layout>
    <x-slot:title>Pending Payments</x-slot:title>

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Pending Payments</h1>
        <div class="text-sm text-gray-600">
            Total Pending: <span class="font-bold text-xl text-yellow-600">{{ $orders->total() }}</span>
        </div>
    </div>

    @if($orders->isEmpty())
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <div class="text-6xl mb-4">🎉</div>
            <h2 class="text-2xl font-bold mb-2">All Caught Up!</h2>
            <p class="text-gray-600">No pending payments to verify. Great job!</p>
        </div>
    @else
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Order</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Payment</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($orders as $order)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="font-bold text-blue-600 hover:text-blue-800">
                                        {{ $order->order_number }}
                                    </a>
                                    <p class="text-xs text-gray-500">{{ $order->orderItems->count() }} item(s)</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-semibold">{{ $order->customer_name }}</p>
                                    <p class="text-sm text-gray-600">{{ $order->customer_email }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->customer_phone }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">
                                            {{ strtoupper($order->payment_method) }}
                                        </span>
                                        @if($order->payment_status === 'pending')
                                            <span class="inline-block bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-semibold">
                                                Pending
                                            </span>
                                        @endif
                                    </div>
                                    @if($order->payment_reference)
                                        <p class="text-sm">
                                            <span class="text-gray-600">Ref:</span>
                                            <code class="bg-gray-100 px-2 py-1 rounded text-xs">{{ $order->payment_reference }}</code>
                                        </p>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-bold text-lg text-red-600">₱{{ number_format($order->total, 2) }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-semibold">{{ $order->created_at->format('M d, Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ $order->created_at->format('h:i A') }}</p>
                                    <p class="text-xs text-gray-400">{{ $order->created_at->diffForHumans() }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    @if($order->payment_status === 'pending')
                                        <div class="flex items-center justify-center gap-2">
                                            <form action="{{ route('admin.payments.verify', $order) }}" method="POST" onsubmit="return confirm('Verify this payment? This will send a confirmation email to the customer.')">
                                                @csrf
                                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded font-semibold text-sm transition flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    Verify
                                                </button>
                                            </form>
                                            
                                            <form action="{{ route('admin.payments.reject', $order) }}" method="POST" onsubmit="return confirm('Reject this payment? The customer will need to resubmit.')">
                                                @csrf
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded font-semibold text-sm transition flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm">Processed</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($orders->hasPages())
                <div class="px-6 py-4 border-t">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    @endif
</x-admin.layout>