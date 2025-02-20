@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Edit Book</h1>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-2 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label class="block mb-2">Title:</label>
            <input type="text" name="title" class="w-full p-2 border rounded mb-4" value="{{ $book->title }}" required>

            <label class="block mb-2">Description:</label>
            <textarea name="description" class="w-full p-2 border rounded mb-4" required>{{ $book->description }}</textarea>

            <label class="block mb-2">Writer ID:</label>
            <input type="number" name="writer_id" class="w-full p-2 border rounded mb-4" value="{{ $book->writer_id }}" required>

            <label class="block mb-2">Borrower ID (optional):</label>
            <input type="number" name="borrower_id" class="w-full p-2 border rounded mb-4" value="{{ $book->borrower_id }}">

            <label class="block mb-2">Cover Image:</label>
            <input type="file" name="cover" class="w-full p-2 border rounded mb-4">
            <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover" class="w-40">

            <label class="block mb-2">PDF File:</label>
            <input type="file" name="pdf" class="w-full p-2 border rounded mb-4">
            <a href="{{ asset('storage/' . $book->pdf) }}" class="text-blue-500" target="_blank">View Current PDF</a>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update Book</button>
        </form>
    </div>
@endsection
