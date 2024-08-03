<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\News;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = News::with('category')->orderByDesc('id')->get();

        return response()->json([
            'message' => 'Danh sách tin tức',
            'data' => $data
        ]);
    }

    public function NewByCategory($id)
    {

        // dd($id);
        try {

            $data = News::with('category')
                ->where('category_id', $id)
                ->get();

            $categoryName = $data->first()->category->name;

            return response()->json([
                'message' => 'Danh sách tin tức trong danh mục: ' . $categoryName,
                'data' => $data
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Danh mục có id = ' . $id . ' không tồn tại',
                'error' => $exception->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $new = News::query()->create($request->all());

            return response()->json([
                'message' => 'Thêm mới thành công',
                'data' => $new
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Thao tác thất bại',
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = News::query()->findOrFail($id);

            return response()->json([
                'message' => 'Chi tiết tin #' . $id,
                'data' => $data
            ]);
        } catch (Exception $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return response()->json([
                    'message' => 'Tin có id = ' . $id . ' không tồn tại',
                ], 404);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = News::query()->findOrFail($id);

            $data->update($request->all());

            return response()->json([
                'message' => 'Thao tác thành công',
                'data' => $data
            ]);
        } catch (Exception $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return response()->json([
                    'message' => 'Lỗi',
                    'error' => $exception->getMessage(),
                ], 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            News::destroy($id);

            return response()->json([
                'message' => 'Xóa thành công',
                'data' => ''
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Tin có id = ' . $id . ' không tồn tại',
            ], 404);
        }
    }
}
