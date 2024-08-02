@extends('admins.layouts.master')

@section('title')
    {{ $news->title }}
@endsection

@section('content')
    @include('admins.components.breadcump', ['name' => 'Detail'])

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Chi tiết: {{ $news->title }}</h4>
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
                                        {{ $news->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tiêu đề
                                    </td>
                                    <td>
                                        {{ $news->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Lượt xem
                                    </td>
                                    <td>
                                        {{ $news->views }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Danh mục
                                    </td>
                                    <td>
                                        {{ $news->category->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Ảnh đại diện
                                    </td>
                                    <td>
                                        <img width="200px" src="{{ \Storage::url($news->image) }}" alt="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Mô tả
                                    </td>
                                    <td class="">
                                        {{ $news->description }}
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
