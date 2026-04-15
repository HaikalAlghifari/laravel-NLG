@extends('layouts.app')
@section('content')
    <h1 class="text-xl mb-4">Edit Product</h1>
    <a href="{{ route('products.index') }}" class="inline-block mb-4 bg-gray-500 text-white px-3 py-1 rounded">
        ← Back
    </a>
    <form action="{{ route('products.update', $product->id) }}" method="POST" class="bg-white p-4 rounded shadow">
        @csrf
        @method('PUT')
        <input name="name" value="{{ $product->name }}" class="w-full mb-2 p-2 border">
        <input name="price" value="{{ $product->price }}" class="w-full mb-2 p-2 border">
        <input name="stock" value="{{ $product->stock }}" class="w-full mb-2 p-2 border">
        <textarea name="description" class="w-full mb-2 p-2 border">{{ $product->description }}</textarea>
        <button class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
    </form>
@endsection
