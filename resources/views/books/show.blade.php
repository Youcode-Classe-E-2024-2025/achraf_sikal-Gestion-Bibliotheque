@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <!-- Book Cover -->
                <div class="w-64 h-80 rounded-lg shadow-2xl overflow-hidden bg-white">
                    <img src="{{ asset('storage/' . $book->cover) }}"
                         alt="{{ $book->title }}"
                         class="w-full h-full object-cover"
                         onerror="this.src='https://via.placeholder.com/400x600?text=No+Cover'">
                </div>
                <!-- Book Info -->
                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-4xl font-bold mb-2">{{ $book->title }}</h1>
                    <div class="flex flex-wrap gap-4 justify-center md:justify-start items-center mb-6">
                        <span class="px-3 py-1 bg-blue-500 bg-opacity-20 rounded-full text-sm">
                            Writer : {{ $writer }}
                        </span>
                        <span class="px-3 py-1 bg-blue-500 bg-opacity-20 rounded-full text-sm">
                            Status: {{ $book->borrower_id ? 'Borrowed' : 'Available' }}
                        </span>
                    </div>
                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                        @if($book->pdf)
                            <a href="{{ asset('storage/' . $book->pdf) }}"
                               target="_blank"
                               class="inline-flex items-center px-6 py-3 bg-white text-blue-600 rounded-lg hover:bg-opacity-90 transition duration-150 shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Download PDF
                            </a>
                        @endif
                        @if(!$book->borrower_id)
                        <form action="{{ route('books.borrow', $book) }}" method="POST">
                            @csrf
                            <input type="hidden" name="borrower_id" value="{{ auth()->id() }}">
                            <button class="inline-flex items-center px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-150 shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Borrow Book
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <!-- Description -->
            <div class="bg-white rounded-xl shadow-sm p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">About this Book</h2>
                <p class="text-gray-600 leading-relaxed">{{ $book->description }}</p>
            </div>

            <!-- Admin Actions -->
            @if(auth()->user() && auth()->user()->isAdmin)
                <div class="flex gap-4 justify-end">
                    <a href="{{ route('books.edit', $book) }}"
                       class="inline-flex items-center px-4 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition duration-150 shadow-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Book
                    </a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this book?')"
                                class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-150 shadow-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete Book
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
