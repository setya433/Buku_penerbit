<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

        {{-- @if (Auth::user()->name === 'admin') --}}
        <div class="mb-6">
            <a href="/dashboard/create"
            class="inline-block px-6 py-2.5 bg-gray-800 text-gray-100 font-semibold text-sm uppercase rounded shadow-md hover:bg-gray-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition duration-150 ease-in-out my-2 mx-2 sm:mx-3">
            Tambah Buku
            </a>
        </div>
        {{-- @endif --}}

        <div class="py-6">
            <div class="text-center mb-8">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-100">Rekap Data Kategori Buku</h2>
                <p class="text-gray-400">Jumlah buku berdasarkan kategori yang tersedia di perpustakaan</p>
            </div>

            <div class='container relative left-[150px]'>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:gap-8 ">
                @foreach ($counts as $category => $count)
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition-transform duration-300">
                    <div class="p-6 text-center">
                        <i class="fas fa-book text-4xl text-blue-300 mb-4"></i>
                        <h3 class="text-3xl font-bold text-gray-100">{{ $count }}</h3>
                        <p class="text-lg font-medium text-gray-300 mt-2">{{ $category }}</p>
                        <div class="mt-4">
                            <span class="text-sm text-blue-200 bg-blue-900 px-3 py-1 rounded-full">Kategori</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>


        <div class="py-6">
            <div class="text-center mb-8">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-100">Rekap Data Penerbit Buku</h2>
                <p class="text-gray-400">Jumlah buku berdasarkan penerbit yang tersedia di perpustakaan</p>
            </div>


            <div class='container relative left-[150px]'>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:gap-8">
                @foreach ($count_publisher as $publisher => $count)
                <div class="bg-gradient-to-r from-green-600 to-green-800 rounded-xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition-transform duration-300">
                    <div class="p-6 text-center">
                        <i class="fas fa-building text-4xl text-green-300 mb-4"></i>
                        <h3 class="text-3xl font-bold text-gray-100">{{ $count }}</h3>
                        <p class="text-lg font-medium text-gray-300 mt-2">{{ $publisher }}</p>
                        <div class="mt-4">
                            <span class="text-sm text-green-200 bg-green-900 px-3 py-1 rounded-full">Penerbit</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

        @include('partials.copyright')
    </div>
</body>
</html>
