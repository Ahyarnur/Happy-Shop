
<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-2 mt-5 pb-52">

        @if (session()->has('success'))
        <x-alert message="{{session('success')}}"/>
        @endif
        
        <h2 class="text-3xl font-semibold mt-32 mb-10">Keranjang Belanja</h2>
        
        @php
            $data = App\Models\Cart::where('user_id', Auth::id())->where('is_checkout', false)->get();
        @endphp
        
        @if($data->count())
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left border-b border-gray-400">Foto Produk</th>
                            <th class="px-4 py-2 text-left border-b border-gray-400">Nama Produk</th>
                            <th class="px-4 py-2 text-right border-b border-gray-400">Harga</th>
                            <th class="px-4 py-2 text-center border-b border-gray-400">Jumlah</th>
                            <th class="px-4 py-2 text-right border-b border-gray-400">Total</th>
                            <th class="px-4 py-2 text-center border-b border-gray-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $details)
                            <tr id="cart-item-{{ $details->id }}">
                                <td class="px-4 py-5 border-b border-gray-200">
                                    <img src="{{ asset('storage/' . $details->product()->first()->foto) }}" alt="{{ $details->nama }}" class="w-16 h-16 object-cover">
                                </td>
                                <td class="px-4 py-2 border-b border-gray-200">
                                    {{ $details->product()->first()->nama }}
                                </td>
                                <td class="px-4 py-2 text-right border-b border-gray-200">
                                    Rp {{ number_format($details->product()->first()->harga, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 text-center border-b border-gray-200">
                                    <div class="inline-flex items-center">
                                        <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 " onclick="updateQuantity({{ $details->id }}, 'decrease')">-</button>
                                        <span id="quantity-{{ $details->id }}" class="px-4 py-1">{{ $details->quantity }}</span>
                                        <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 " onclick="updateQuantity({{ $details->id }}, 'increase')">+</button>
                                    </div>
                                </td>
                                <td id="total-{{ $details->id }}" class="px-4 py-2 text-right border-b border-gray-200">
                                    Rp {{ number_format($details->product()->first()->harga * $details->quantity, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 text-center border-b border-gray-200">
                                    <a href="{{ route('remove.from.cart', $details->id) }}" class="text-red-600 hover:text-red-800">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="/checkout" class="inline-block bg-slate-900 text-white px-6 py-2 mt-5 rounded-lg absolute right-60 hover:bg-black">
                        Lanjutkan ke Checkout
                    </a>
            </div>
        @else
            <p class="text-gray-500">Keranjang belanja Anda kosong.</p>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateQuantity(cartId, action) {
            $.ajax({
                url: "{{ route('update.cart') }}", // Update this route with the correct one
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: cartId,
                    action: action,
                },
                success: function(response) {
                    // Update quantity
                    $('#quantity-' + cartId).text(response.quantity);
                    // Update total price
                    $('#total-' + cartId).text('Rp ' + new Intl.NumberFormat('id-ID').format(response.total));
                }
            });
        }
    </script>
</x-app-layout>

