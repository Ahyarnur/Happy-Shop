<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-2">

        <div class="flex mt-6">
            <h2 class="font-semibold text-xl">Detail Products</h2>
            
        </div>


        <div class="mt-4" x-data="{ imageUrl: '/storage/{{$detail->foto}}' }">
            <div class="flex gap-8">


                
                <div class="w-1/2">
                    <img :src="imageUrl" class="rounded-md" />
                </div>

                <div class="w-1/2">
                    <div class="mt-4">
                    
                    <div class="mt-4">
                        <x-input-label for="nama" :value="__('Nama')" />
                        <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" value="{{$detail->nama}}" required />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="harga" :value="__('Harga')" />
                        <x-text-input id="harga" class="block mt-1 w-full" type="text" name="harga" value="{{$detail->harga}}" x-mask:dynamic="$money($input, ',')" required />
                        <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                        <x-text-area id="deskripsi" class="block mt-1 w-full" type="text" name="deskripsi">{{$detail->deskripsi}}</x-text-area>
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="quantity" :value="__('Quantity')" />
                        <x-text-input id="quantity" class="block mt-1 w-full" type="text" name="quantity" value="{{$detail->quantity}}" required />
                        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                    </div>
                    
                    <a href="/dashboard"> <x-primary-button class="justify-center mt-4 w-full">
                        {{ __('kembali') }}
                    </x-primary-button></a>
                   
                   </div>
                
                </div>
        </div>
    </div>
</x-app-layout>