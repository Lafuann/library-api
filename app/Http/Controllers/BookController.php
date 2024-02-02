<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $category_id = null)
    {
        // Ambil semua parameter dari URL
        $title = $request->input('title');
        $minYear = $request->input('minYear');
        $maxYear = $request->input('maxYear');
        $minPage = $request->input('minPage');
        $maxPage = $request->input('maxPage');
        $sortByTitle = $request->input('sortByTitle');

        // Mulai query dari model Book
        $query = Book::query();

        // Terapkan filter sesuai dengan parameter yang ada
        if ($title) {
            $query->where('title', 'like', '%' . $title . '%');
        }

        if ($minYear) {
            $query->where('release_year', '>=', $minYear);
        }

        if ($maxYear) {
            $query->where('release_year', '<=', $maxYear);
        }

        if ($minPage) {
            $query->where('total_page', '>=', $minPage);
        }

        if ($maxPage) {
            $query->where('total_page', '<=', $maxPage);
        }

        if ($sortByTitle) {
            $query->orderBy('title', $sortByTitle);
        }

        if ($category_id) {
            $query->where('category_id', $category_id);
        }

        // Eksekusi query dan ambil hasil
        $books = $query->get();

        return response()->json(['data' => $books]);
    }

    /**
     * Store a newly created resource in storage.
     * thickness diinput berdasarkan total_page
     * Jika total_page kurang dari sama dengan 100 maka thickness-nya "tipis"
     * Jika total_page diantara 101 dan 200 maka thickness-nya "sedang"
     * Jika total_page lebih dari atau sama dengan 201 maka thickness "tebal"
     */
    public function store(BookRequest $request)
    {
        $request = $request->validated();
        if ($request['total_page'] <= 100) {
            $thickness = 'tipis';
        } else if ($request['total_page'] >= 101 &&  $request['total_page'] <= 200) {
            $thickness = 'sedang';
        } else {
            $thickness = 'tebal';
        }
        $request['thickness'] = $thickness;
        $book = Book::create($request);
        return response()->json(['message' => "Book created successfull!", "data" => $book]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return response()->json([
            'data' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book)
    {
        $request = $request->validated();
        if ($request['total_page'] <= 100) {
            $thickness = 'tipis';
        } else if ($request['total_page'] >= 101 &&  $request['total_page'] <= 200) {
            $thickness = 'sedang';
        } else {
            $thickness = 'tebal';
        }
        $request['thickness'] = $thickness;
        $data = $book->update($request);
        return response()->json(['message' => "Book Updated successfull!", "data" => $request]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(['message' => 'The book has been deleted']);
    }
}
