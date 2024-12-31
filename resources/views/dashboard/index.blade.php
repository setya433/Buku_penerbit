<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Perpustakaan</title>
</head>
<body class="bg-gray-900 text-gray-100">
    <div class="container mx-auto py-4 sm:py-8 px-4 sm:px-6 lg:px-8">
        @include('partials.navigation')

        @if (Auth::user()->role === 'admin')
        <div class="mb-6">
            <a href="/dashboard/create"
            class="inline-block px-6 py-2.5 bg-gray-800 text-gray-100 font-semibold text-sm uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition duration-150 ease-in-out my-2 mx-2 sm:mx-3">
            Tambah Buku
            </a>
        </div>
        @endif

        @if (Auth::user()->role === 'admin')
        <form action="{{ route('book.search') }}" method="GET" class="flex items-center space-x-4 bg-gray p-2 rounded-lg shadow-lg">
            <input type="text" name="search" placeholder="Search by title"
                   class="w-full px-4 py-2 text-white bg-gray-800 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="{{ request()->get('search') }}">

            <select name="category_id" class="px-4 py-2 bg-gray-800 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request()->get('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="px-4 py-2 bg-blue-800 text-white rounded-lg hover:bg-blue-700 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                <i class="fas fa-search"></i>
            </button>
        </form>
        @endif

        <div class="py-6">
            @if ($books->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:gap-8">
                @foreach ($books as $item)
                <div id="book-{{ $item->id }}" class="bg-gray-800 rounded-xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition-transform duration-300">
                        <img src="{{ asset('storage/' . $item->cover_image) }}" alt="{{ $item->title }}"
                            class="w-full h-48 sm:h-56 object-cover rounded-t-2xl">
                        <div class="p-4 sm:p-6">
                            <h5 class="text-lg sm:text-xl font-semibold text-gray-100 mb-2">{{ $item->title }}</h5>
                            <p class="text-gray-400 text-sm sm:text-base max-h-20 overflow-hidden text-ellipsis">{{ $item->category->name}}</p>
                            <p class="text-gray-400 text-sm sm:text-base max-h-20 overflow-hidden text-ellipsis">{{ $item->author->name}}</p>
                            <p class="text-gray-400 text-sm sm:text-base max-h-20 overflow-hidden text-ellipsis">{{ $item->publisher->name}}</p>

                        </div>

            @if (Auth::user()->role === 'admin')
            <div class="p-4 flex justify-between space-x-2">

                <a href="{{ route('book.edit', $item->id) }}"
                    class="w-full px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200 ease-in-out flex items-center justify-center">
                    <i class="fas fa-edit mr-2"></i> Edit
                 </a>

                <form action="{{ route('book.destroy', $item->id) }}" method="POST" id="delete-form-{{ $item->id }}" class="w-full">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmDelete({{ $item->id }})"
                            class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 ease-in-out">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
                    @endif
                </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $books->links('pagination::tailwind') }}
            </div>


            @else
            <div class="text-center py-6">
                <p class="text-gray-400 italic">Buku tidak ada.</p>
            </div>
            @endif
        </div>

        @include('partials.copyright')
    </div>

    <script>
        function confirmDelete(itemId) {
            const form = document.getElementById(`delete-form-${itemId}`);
            const url = form.action;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                data.success,
                                'success'
                            );
                            // Hapus elemen div berdasarkan ID
                            const bookDiv = document.getElementById(`book-${itemId}`);
                            if (bookDiv) {
                                bookDiv.remove();
                            }
                        } else {
                            Swal.fire(
                                'Failed!',
                                'Failed to delete item. Please try again.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            'Failed to delete item. Please try again.',
                            'error'
                        );
                    });
                }
            });
        }
    </script>
</body>
</html>
