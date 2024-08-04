@extends('admins.layouts.master')

@section('title')
    Create
@endsection

@section('content')
    @include('admins.components.breadcump', ['name' => 'Create'])

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Thêm tin tức mới</h4>
                </div><!-- end card header -->

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
                    <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="news[title]" value="{{old('news.title')}}">
                                        @error('news.title')
                                           <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><!-- end col -->

                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select name="categories[id]" id="category_id" class="form-control">
                                            <option value="">Chọn danh mục</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('categories.id')
                                           <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div>
                        <div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" class="form-control" id="image" name="news[image]" value="{{old('news.image')}}">
                                    </div>
                                </div><!-- end col -->
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label for="views" class="form-label">Views</label>
                                        <input type="number" class="form-control" id="views" name="news[views]" value="{{old('news.views')}}">
                                        @error('news.views')
                                           <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="news[description]" rows="5">{{old('news.description')}}</textarea>
                        </div>
                        <input type="hidden" name="news[user_id]" value="{{ Auth::user()->id }}">

                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </form><!-- end form -->
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection
