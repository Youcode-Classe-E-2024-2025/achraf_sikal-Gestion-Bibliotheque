@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Add a New Book</h1>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-2 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label class="block mb-2">Title:</label>
            <input type="text" name="title" class="w-full p-2 border rounded mb-4" required>

            <label class="block mb-2">Description:</label>
            <textarea name="description" class="w-full p-2 border rounded mb-4" required></textarea>

            <label class="block mb-2">Cover Image:</label>
            <input type="file" name="cover" class="w-full p-2 border rounded mb-4" required>

            <label class="block mb-2">PDF File:</label>
            <input type="file" name="pdf" class="w-full p-2 border rounded mb-4" required>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save Book</button>
        </form>
    </div>
@endsection
