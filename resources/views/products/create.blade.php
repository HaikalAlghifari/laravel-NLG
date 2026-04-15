@extends('layouts.app')
@section('content')
    <h1 class="text-xl mb-4">Add Product</h1>
    <a href="{{ route('products.index') }}" class="inline-block mb-4 bg-gray-500 text-white px-3 py-1 rounded">
        ← Back
    </a>
    <form action="{{ route('products.store') }}" method="POST" class="bg-white p-4 rounded shadow">
        @csrf
        <label>Name</label>
        <input name="name" class="w-full mb-2 p-2 border">
        <label>Price</label>
        <input name="price" class="w-full mb-2 p-2 border">
        <label>Stock</label>
        <input name="stock" class="w-full mb-2 p-2 border">
        <label>Description</label>
        <textarea name="description" class="w-full mb-2 p-2 border"></textarea>
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
@endsection