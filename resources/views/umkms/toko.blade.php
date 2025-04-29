<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Atur Toko') }}
        </h2>
    </x-slot>

    <div class="py-12" class="bg-white">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- start code manda --}}
                    <div class="flex items-center">
                        
                        @foreach($umkm->image as $image)
                        <div class="relative mr-10">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $umkm->name }}" class="w-24 h-24 rounded-full border border-gray-400">
                            <span class="absolute bottom-0 right-0 bg-green-500 rounded-full w-6 h-6 flex items-center justify-center text-white">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                        </div>
                        @endforeach

                        <div class="p-8 md:p-25">
                            <h1 class="text-2xl font-bold">{{ $umkm->nama }}</h1>
                            <h5 class="text-xl">{{ $umkm->deskripsi }}</h5>                            
                            <br>
                            <a href="{{ route('umkm.show', $umkm->id) }}" class="btn btn-success text-white">Profil UMKM Saya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>            
    </div>
    <a href="{{ route('products.upload') }}" class="btn btn-success text-white ml-8 mt-5">
        Upload Produk
    </a>

    {{-- end code manda --}}

    <div class="mt-8">
    <h2 class="text-lg font-bold ml-8 mb-4">Produk Toko</h2>
    <div class="grid grid-cols-4 gap-4 max-w-8xl mx-auto sm:px-6 lg:px-8 mt-8">
        @foreach ($products as $product)
        <div class="card bg-base-100 shadow-xl">
            <figure>
                @if ($product->images->isNotEmpty())
                @foreach ($product->images as $image)
                <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}" class="h-48 object-cover">
                @endforeach
                @else
                <img src="{{ asset('images/placeholder.jpg') }}" alt="Placeholder" class="h-48 object-cover">
                @endif
            </figure>
            <div class="card-body">
                <h3 class="card-title">{{ $product->name }}</h3>
                <p>Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                <p id="likes-count">{{ $product->likes_count }}x Disukai</p>
                <div class="card-actions justify-end">
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Lihat Detail</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary btn-sm bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>        
       
</x-app-layout>
