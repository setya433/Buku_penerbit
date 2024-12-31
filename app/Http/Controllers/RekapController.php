<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;

class RekapController extends Controller
{
    public function index()
        {
            //data rekap berdasarkan kategori
            $categories = Category::pluck('name');

            $counts = $this->getBookCountsByCategories($categories);


            // data rekap berdasarkan publisher
            $publisher = Publisher::pluck('name');

            $count_publisher = $this->getCountBookbyPublisher($publisher);


            return view('rekap.index', compact('counts','count_publisher'));
        }

        /**
         *
         *
         * @param array $categories
         * @return array
         */
        private function getBookCountsByCategories($categories)
        {
            $counts = [];

            foreach ($categories as $category) {
                $counts[$category] = Book::whereHas('category', function ($query) use ($category) {
                    $query->where('name', $category);
                })->count();
            }

            return $counts;
        }

    public function getCountBookbyPublisher($publisher){
        $counts =  [];

        foreach ($publisher as $publish) {
            $counts[$publish] = Book::whereHas('publisher', function ($query) use ($publish) {
                $query->where('name', $publish);
            })->count();
        }

        return $counts;

    }




}
