@extends('layouts.app')
@section('content')
    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Product List</h1>
        <div>
            <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                + Add
            </a>
            <a href="{{ route('products.sync') }}" class="bg-green-500 text-white px-4 py-2 rounded ml-2">
                Sync Products
            </a>
        </div>
    </div>
    {{-- Modal Delete --}}
    <div id="deleteModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-87.5">
            <h2 class="text-lg font-semibold mb-4">Confirm Delete</h2>
            <p class="mb-4">Are you sure you want to delete this product?</p>

            <div class="flex justify-end gap-2">
                <button onclick="closeModal()" class="px-4 py-2 bg-gray-400 text-white rounded">
                    Cancel
                </button>

                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="px-4 py-2 bg-red-500 text-white rounded">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
    {{-- Filter & Search --}}
    <form method="GET" class="mb-4 bg-white p-4 rounded shadow">
        <div class="grid grid-cols-5 gap-2">
            <input type="text" name="search" placeholder="Search name..." value="{{ request('search') }}"
                class="border p-2">
            <input type="number" name="stock_min" placeholder="Min Stock" value="{{ request('stock_min') }}"
                class="border p-2">
            <input type="number" name="price_min" placeholder="Min Price" value="{{ request('price_min') }}"
                class="border p-2">
            <div class="flex gap-2">
                <button class="bg-blue-500 text-white px-4 py-2 rounded">
                    Filter
                </button>
                <a href="{{ route('products.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">
                    Reset
                </a>
            </div>
        </div>
    </form>

    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-200 text-center">
                <th class="p-2">No</th>
                <th class="p-2">Name</th>
                <th class="p-2">Price</th>
                <th class="p-2">Stock</th>
                <th class="p-2">Description</th>
                <th class="p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($products->isEmpty())
                <tr>
                    <td colspan="6" class="p-2 text-center">No products found.</td>
                </tr>
            @else
                @foreach ($products as $product)
                    <tr class="border-t text-center">
                        <td class="p-2">
                            {{ $products->firstItem() + $loop->index }}
                        </td>
                        <td class="p-2">{{ $product->name }}</td>
                        <td class="p-2">Rp {{ number_format($product->price) }}</td>
                        <td class="p-2">{{ $product->stock }}</td>
                        <td class="p-2 max-w-xs truncate">
                            {{ $product->description }}
                        </td>
                        <td class="p-2 flex gap-2 justify-center">
                            <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-400 px-3 py-1 rounded">
                                Edit
                            </a>
                            <button onclick="openModal('{{ route('products.destroy', $product->id) }}')"
                                class="bg-red-500 text-white px-3 py-1 rounded">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="mt-4">
        {{ $products->links() }}
    </div>
@endsection

<script>
    function openModal(actionUrl) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');

        form.action = actionUrl;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        const modal = document.getElementById('deleteModal');

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
