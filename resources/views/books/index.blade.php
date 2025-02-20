@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-8 space-y-4 sm:space-y-0">
            <div class="flex items-center space-x-3">
                <h1 class="text-4xl font-bold text-gray-900">Library Collection</h1>
                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                    {{ $books->count() }} Books
                </span>
            </div>
            <a href="{{ route('books.create') }}"
               class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition duration-150 ease-in-out shadow-sm hover:shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add New Book
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded-lg mb-6 shadow-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($books as $book)
                <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col">
                    <!-- Book Cover -->
                    <div class="h-40 w-full bg-gray-200 rounded-lg mb-4 flex items-center justify-center">
                        <img src="{{ asset('/storage/'.$book->cover) }}" alt="{{ $book->title }}" class="h-full w-full object-cover rounded-lg">
                    </div>
                    
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $book->title }}</h2>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($book->description, 100) }}</p>

                    <div class="mt-auto flex justify-between items-center">
                        <a href="{{ route('books.show', $book) }}" class="text-blue-500 hover:underline">View</a>
                        <a href="{{ route('books.edit', $book) }}" class="text-yellow-500 hover:underline">Edit</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
