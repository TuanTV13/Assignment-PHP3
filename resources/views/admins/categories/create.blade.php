@extends('admins.layouts.master')

@section('name')
    Thêm danh mục
@endsection

@section('content')
    @include('admins.components.breadcump', ['name' => 'Create'])

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-name mb-0">Thêm danh mục mới</h4>
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
                    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="mb-12">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="category[name]" value="{{old('category.name')}}">
                                        @error('category.name')
                                           <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
   
@endsection
