<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{

    public function index(){

        $authorId = Auth::user()->author_id;
        $admin = Auth::user()->role === 'admin';

        if ($admin){
        $books = Book::with(['category', 'author', 'publisher'])->orderBy('id','desc')->paginate(10);

        //echo '<pre>';
            // var_dump($books);
            // echo '</pre>';

            // exit;

        }else{

            $books = Book::with(['category', 'author', 'publisher'])->where('author_id', $authorId)->orderBy('id','desc')->paginate(10);

            // echo '<pre>';
            // var_dump($books);
            // echo '</pre>';
            // exit;


        }

        $categories = Category::all();

        return view('dashboard.index',compact('books','categories'));


    }

    public function create(){

        $categories = Category::all();

        $author = Author::all();

        $publisher = Publisher::all();

        return view('dashboard.create',compact('categories','author','publisher'));
    }

    public function store(Request $request){
        $request->validate(
            [
                'title' => 'required|string|max:100',
                'publisher_id' => 'required|exists:publishers,id',
                'author_id' => 'required|exists:authors,id',
                'category_id' => 'required|exists:categories,id',
                'cover_image' => 'nullable|image|mimes:jpeg,jpg,png'
            ]
        );

        $data = $request->all();

        if ($request->hasFile('cover_image')){
            $data['cover_image'] = $request->file('cover_image')->store('cover','public');
        }

        Book::create($data);

        return redirect()->route('dashboard.index')->with('success','Book created successfully!');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        $authors = Author::all();
        $publishers = Publisher::all();

        return view('dashboard.edit', compact('book', 'categories', 'authors', 'publishers'));
    }


    public function update(Request $request,$id){
        $book = Book::findOrFail($id);

        $validate = $request->validate([
                'title' => 'required|string|max:100',
                'publisher_id' => 'required|exists:publishers,id',
                'author_id' => 'required|exists:authors,id',
                'category_id' => 'required|exists:categories,id',
                'cover_image' => 'nullable|image|mimes:jpeg,jpg,png'
        ]);

        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::delete('public/' . $book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('cover', 'public');
        }

        $book->update($data);

        return redirect()->route('dashboard.index')->with('success','Book Edited successfully!');

    }

    public function delete($id){
        $book = Book::findOrFail($id);

        if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return response()->json(['success' => 'Book deleted successfully']);

    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');

        $query = Book::with(['category', 'author', 'publisher']);

        // echo'<pre>';
        // dd($query);
        // echo'</pre>';

        // exit;



        if ($search && $categoryId) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhereHas('author', function($query) use ($search) {
                          $query->where('name', 'like', "%{$search}%");
                      })
                      ->orWhereHas('publisher', function($query) use ($search) {
                          $query->where('name', 'like', "%{$search}%");
                      });
            });
            $query->where('category_id', $categoryId);

        }else{

                $query->where('title', 'like', "%{$search}%");
                $query->orWhereHas('author', function($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                });
                $query->orWhereHas('publisher', function($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                });

        }


        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $books = $query->paginate(10);

        $categories = Category::all();

        return view('dashboard.index', compact('books', 'categories'));
    }

}
