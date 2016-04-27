<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function topics($categoryId)
    {
        $page = request()->input('page');

        \Illuminate\Pagination\Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        $topics = Category::findOrFail($categoryId)
            ->topics()
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        if ($topics->isEmpty()) {
            return response('The provided page exceeds the available number of pages', 404);
        }

        return $topics;

    }
}
