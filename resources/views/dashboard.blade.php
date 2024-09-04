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
        
        <div class="grid md:grid-cols-4 grid-cols-1 mt-7 gap-10">
            @foreach ($products as $product)
            <div>
                <img  src="{{ url('storage/' . $product->foto) }}" class="h-96 w-full" />
                <div class="my-2">
                    <p class="text-xl font-light">{{ $product->nama }}</p>
                    <p class="text-sm font-light truncate">{{ $product->deskripsi }}</p>
                    <p class="text-sm font-light">Stok {{ $product->quantity }}</p>
                    <p class="font-semibold text-gray-400">Rp. {{ number_format($product->harga,0,',','.') }}</p>
                </div>
                
                <div class="flex items-center gap-4">
                    <form action="{{ route('add.to.cart', $product->id) }}" method="post" class="ml-auto">
                        @csrf
                        <button type="submit" class="bg-slate-900 px-1 py-1 w-full text-sm rounded-lg font-semibold  items-center justify-center">
                             
                            <x-heroicon-o-shopping-cart class="w-6 h-6 text-white justify-end"/>
                        </button>
                    </form>
                    <a href="/edit/{{$product->id}}"><button class="bg-slate-900 px-1 py-1 w-full text-sm rounded-lg font-semibold"><x-feathericon-edit class="w-6 h-6 justify-end text-white" /></button></a>
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