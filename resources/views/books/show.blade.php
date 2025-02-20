@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="container mx-auto px-4 py-12 relative">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <!-- Book Cover -->
                <div class="w-72 h-96 rounded-lg shadow-2xl overflow-hidden bg-white transform hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('storage/' . $book->cover) }}"
                         alt="{{ $book->title }}"
                         class="w-full h-full object-cover"
                         onerror="this.src='https://via.placeholder.com/400x600?text=No+Cover'">
                </div>
                <!-- Book Info -->
                <div class="flex-1 text-center lg:text-left">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">{{ $book->title }}</h1>
                    <div class="flex flex-wrap gap-4 justify-center lg:justify-start items-center mb-8">
                        <span class="px-4 py-2 bg-white bg-opacity-20 backdrop-blur-sm rounded-full text-sm font-medium">
                            By {{ $writer }}
                        </span>
                        <span class="px-4 py-2 {{ $book->borrower_id ? 'bg-yellow-400' : 'bg-green-400' }} bg-opacity-20 backdrop-blur-sm rounded-full text-sm font-medium">
                            {{ $book->borrower_id ? 'Currently Borrowed' : 'Available' }}
                        </span>
                        <span class="px-4 py-2 bg-white bg-opacity-20 backdrop-blur-sm rounded-full text-sm font-medium">
                            Added {{ $book->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                        @if($book->pdf)
                            <a href="{{ asset('storage/' . $book->pdf) }}"
                               target="_blank"
                               class="group inline-flex items-center px-6 py-3 bg-white text-blue-600 rounded-lg hover:bg-opacity-90 transition duration-150 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2 transform group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Download PDF
                            </a>
                        @endif
                        @if(!$book->borrower_id)
                            <form action="{{ route('books.borrow', $book) }}" method="POST" class="inline-block">
                                @csrf
                                <input type="hidden" name="borrower_id" value="{{ auth()->id() }}">
                                <button class="group inline-flex items-center px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-150 shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5 mr-2 transform group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <!-- Book Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">About this Book</h2>
                    <p class="text-gray-600 leading-relaxed">{{ $book->description }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Book Details</h2>
                    <dl class="space-y-4">
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Status</dt>
                            <dd class="font-medium text-gray-900">
                                @if($book->borrower_id)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Borrowed
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Available
                                    </span>
                                @endif
                            </dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Added By</dt>
                            <dd class="font-medium text-gray-900">{{ $writer }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Added Date</dt>
                            <dd class="font-medium text-gray-900">{{ $book->created_at->format('M d, Y') }}</dd>
                        </div>
                        @if($book->borrower_id)
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Borrowed By</dt>
                                <dd class="font-medium text-gray-900">{{ $book->borrower->name ?? 'Unknown' }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Borrowed Date</dt>
                                <dd class="font-medium text-gray-900">{{ $book->borrowed_at?->format('M d, Y') }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>

            <!-- Admin Actions -->
            @if(auth()->user() && auth()->user()->isAdmin)
                <div class="flex gap-4 justify-end">
                    <a href="{{ route('books.edit', $book) }}"
                       class="group inline-flex items-center px-4 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition duration-150 shadow-sm hover:shadow-md">
                        <svg class="w-5 h-5 mr-2 transform group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Book
                    </a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this book?')"
                                class="group inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-150 shadow-sm hover:shadow-md">
                            <svg class="w-5 h-5 mr-2 transform group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
