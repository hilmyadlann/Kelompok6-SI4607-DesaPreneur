<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Produk Paling Disukai') }}
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
                        
                        @foreach($umkm as $umkm)
                        @foreach ($umkm->image as $images)
                        <div class="relative mr-10">
                            <img src="{{ asset('storage/' . $images->image_path) }}" alt="{{ $umkm->name }}" class="w-24 h-24 rounded-full border border-gray-400">
                            <span class="absolute bottom-0 right-0 bg-green-500 rounded-full w-6 h-6 flex items-center justify-center text-white">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                        </div>
                        @endforeach
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
    <a href="{{ route('umkms.products.mostLiked', $umkm->id) }}" class="btn btn-primary text-white ml-8 mt-5 bg-blue-500 hover:bg-blue-700">
        Paling Disukai
    </a>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mt-8">
                        <h2 class="text-lg font-bold ml-8 mb-4">Produk Paling Disukai</h2>
                        <div class="grid grid-cols-4 gap-4 max-w-8xl mx-auto sm:px-6 lg:px-8 mt-8">
                            @foreach ($mostLikedProducts as $index => $product)
                            <div class="card bg-base-100 shadow-xl mt-4 mb-8">
                                <figure>
                                    @if ($product->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $product->images->first()->image) }}" alt="{{ $product->name }}" class="h-48 object-cover">
                                    @else
                                    <img src="{{ asset('images/placeholder.jpg') }}" alt="Placeholder" class="h-48 object-cover">
                                    @endif
                                </figure>
                                <div class="card-body">
                                    <h3 class="card-title">{{ $product->name }}</h3>
                                    <p>Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>            
            </div>
        </div>
    </div>
</x-app-layout>