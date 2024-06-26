@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Edit Contact</h1>

        @if ($errors->any())
            <div class="bg-red-500 text-white px-4 py-2 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name:</label>
                <input type="text" name="name" id="name" class="w-full p-2 border rounded" value="{{ $contact->name }}">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" name="email" id="email" class="w-full p-2 border rounded" value="{{ $contact->email }}">
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-gray-700">Phone:</label>
                <input type="text" name="phone" id="phone" class="w-full p-2 border rounded" value="{{ $contact->phone }}">
            </div>
            <div class="mb-4">
                <label for="address" class="block text-gray-700">Address:</label>
                <input type="text" name="address" id="address" class="w-full p-2 border rounded" value="{{ $contact->address }}">
            </div>
            <div class="mb-4">
                <label for="category_id" class="block text-gray-700">Category:</label>
                <select name="category_id" id="category_id" class="w-full p-2 border rounded">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $contact->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" style="background-color: #38a169; color: white; padding: 0.75rem 1rem; border-radius: 0.375rem;">Update Contact</button>

        </form>
    </div>
@endsection
