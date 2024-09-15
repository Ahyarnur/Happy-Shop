{{-- <x-app-layout>
    <div class="overflow-x-auto px-60 mt-12">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left border-b border-gray-400">Nama</th>
                    <th class="px-4 py-2 text-left border-b border-gray-400">Email</th>
                    <th class="px-4 py-2 text-left border-b border-gray-400">Phone</th>
                    <th class="px-4 py-2 text-left border-b border-gray-400">Alamat</th>
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
                               
                                <span id="quantity-{{ $details->id }}" class="px-4 py-1">{{ $details->cart()->first()->quantity }}</span>
                               
                            </div>
                        </td>
                        <td id="total-{{ $details->cart()->first()->id }}" class="px-4 py-2 text-right border-b border-gray-200">
                            Rp {{ number_format($details->cart()->first()->product()->first()->harga * $details->cart()->first()->quantity, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-2 text-center border-b border-gray-200">
                            <a href="{{ route('remove.from.monitor', $details->id) }}" class="text-red-600 hover:text-red-800">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
    </div>
</x-app-layout> --}}
<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-2 mt-12">
        <h2 class="text-3xl font-semibold mb-5">Daftar Order</h2>

        @if($data->count())
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left border-b border-gray-200">Nama</th>
                            <th class="px-4 py-2 text-left border-b border-gray-200">Email</th>
                            <th class="px-4 py-2 text-left border-b border-gray-200">Phone</th>
                            <th class="px-4 py-2 text-left border-b border-gray-200">Alamat</th>
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
                                <!-- Nama Pemesan -->
                                <td class="px-4 py-2 border-b border-gray-200">{{ $details->cart->user->name }}</td>

                                <!-- Email -->
                                <td class="px-4 py-2 border-b border-gray-200">{{ $details->cart->user->email }}</td>

                                <!-- Phone -->
                                <td class="px-4 py-2 border-b border-gray-200">{{ $details->cart->user->phone }}</td>

                                <!-- Alamat -->
                                <td class="px-4 py-2 border-b border-gray-200">{{ $details->cart->user->address }}</td>

                                <!-- Foto Produk -->
                                <td class="px-4 py-2 border-b border-gray-200">
                                    <img src="{{ asset('storage/' . $details->cart->product->foto) }}" alt="{{ $details->cart->product->nama }}" class="w-16 h-16 object-cover">
                                </td>

                                <!-- Nama Produk -->
                                <td class="px-4 py-2 border-b border-gray-200">{{ $details->cart->product->nama }}</td>

                                <!-- Harga -->
                                <td class="px-4 py-2 text-right border-b border-gray-200">
                                    Rp {{ number_format($details->cart->product->harga, 0, ',', '.') }}
                                </td>

                                <!-- Jumlah -->
                                <td class="px-4 py-2 text-center border-b border-gray-200">
                                    <span id="quantity-{{ $details->cart->id }}">{{ $details->cart->quantity }}</span>
                                </td>

                                <!-- Total Harga untuk item ini -->
                                <td id="total-{{ $details->cart->id }}" class="px-4 py-2 text-right border-b border-gray-200">
                                    Rp {{ number_format($details->cart->product->harga * $details->cart->quantity, 0, ',', '.') }}
                                </td>

                                <!-- Aksi -->
                                <td class="px-4 py-2 text-center border-b border-gray-200">
                                    <a href="{{ route('remove.from.monitor', $details->id) }}" class="text-red-600 hover:text-red-800">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">Belum ada data order.</p>
        @endif
    </div>
</x-app-layout>
