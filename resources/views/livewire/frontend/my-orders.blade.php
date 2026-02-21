<div>

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-white">
                My Orders
            </h1>
            <p class="text-sm text-gray-400">
                Track and manage your shipping orders.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">

            {{-- Search --}}
            <input
                wire:model.debounce.500ms="search"
                type="text"
                placeholder="Search Order ID..."
                class="bg-transparent border border-white/10 rounded-xl px-4 py-2 text-white w-full sm:w-60"
            >

            {{-- Status Filter --}}
            <select
                wire:model="status"
                class="bg-transparent border border-white/10 rounded-xl px-4 py-2 text-white w-full sm:w-48"
            >
                <option value="">All Status</option>
                <option value="pending_verification" class="text-black">Pending</option>
                <option value="payment_verified"  class="text-black" >Verified</option>
                <option value="payment_rejected" class="text-black">Rejected</option>
                <option value="processing"  class="text-black">Processing</option>
                <option value="shipping"  class="text-black">Shipping</option>
                <option value="out_for_delivery" class="text-black">Out for Delivery</option>
                <option value="delivered" class="text-black">Delivered</option>
                <option value="cancelled" class="text-black">Cancelled</option>
            </select>

        </div>
    </div>

    {{-- Orders Grid --}}
    @if($orders->count())
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">

            @foreach($orders as $order)
                <div class="glass rounded-3xl p-6 hover:scale-[1.02] transition">

                    <div class="flex justify-between items-start">
                        <div>
                            <div class="text-sm text-gray-400">
                                Order ID
                            </div>
                            <div class="font-extrabold text-white">
                                {{ $order->unique_order_id }}
                            </div>
                        </div>

                        <span class="px-3 py-1 rounded-full text-xs font-bold
                            @if($order->status === 'pending_verification') bg-yellow-500/20 text-yellow-400
                            @elseif($order->status === 'payment_verified') bg-green-500/20 text-green-400
                            @elseif($order->status === 'payment_rejected') bg-red-500/20 text-red-400
                            @elseif($order->status === 'processing') bg-blue-500/20 text-blue-400
                            @elseif($order->status === 'shipping') bg-purple-500/20 text-purple-400
                            @elseif($order->status === 'out_for_delivery') bg-indigo-500/20 text-indigo-400
                            @elseif($order->status === 'delivered') bg-emerald-500/20 text-emerald-400
                            @else bg-gray-500/20 text-gray-400
                            @endif">
                            {{ str_replace('_', ' ', ucfirst($order->status)) }}
                        </span>
                    </div>

                    <div class="mt-4 space-y-2 text-sm text-gray-300">

                        <div class="flex justify-between">
                            <span>Date</span>
                            <span>{{ $order->created_at->format('M d, Y') }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Payment</span>
                            <span>{{ $order->paymentMethod->name ?? '-' }}</span>
                        </div>

                        <div class="flex justify-between font-bold text-gold">
                            <span>Payable</span>
                            <span>NPR {{ number_format($order->payable_npr, 2) }}</span>
                        </div>

                    </div>

                    <a href="{{route('user.order.details', $order->id)}}"
                       class="mt-6 block text-center border border-gold text-gold py-2 rounded-xl hover:bg-gold hover:text-darkbg transition">
                        View Details
                    </a>

                </div>
            @endforeach

        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $orders->links() }}
        </div>

    @else
        <div class="glass rounded-3xl p-10 text-center text-gray-400">
            No orders found.
        </div>
    @endif

</div>
