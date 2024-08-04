<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\Category;
use App\Models\News;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
{
    // Lấy danh mục
    $categories = Category::query()->get();

    // Lấy người dùng hiện tại
    $user = auth()->user();

    // Lọc bài viết theo vai trò của người dùng
    if ($user->type == 'admin') {
        // Admin có thể xem tất cả các bài viết
        $news = News::with('category', 'user')->paginate(10);
    } else {
        // Người dùng khác chỉ có thể xem bài viết của họ
        $news = News::with('category', 'user')->where('user_id', $user->id)->paginate(10);
    }

    return view('admins.news.index', compact('news', 'categories'));
}


    public function filter(Request $request, News $news)
    {

        $query = News::with('category')
            ->join('categories', 'categories.id', '=', 'news.category_id')
            ->select('news.id', 'news.title', 'news.views', 'news.image', 'news.description', 'categories.name as category_name');

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('categories.id', $request->category_id);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('news.title', 'like', '%' . $request->search . '%');
        }

        // $query = News::with('category');
        
        $news = $query->paginate(10);

        $categories = DB::table('categories')->get();

        return view('admins.news.index', compact('news', 'categories'));
        // return redirect()->route('news.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->get();

        return view('admins.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        $images = [];

        try {

            DB::transaction(function () use ($request, &$images) {

                $news = $request->news;
                if ($request->hasFile("news.image")) {
                    $images[] = $news['image'] = Storage::put('news', $request->file("news.image"));
                }

                $news['category_id'] = $request->categories['id'];

                News::create($news);
            }, 3);

            return redirect()
                ->route('news.index')
                ->with('success', 'Thao tác thành công');
        } catch (Exception $exception) {

            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('admins.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $news->load(['category']);
        $categories = Category::query()->get();

        return view('admins.news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        try {
            DB::transaction(function () use ($request, $news) {

                $data = $request->input('news');
                $category_id = $request->input('categories.id');

                $news->update([
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'category_id' => $category_id
                ]);
            }, 3);
            return back()->with('success', 'Thao tác thành công');
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        try {
            DB::transaction(function () use ($news) {
                $news->delete();
            }, 3);
            return back()->with('success', 'Thao tác thành công!');
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
