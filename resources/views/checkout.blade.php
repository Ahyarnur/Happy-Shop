<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-2 mt-5 pb-52">
        <h2 class="text-3xl font-semibold mb-5 mt-14">Checkout</h2>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informasi Pengguna -->
                    <div>
                        <h3 class="text-2xl font-semibold mb-4">Informasi Pengguna</h3>
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700">Nomor Telepon</label>
                            <input type="text" name="phone" id="phone" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="address" class="block text-gray-700">Alamat Pengiriman</label>
                            <textarea name="address" id="address" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                        </div>
                    </div>

                    <!-- Ringkasan Pesanan -->
                    <div>
                        <h3 class="text-2xl font-semibold mb-4">Ringkasan Pesanan</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left border-b border-gray-200">Produk</th>
                                        <th class="px-4 py-2 text-right border-b border-gray-200">Jumlah</th>
                                        <th class="px-4 py-2 text-right border-b border-gray-200">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $item)
                                    <tr>
                                        <td class="px-4 py-2 border-b border-gray-200">{{ $item->product->nama }}</td>
                                        <td class="px-4 py-2 text-right border-b border-gray-200">{{ $item->quantity }}</td>
                                        <td class="px-4 py-2 text-right border-b border-gray-200">Rp {{ number_format($item->product->harga * $item->quantity, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="px-4 py-2 text-right font-semibold border-t border-gray-200" colspan="2">Total</td>
                                        <td class="px-4 py-2 text-right font-semibold border-t border-gray-200">Rp {{ number_format($total, 0, ',', '.') }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Pilihan Pembayaran -->
                        <div class="mt-6">
                            <h4 class="text-xl font-semibold mb-2">Metode Pembayaran</h4>
                            <select name="payment_method" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="bank_transfer">Transfer Bank</option>
                                <option value="credit_card">Kartu Kredit</option>
                                <option value="cod">Bayar di Tempat (COD)</option>
                            </select>
                        </div>

                        <!-- Tombol Konfirmasi Pembayaran -->
                        <div class="mt-6">
                            <button type="submit" class="w-full bg-slate-900 text-white px-4 py-2 rounded-lg hover:bg-black">Konfirmasi Pembayaran</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
