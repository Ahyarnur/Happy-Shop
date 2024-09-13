<x-app-layout>
    <div class="overflow-x-auto px-60 mt-12">
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
                            <img src="{{ asset('storage/' . $details->cart()->first()->product()->first()->foto) }}" alt="{{ $details->nama }}" class="w-16 h-16 object-cover">
                        </td>
                        <td class="px-4 py-2 border-b border-gray-200">
                            {{ $details->cart()->first()->product()->first()->nama }}
                        </td>
                        <td class="px-4 py-2 text-right border-b border-gray-200">
                            Rp {{ number_format($details->cart()->first()->product()->first()->harga, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-2 text-center border-b border-gray-200">
                            <div class="inline-flex items-center">
                                <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 " onclick="updateQuantity({{ $details->cart()->first()->id }}, 'decrease')">-</button>
                                <span id="quantity-{{ $details->id }}" class="px-4 py-1">{{ $details->cart()->first()->quantity }}</span>
                                <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 " onclick="updateQuantity({{ $details->cart()->first()->id }}, 'increase')">+</button>
                            </div>
                        </td>
                        <td id="total-{{ $details->cart()->first()->id }}" class="px-4 py-2 text-right border-b border-gray-200">
                            Rp {{ number_format($details->cart()->first()->product()->first()->harga * $details->cart()->first()->quantity, 0, ',', '.') }}
                        </td>
                        {{-- <td class="px-4 py-2 text-center border-b border-gray-200">
                            <a href="{{ route('remove.from.cart', $details->id) }}" class="text-red-600 hover:text-red-800">
                                Hapus
                            </a>
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
    </div>
</x-app-layout>
