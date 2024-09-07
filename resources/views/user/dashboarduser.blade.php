<x-app-layout>
   
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-2 pb-96">
    
        @if (session()->has('success'))
        <x-alert message="{{session('success')}}"/>
        @endif
        
        
   

        <div class="flex mt-6 items-center justify-between">
            <h2 class="font-semibold text-xl">List Products</h2>
            
        </div>
        
        <div class="grid md:grid-cols-4 grid-cols-1 mt-7 gap-10">
            @foreach ($products as $product)
            <div>
                <a href="/detail/{{ $product->id }}"><img  src="{{ url('storage/' . $product->foto) }}" class=" h-96 w-full" /></a>
                <div class="my-2">
                    <p class="text-xl font-light">{{ $product->nama }}</p>
                    <p class="text-sm font-light truncate">{{ $product->deskripsi }}</p>
                    <p class="text-sm font-light">{{ $product->quantity }} Tersedia</p>
                    <p class="font-semibold text-gray-400">Rp. {{ number_format($product->harga,0,',','.') }}</p>
                </div>
                
                <div class="flex items-center gap-4">
                    <form action="{{ route('add.to.cart', $product->id) }}" method="post" class="ml-auto">
                        @csrf
                        <button type="submit" class="px-1 py-1 w-full text-sm rounded-lg font-semibold  items-center justify-center">
                             
                            <x-heroicon-o-shopping-cart class="w-7 h-7 justify-end"/>
                        </button>
                    </form>
                    
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