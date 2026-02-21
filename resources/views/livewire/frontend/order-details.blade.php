<div>
<a href="{{ route('user.orders') }}">
    <button class=" text-white    ">
  Back
</button>
</a>
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-extrabold text-white">
            Order {{ $order->unique_order_id }}
        </h1>
        <p class="text-gray-400 text-sm">
            Placed on {{ $order->created_at->format('M d, Y h:i A') }}
        </p>
    </div>

    {{-- Status Timeline --}}
    @php
        $steps = [
            'pending_verification' => 'Payment Uploaded',
            'payment_verified' => 'Payment Verified',
            'processing' => 'Processing',
            'shipping' => 'Shipping',
            'out_for_delivery' => 'Out for Delivery',
            'delivered' => 'Delivered'
        ];

        $currentIndex = array_search($order->status, array_keys($steps));
    @endphp

    <div class="glass rounded-3xl p-6 mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

            @foreach($steps as $key => $label)
                @php
                    $stepIndex = array_search($key, array_keys($steps));
                @endphp

                <div class="flex items-center gap-4 flex-1">
                    <div class="h-8 w-8 rounded-full flex items-center justify-center
                        @if($stepIndex <= $currentIndex)
                            bg-gold text-darkbg
                        @else
                            bg-white/10 text-gray-400
                        @endif
                    ">
                        ✓
                    </div>

                    <div class="text-sm font-semibold
                        @if($stepIndex <= $currentIndex)
                            text-gold
                        @else
                            text-gray-400
                        @endif
                    ">
                        {{ $label }}
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    {{-- Order Summary Grid --}}
    <div class="grid md:grid-cols-2 gap-6">

        {{-- Payment Info --}}
        <div class="glass rounded-3xl p-6 space-y-4">

            <h2 class="font-extrabold text-white">Payment Details</h2>

            <div class="flex justify-between text-sm text-gray-300">
                <span>Method</span>
                <span>{{ $order->paymentMethod->name ?? '-' }}</span>
            </div>

            <div class="flex justify-between text-sm text-gray-300">
                <span>Status</span>
                <span class="text-gold font-bold">
                    {{ str_replace('_',' ', ucfirst($order->status)) }}
                </span>
            </div>

            <div class="flex justify-between text-sm font-bold text-gold">
                <span>Paid Amount</span>
                <span>NPR {{ number_format($order->payable_npr,2) }}</span>
            </div>

            @if($order->payment_proof_path)
                <div class="mt-4">
                    <a href="{{ asset('storage/'.$order->payment_proof_path) }}"
                       target="_blank"
                       class="text-sm text-gold underline">
                        View Payment Proof
                    </a>
                </div>
            @endif

        </div>

        {{-- Shipping Address --}}
        <div class="glass rounded-3xl p-6 space-y-4">

            <h2 class="font-extrabold text-white">Shipping Address</h2>

            <div class="text-sm text-gray-300">
                {{ $order->address->full_name }}
            </div>

            <div class="text-sm text-gray-300">
                {{ $order->address->phone }}
            </div>

            <div class="text-sm text-gray-300">
                {{ $order->address->province }}, {{ $order->address->city }}
            </div>

            <div class="text-sm text-gray-300">
                {{ $order->address->address_line }}
            </div>

        </div>

    </div>

    {{-- Admin Notes --}}
    @if($order->admin_notes)
        <div class="glass rounded-3xl p-6 mt-6">
            <h2 class="font-extrabold text-white mb-2">Details</h2>
            <p class="text-gray-300 text-sm">
                {{ $order->admin_notes }}
            </p>
        </div>
    @endif

</div>
