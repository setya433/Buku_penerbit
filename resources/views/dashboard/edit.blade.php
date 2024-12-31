<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit Book</title>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        @include('partials.create')

        <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg mt-8">
            <h1 class="text-2xl font-semibold mb-6 text-center">Edit Book</h1>
            <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Book Title -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-medium mb-2">Book Title</label>
                    <input type="text" name="title" value="{{ $book->title }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Cover Image -->
                <div class="mb-4">
                    <label for="cover_image" class="block text-gray-700 font-medium mb-2">Cover Image</label>
                    <input type="file" name="cover_image"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @if ($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="mt-4 w-32 h-32 object-cover rounded-lg">
                    @endif
                </div>

                <!-- Category -->
                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700 font-medium mb-2">Category</label>
                    <select name="category_id" id="category_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Choose Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Author -->
                <div class="mb-4">
                    <label for="author_id" class="block text-gray-700 font-medium mb-2">Author</label>
                    <select name="author_id" id="author_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Choose Author</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Publisher -->
                <div class="mb-4">
                    <label for="publisher_id" class="block text-gray-700 font-medium mb-2">Publisher</label>
                    <select name="publisher_id" id="publisher_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Choose Publisher</option>
                        @foreach ($publishers as $publisher)
                            <option value="{{ $publisher->id }}" {{ $book->publisher_id == $publisher->id ? 'selected' : '' }}>{{ $publisher->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 mt-4">Update Book</button>
            </form>
        </div>

        @include('partials.copyright')
    </div>
</body>
</html>
