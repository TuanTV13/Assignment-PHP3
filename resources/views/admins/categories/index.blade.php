@extends('admins.layouts.master')

@section('title')
    Danh sách danh mục
@endsection

@section('content')
    @include('admins.components.breadcump', ['name' => 'Table'])

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Danh sách danh mục</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-7">
                                <div>
                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#showModal"><a href="{{ route('categories.create') }}">
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
                                <form action="" method="GET">
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" name="search" class="form-control search"
                                                    placeholder="Search...">
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
                                        <th data-sort="name">Tên danh mục</th>
                                        <th data-sort="created_at">Ngày tạo</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td class="id">{{ $category->id }}</td>
                                            <td class="name">{{ $category->name }}</td>
                                            <td class="created_at">{{ $category->created_at }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('categories.edit', $category->id) }}"
                                                        class="btn btn-warning">Edit</a>
                                                    <a href="{{ route('categories.show', $category->id) }}"
                                                        class="btn btn-success">Detail</a>
                                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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
                        {{ $categories->links() }}
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
        
    @endsection
