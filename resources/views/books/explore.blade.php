@extends('layouts.app')

@section('title', 'Explore All Books')

@section('content')
    <!-- Hero Section -->
    <header class="bg-gray-900 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-5xl font-bold mb-4">Explore All Books</h1>
            <p class="text-xl mb-8">Discover thousands of books across different genres and authors.</p>
            <a href="#explore-books" class="bg-white text-gray-900 py-2 px-6 rounded-full text-lg font-semibold hover:bg-gray-200 transition duration-300">Start Exploring</a>
        </div>
    </header>

    <!-- All Books Section -->
    <section class="py-16" id="explore-books">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-8">All Books</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8" id="books-container">
                <!-- Books will be dynamically added here -->
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-8">Find Your Next Read</h2>
            <div class="max-w-md mx-auto">
                <div class="relative">
                    <input type="text" id="search-input" placeholder="Search books..." class="w-full py-3 px-4 bg-gray-100 rounded-full focus:outline-none focus:ring-2 focus:ring-gray-900">
                    <button id="search-button" class="absolute right-0 top-0 mt-3 mr-4">
                        <svg class="h-6 w-6 text-gray-600" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Fetch all books (instead of featured)
    const books = [
        @foreach ($books as $book)
        { id: "{{ $book->id }}", title: "{{ $book->title }}", author: "{{ $book->author }}", cover: "{{ asset('storage/'.$book->cover) }}" },
        @endforeach
    ];

    // Function to create book cards
    function createBookCard(book) {
        return `
        <a id="book_card_container_anchor" href="/books/${book.id}">
            <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 transform hover:scale-105">
                <img src="${book.cover}" alt="${book.title}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold mb-2">${book.title}</h3>
                    <p class="text-gray-600">${book.author}</p>
                </div>
            </div>
        </a>
        `;
    }

    // Populate all books
    const booksContainer = document.getElementById('books-container');
    books.forEach(book => {
        booksContainer.innerHTML += createBookCard(book);
    });

    // Search functionality
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');

    searchButton.addEventListener('click', performSearch);
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });

    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase();
        const filteredBooks = books.filter(book =>
            book.title.toLowerCase().includes(searchTerm) ||
            book.author.toLowerCase().includes(searchTerm)
        );

        booksContainer.innerHTML = '';
        filteredBooks.forEach(book => {
            booksContainer.innerHTML += createBookCard(book);
        });
    }
</script>
@endpush
