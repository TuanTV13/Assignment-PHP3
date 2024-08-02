<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::query()->paginate(5);

        return view('admins.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                Category::create($request->category);
            }, 3);

            return redirect()
                ->route('categories.index')
                ->with('success', 'Thao tác thành công');
        } catch (Exception $exception) {

            return back()->with('error', $exception->getMessage());

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admins.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {    
        return view('admins.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            DB::transaction( function() use ($request, $category){

                $category->update($request->input('category'));

            }, 3);

            return back()->with('success', 'Thao tác thành công');

        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            DB::transaction(function () use ($category) {
                $category->delete();
            }, 3);
            return back()->with('success', 'Thao tác thành công!');
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
