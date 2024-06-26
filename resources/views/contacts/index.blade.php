@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Contact List</h1>

        <div class="flex justify-between items-center mb-4">
            <form action="{{ route('contacts.index') }}" method="GET" class="flex">
                <input type="text" name="search" placeholder="Search contacts..." value="{{ request('search') }}" class="p-2 border rounded">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Search</button>
            </form>

            <form action="{{ route('contacts.index') }}" method="GET" class="flex">
                <select name="sort" class="p-2 border rounded" onchange="this.form.submit()">
                    <option value="" disabled selected>Sort by</option>
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest Added</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest Added</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name A-Z</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name Z-A</option>
                </select>
            </form>
        </div>

        <form action="{{ route('contacts.index') }}" method="GET" class="flex mb-4">
            <select name="category_id" class="p-2 border rounded" onchange="this.form.submit()">
                <option value="" disabled selected>Filter by Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </form>


    @if ($message = Session::get('success'))
            <div class="bg-green-500 text-white px-4 py-2 mt-4 rounded">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table-auto w-full mt-4">
            <thead>
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Phone</th>
                <th class="px-4 py-2">Address</th>
                <th class="px-4 py-2">Category</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td class="border px-4 py-2">{{ $contact->name }}</td>
                    <td class="border px-4 py-2">{{ $contact->email }}</td>
                    <td class="border px-4 py-2">{{ $contact->phone }}</td>
                    <td class="border px-4 py-2">{{ $contact->address }}</td>
                    <td class="border px-4 py-2">{{ $contact->category->name ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('contacts.edit', $contact->id) }}" class="bg-green-500 text-white px-4 py-2 rounded">Edit</a>
                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
