<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Tampilkan daftar kontak dengan pencarian dan filter
    public function index(Request $request)
    {
        $query = Contact::query();

        // Pencarian
        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%");
        }

        $categories = Category::all();

        // Filter berdasarkan category_id
        if ($categoryId = $request->input('category_id')) {
            $query->where('category_id', $categoryId);
        }

        // Filter
        if ($sort = $request->input('sort')) {
            if ($sort == 'latest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($sort == 'oldest') {
                $query->orderBy('created_at', 'asc');
            } elseif ($sort == 'name_asc') {
                $query->orderBy('name', 'asc');
            } elseif ($sort == 'name_desc') {
                $query->orderBy('name', 'desc');
            }
        } else {
            $query->orderBy('name', 'asc'); // Default sorting by name
        }

        $contacts = $query->get();
        return view('contacts.index', compact('contacts', 'search', 'sort','categories'));

//        return view('contacts.index')
//            ->with('contacts', $contacts)
//            ->with('search', $search)
//            ->with('sort', $sort)
//            ->with('categories', $categories);
    }

    // Tampilkan form untuk menambah kontak baru
    public function create()
    {
        $categories = Category::all();
        return view('contacts.create', compact('categories'));
    }

    // Simpan kontak baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        Contact::create($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact added successfully.');
    }

    // Tampilkan form untuk mengedit kontak
    public function edit(Contact $contact)
    {
        $categories = Category::all();
        return view('contacts.edit', compact('contact', 'categories'));
    }

    // Update kontak
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        $contact->update($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    // Hapus kontak
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
