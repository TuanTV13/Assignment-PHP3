@extends('admins.layouts.master')

@section('title')
    Table
@endsection

@section('content')
    @include('admins.components.breadcump', ['name' => 'Table'])

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Danh sách tin tức</h4>
                </div>

                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-7">
                                <div>
                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#showModal"><a href="{{ route('news.create') }}">
                                            <i class="ri-add-line align-bottom me-1"></i> Add</button>
                                    </a>
                                    <a href="">
                                        <button class="btn btn-soft-danger"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><i
                                                class="ri-delete-bin-2-line"></i></button>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <form action="{{ route('admin.news.filter') }}" method="GET">
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="ms-2">
                                                <select name="category_id" class="form-control">
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="search-box ms-2">
                                                <input value="{{ request('search') }}" type="text" name="search"
                                                    class="form-control search" placeholder="Search...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                            <div class="ms-2">
                                                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle" id="customerTable">
                                <thead class="table-secondary">
                                    <tr>

                                        <th data-sort="id">ID</th>
                                        <th data-sort="title">Title</th>
                                        <th data-sort="image">Image</th>
                                        <th data-sort="views">Views</th>
                                        <th data-sort="category">Category</th>
                                        <th data-sort="auth">Author</th>
                                        <th data-sort="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($news as $new)
                                        <tr>

                                            <td class="id">{{ $new->id }}</td>
                                            <td class="title">{{ $new->title }}</td>
                                            <td>
                                                <img height="100px" width="100px" src="{{ \Storage::url($new->image) }}" alt="Loading...">
                                            </td>
                                            <td class="views">{{ $new->views }}</td>
                                            @if ($new->category)
                                                <td class="category">{{ $new->category->name }}</td>
                                            @else
                                                <td class="category">{{ $new->category_name }}</td>
                                            @endif
                                            <td class="title">{{ $new->user->name }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('news.edit', $new) }}"
                                                        class="btn btn-warning">Edit</a>
                                                    <a href="{{ route('news.show', $new) }}"
                                                        class="btn btn-success">Detail</a>
                                                    <form action="{{ route('news.destroy', $new) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" onclick="return confirm('Are you sure!')"
                                                            class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#121331,secondary:#08a88a"
                                        style="width:75px;height:75px"></lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                        orders for you search.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Pagination -->
                        {{ $news->links() }}

                    </div>
                </div>
            </div>
        </div>
        
    @endsection
