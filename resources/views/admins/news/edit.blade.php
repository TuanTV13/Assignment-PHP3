@extends('admins.layouts.master')

@section('title')
    {{ $news->title }}
@endsection

@section('content')
    @include('admins.components.breadcump', ['name' => 'Update'])

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Cập nhật chi tiết tin tức: {{ $news->title }}</h4>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    <form action="{{ route('news.update', $news) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-xl-8 mb-3">
                                <label for="title" class="form-label">Tiêu đề</label>
                                <input type="text" class="form-control" id="title" name="news[title]"
                                    value="{{ old('news.title', $news->title) }}">
                                @error('news.title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="col-xl-4 mb-3">

                                <label for="category_id" class="form-label">Danh mục</label>
                                <select name="categories[id]" id="category_id" class="form-control">
                                    <option value="">Chọn danh mục</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $news->category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('categories.id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>

                        <div class="row">

                            <div class="col-xl-8 mb-3">
                                <label for="description" class="form-label">Mô tả</label>
                                <textarea class="form-control" id="description" name="news[description]" rows="13">{{ old('news.description', $news->description) }}</textarea>
                            </div>

                            <div class="col-xl-4 mb-3">
                                <label for="image" class="form-label">Ảnh đại diện</label>
                                <input type="file" class="form-control" id="image" name="news[image]">
                                <img width="300px" src="{{ \Storage::url($news->image) }}" alt="No img" class="mt-3">
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
