@extends('layouts.app')

@section('title', 'Borrowed Books')

@section('content')
    <!-- Hero Section -->
    <header class="bg-gray-900 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-5xl font-bold mb-4">Explore Our Collection</h1>
            <p class="text-xl mb-8">Find your next great read from our extensive library.</p>
            <a href="/explore" class="bg-white text-gray-900 py-2 px-6 rounded-full text-lg font-semibold hover:bg-gray-200 transition duration-300">Explore Books</a>
        </div>
    </header>

    <!-- Books Listing -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-8">All Books</h2>
            <div id="books-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($books as $book)
                    <div class="book-card bg-white rounded-lg shadow-md overflow-hidden transition duration-300 transform hover:scale-105">
                        <a href="{{ route('books.show', $book) }}">
                            <img src="{{ asset('/storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-64 object-cover">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-2">{{ $book->title }}</h3>
                                <p class="text-gray-600">{{ $book->author }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10 flex justify-center">
                {{ $books->links() }}
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const books = @json($books->items());
        const searchInput = document.getElementById('search-input');
        const booksContainer = document.getElementById('books-container');

        function createBookCard(book) {
            return `
            <div class="book-card bg-white rounded-lg shadow-md overflow-hidden transition duration-300 transform hover:scale-105">
                <a href="/books/${book.id}">
                    <img src="${book.cover}" alt="${book.title}" class="w-full h-64 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">${book.title}</h3>
                        <p class="text-gray-600">${book.author}</p>
                    </div>
                </a>
            </div>`;
        }

    });
</script>
@endpush
