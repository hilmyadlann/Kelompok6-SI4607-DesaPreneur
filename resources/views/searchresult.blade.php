<!DOCTYPE html>
<html>
<head>
    <title>Hasil Pencarian</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
<header class="absolute inset-x-0 top-0 z-40">
    <nav class="flex items-center justify-between p-5 lg:px-20 bg-green-500 row-gap: 0px;" aria-label="Global">
        <div class="flex items-center">
            <a href="{{ route('dashboard') }}" class="p-1 mr-1">
                <img class="h-10 w-auto" src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
        </div>
        <div class="absolute left-2/4 transform -translate-x-2/4">
            <form action="{{ route('search') }}" class="flex items-center bg-white rounded-lg" method="GET">
                <input type="text" name="query" placeholder="Search" class="w-80 sm:w-96 bg-transparent outline-none py-2 px-4">
                <button type="submit" class="ml-1 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M11.406 13.093a5.5 5.5 0 111.414-1.414l3.293 3.293a1 1 0 11-1.414 1.414l-3.293-3.293zM9.5 15a5.5 5.5 0 100-11 5.5 5.5 0 000 11z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
        </div>
    </nav>
</header>
    <div class="flex justify-center container mx-auto py-7">
        <h1 class=" text-center text-2xl font-bold mt-20">Hasil Pencarian untuk "{{ $query }}"</h1>
    </div>
    <div>
        @if ($products->count() > 0)
            <div class="grid grid-cols-4 gap-4 mx-4 mb-6 items-start"> @foreach ($products as $product)
                <a href="{{ route('products.show', $product) }}">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">
                        <div class="flex-grow"> 
                            @if ($product->images->isNotEmpty())
                                @foreach ($product->images as $image)
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                @endforeach
                            @else
                                <img src="{{ asset('images/placeholder.jpg') }}" alt="Placeholder" class="w-full h-48 object-cover">
                            @endif
                        </div> <div class="p-4"> <h2 class="text-lg font-semibold mb-2">{{ $product->name }}</h2>
                            <p class="text-gray-600">Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </a> @endforeach
            </div>
        @else
            <div class="mt-4">
                <p class="text-center text-black">Tidak ada produk yang ditemukan.</p>
            </div>    
        @endif
    </div>
</body>
</html>