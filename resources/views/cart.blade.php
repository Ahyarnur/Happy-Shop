{{-- <x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-2 mt-5">
        <h2 class="text-3xl font-semibold mb-5">Keranjang Belanja</h2>
        
        @php
            $data = App\Models\Cart::where('user_id', Auth::id())->get();
        @endphp
        
        @if($data->count())
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left border-b border-gray-200">Nama Produk</th>
                            <th class="px-4 py-2 text-right border-b border-gray-200">Harga</th>
                            <th class="px-4 py-2 text-center border-b border-gray-200">Jumlah</th>
                            <th class="px-4 py-2 text-right border-b border-gray-200">Total</th>
                            <th class="px-4 py-2 text-center border-b border-gray-200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $details)
                            <tr>
                                <td class="px-4 py-2 border-b border-gray-200">
                                    {{ $details->product()->first()->nama }}
                                </td>
                                <td class="px-4 py-2 text-right border-b border-gray-200">
                                    Rp {{ number_format($details->product()->first()->harga, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 text-center border-b border-gray-200">
                                    <div class="inline-flex items-center border border-gray-300">
                                        <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 border-r border-gray-300">-</button>
                                        <span class="px-4 py-1">{{ $details->quantity }}</span>
                                        <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 border-l border-gray-300">+</button>
                                    </div>
                                </td>
                                <td class="px-4 py-2 text-right border-b border-gray-200">
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
            </div>
        @else
            <p class="text-gray-500">Keranjang belanja Anda kosong.</p>
        @endif
    </div>
</x-app-layout> --}}
<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-2 mt-5">
        <h2 class="text-3xl font-semibold mb-5">Keranjang Belanja</h2>
        
        @php
            $data = App\Models\Cart::where('user_id', Auth::id())->get();
        @endphp
        
        @if($data->count())
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left border-b border-gray-200">Foto Produk</th>
                            <th class="px-4 py-2 text-left border-b border-gray-200">Nama Produk</th>
                            <th class="px-4 py-2 text-right border-b border-gray-200">Harga</th>
                            <th class="px-4 py-2 text-center border-b border-gray-200">Jumlah</th>
                            <th class="px-4 py-2 text-right border-b border-gray-200">Total</th>
                            <th class="px-4 py-2 text-center border-b border-gray-200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $details)
                            <tr id="cart-item-{{ $details->id }}">
                                <td class="px-4 py-2 border-b border-gray-200">
                                    <img src="{{$details->product()->first()->foto}}" alt="">
                                </td>
                                <td class="px-4 py-2 border-b border-gray-200">
                                    {{ $details->product()->first()->nama }}
                                </td>
                                <td class="px-4 py-2 text-right border-b border-gray-200">
                                    Rp {{ number_format($details->product()->first()->harga, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 text-center border-b border-gray-200">
                                    <div class="inline-flex items-center border border-gray-300">
                                        <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 border-r border-gray-300" onclick="updateQuantity({{ $details->id }}, 'decrease')">-</button>
                                        <span id="quantity-{{ $details->id }}" class="px-4 py-1">{{ $details->quantity }}</span>
                                        <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 border-l border-gray-300" onclick="updateQuantity({{ $details->id }}, 'increase')">+</button>
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

