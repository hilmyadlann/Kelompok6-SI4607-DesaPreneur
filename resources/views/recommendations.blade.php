@extends('layouts.app')

@section('content')
    <h1>Rekomendasi Produk</h1>

    <ul>
        @forelse ($recommendedProducts as $product)
            <li>{{ $product->name }}</li>
        @empty
            <li>Tidak ada produk yang direkomendasikan.</li>
        @endforelse
    </ul>
@endsection