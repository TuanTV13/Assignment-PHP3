@extends('admins.layouts.master')

@section('title')
    {{ $user->name }}
@endsection

@section('content')
    @include('admins.components.breadcump', ['name' => 'Detail'])

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Chi tiết: {{ $user->name }}</h4>
                </div><!-- end card header -->

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 30%;">
                                        Trường dữ liệu
                                    </th>
                                    <th scope="col">
                                        Giá trị
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>
                                        ID
                                    </td>
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tên
                                    </td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Email
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Số điện thoại
                                    </td>
                                    <td>
                                        {{ $user->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Mật khẩu
                                    </td>
                                    <td>
                                        {{ $user->password }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Quyền
                                    </td>
                                    <td class="">
                                        {{ $user->type }}
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                        <!-- end table -->
                    </div>
                    <!-- end table responsive -->
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
@endsection
