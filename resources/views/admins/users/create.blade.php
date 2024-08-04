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
                    <h4 class="card-title mb-0">Thêm người dùng mới</h4>
                </div><!-- end card header -->

                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="users[name]" value="{{old('users.name')}}">
                                        @error('users.name')
                                           <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><!-- end col -->

                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="users[email]" value="{{old('users.email')}}">
                                        @error('users.email')
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
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="users[phone]" value="{{old('users.phone')}}">
                                    </div>
                                </div><!-- end col -->
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="text" class="form-control" id="password" name="users[password]" value="{{old('users.password')}}">
                                        @error('users.password')
                                           <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Role</label>
                            <select name="users[type]" class="form-control">
                                <option value="">Có thể để trống</option>
                                <option value="{{ \App\Models\User::TYPE_AUTH }}">Author</option>
                                <option value="{{ \App\Models\User::TYPE_MEMBER }}">Member</option>
                            </select>
                    
                            @error('type')
                                <span class="invalid-feedback" type="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </form><!-- end form -->
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection
