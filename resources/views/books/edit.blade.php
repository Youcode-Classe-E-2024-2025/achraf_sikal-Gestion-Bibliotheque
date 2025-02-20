@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Edit Book</h1>
                <p class="mt-2 text-sm text-gray-600">Update the information for "{{ $book->title }}"</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-8 rounded-lg bg-red-50 p-4 border border-red-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Edit Form -->
            <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-sm rounded-lg overflow-hidden">
                @csrf
                @method('PUT')

                <div class="p-8 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text"
                               name="title"
                               id="title"
                               value="{{ $book->title }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                               required>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description"
                                  id="description"
                                  rows="4"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                  required>{{ $book->description }}</textarea>
                    </div>

                    <!-- Writer & Borrower IDs -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="writer_id" class="block text-sm font-medium text-gray-700">Writer ID</label>
                            <input type="number"
                                   name="writer_id"
                                   id="writer_id"
                                   value="{{ $book->writer_id }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                   required>
                        </div>
                        <div>
                            <label for="borrower_id" class="block text-sm font-medium text-gray-700">Borrower ID (optional)</label>
                            <input type="number"
                                   name="borrower_id"
                                   id="borrower_id"
                                   value="{{ $book->borrower_id }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>

                    <!-- Cover Image -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Cover Image</label>
                        <div class="mt-2 flex items-center space-x-6">
                            <img src="{{ asset('storage/' . $book->cover) }}"
                                 alt="Current cover"
                                 class="h-32 w-24 object-cover rounded-lg shadow-sm">
                            <div class="flex-1">
                                <input type="file"
                                       name="cover"
                                       id="cover"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="mt-2 text-xs text-gray-500">Recommended size: 600x900 pixels</p>
                            </div>
                        </div>
                    </div>

                    <!-- PDF File -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">PDF File</label>
                        <div class="mt-2 flex items-center space-x-6">
                            <div class="flex-1">
                                <input type="file"
                                       name="pdf"
                                       id="pdf"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                @if($book->pdf)
                                    <a href="{{ asset('storage/' . $book->pdf) }}"
                                       class="inline-flex items-center mt-2 text-sm text-blue-600 hover:text-blue-500"
                                       target="_blank">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        View Current PDF
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="bg-gray-50 px-8 py-5 flex items-center justify-end space-x-3">
                    <a href="{{ route('books.show', $book) }}"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
