<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $categories = Category::all();

        $NewsTrend = News::query()
            ->orderByDesc('views')
            ->limit(1)
            ->first();

        $NewsRandom = News::query()
            ->inRandomOrder()
            ->limit(4)
            ->get();

        $NewsLatest = News::query()
            ->orderByDesc('id')
            ->limit(3)
            ->get();

        return view('welcome', compact('NewsTrend', 'NewsRandom', 'NewsLatest', 'categories'));
    }

    public function newsByCategoies($id, News $news)
    {
        $categories = Category::all();

        $news = News::query()
            ->where('category_id', $id)
            ->paginate(5);

        $category = Category::query()->find($id)->name;

        return view('clients.news-by-categories', compact('categories', 'news', 'category'));
    }

    public function details($id, News $news)
    {
        $categories = Category::all();

        $news = News::query()
            ->where('id', $id)
            ->first();
        
        $news->increment('views');

        return view('clients.details', compact('categories', 'news'));
    }

    public function filter(Request $request)
    {

        $categories = Category::query()->get();

        $query = News::query()
            ->join('categories', 'categories.id', '=', 'news.category_id')
            ->select('news.id', 'news.title', 'news.views', 'news.image', 'news.description', 'news.created_at', 'categories.name as category_name');

        if ($request->has('search') && $request->search != '') {
            $query->where('news.title', 'like', '%' . $request->search . '%')
                ->orWhere('news.description', 'like', '%' . $request->search . '%');
        }

        $news = $query->paginate(5);

        return view('clients.search_results', compact('categories', 'news'));
    }
}
