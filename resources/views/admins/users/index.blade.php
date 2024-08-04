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
                    <h4 class="card-title mb-0">Danh sách người dùng</h4>
                </div>

                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-7">
                                <div>
                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#showModal"><a href="{{ route('users.create') }}">
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

                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle" id="customerTable">
                                <thead class="table-secondary">
                                    <tr>

                                        <th data-sort="id">ID</th>
                                        <th data-sort="title">Name</th>
                                        <th data-sort="image">Email</th>
                                        <th data-sort="views">Phone</th>
                                        <th data-sort="category">Role</th>
                                        <th data-sort="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($users as $user)
                                        <tr>

                                            <td class="id">{{ $user->id }}</td>
                                            <td class="name">{{ $user->name }}</td>
                                            <td class="email">{{ $user->email }}</td>
                                            <td class="phone">{{ $user->phone }}</td>
                                            <td class="type">{{ $user->type }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('users.edit', $user) }}"
                                                        class="btn btn-warning">Edit</a>
                                                    <a href="{{ route('users.show', $user) }}"
                                                        class="btn btn-success">Detail</a>
                                                    <form action="{{ route('users.destroy', $user) }}" method="POST">
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
                        {{ $users->links() }}

                    </div>
                </div>
            </div>
        </div>
    @endsection
