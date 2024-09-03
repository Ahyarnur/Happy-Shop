<x-app-layout>
   
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-2">
    
        @if (session()->has('success'))
        <x-alert message="{{session('success')}}"/>
        @endif
        
        
   

        <div class="flex mt-6 items-center justify-between">
            <h2 class="font-semibold text-xl">List Products</h2>
            <a href="{{route('create')}}">
                
                <button class="bg-gray-100 px-10 py-2 rounded-md font-semibold">Tambah</button>
            </a>
        </div>
        
        <div class="grid md:grid-cols-3 grid-cols-1 mt-4 gap-6">
            @foreach ($products as $product)
            <div>
                <img  src="{{ url('storage/' . $product->foto) }}" class="h-96 w-full" />
                <div class="my-2">
                    <p class="text-xl font-light">{{ $product->nama }}</p>
                    <p class="text-sm font-light">{{ $product->deskripsi }}</p>
                    <p class="text-sm font-light">Stok {{ $product->quantity }}</p>
                    <p class="font-semibold text-gray-400">Rp. {{ number_format($product->harga,0,',','.') }}</p>
                </div>
                
                <div class="flex items-center gap-20">
                    <form action="{{ route('add.to.cart', $product->id) }}" method="post">
                        @csrf
                        <button type="submit" class="bg-gray-100 px-10 py-2 w-full rounded-md font-semibold flex justify-center">
                            Masukan keranjang
                            <x-heroicon-o-shopping-cart class="w-6 h-6 justify-end ml-2"/>
                        </button>
                    </form>
                    <a href="/edit/{{$product->id}}"><button><x-feathericon-edit class="bg-gray-100 rounded-md font-semibold" /></button></a>
                </div>
            </div>

            @endforeach
            
            
            
        </div>
    </div>
    <div class="mt-4 flex justify-center">
        <div>
        {{ $products->links() }}

        </div>
    </div>
</div>
</x-app-layout>