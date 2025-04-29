<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Nama Produk</span>
                            </label>
                            <input type="text" name="name" class="input input-bordered @error('name') input-error @enderror" value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Deskripsi Produk</span>
                            </label>
                            <textarea name="description" class="textarea textarea-bordered @error('description') textarea-error @enderror" required>{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Harga Produk</span>
                            </label>
                            <input type="number" name="price" step="0.01" class="input input-bordered @error('price') input-error @enderror" value="{{ old('price', $product->price) }}" required>
                            @error('price')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Kategori Produk</span>
                            </label>
                            <select name="category_id" class="select select-bordered @error('category_id') select-error @enderror" required>
                                <option value="" disabled {{ old('category_id', isset($product) ? $product->category_id : '') == '' ? 'selected' : '' }}>Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', isset($product) ? $product->category_id : '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Link Marketplace</span>
                            </label>
                            <input type="text" name="marketplace_link" class="input input-bordered @error('marketplace_link') input-error @enderror" value="{{ old('marketplace_link', $product->marketplace_link) }}">
                            @error('marketplace_link')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="form-control">  
                            <label class="label">
                                <span class="label-text">Gambar Produk</span>
                            </label>
                            <input type="file" name="images[]" class="file-input file-input-bordered file-input-primary w-full" multiple>
                        </div>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 rounded mt-6">Update Produk</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>