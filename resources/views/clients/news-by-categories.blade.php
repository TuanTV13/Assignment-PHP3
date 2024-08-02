@extends('clients.layouts.master')

@section('title')
    Home
@endsection

@section('breadcump')
    <div class="banner text-center">
        @include('clients.components.breadcump', [
            'page' => ' Tin tức ',
            'breadcump' => 'Home / ' .$category
        ])
    </div>
@endsection

@section('content')

<section class="section-sm">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12  mb-5 mb-lg-0">
                <h2 class="h5 section-title">Bài đăng gần đây</h2>
                @foreach ($news as $new)
                    <article class="card mb-4">
                        <div class="post-slider">
                            <img class="card-img-top" style="height: 500px; width: 100%;"
                                src="{{ \Storage::url($new->image) }}" alt="Loading...">
                        </div>
                        <div class="card-body">
                            <h3 class="mb-3"><a class="post-title"
                                    href="">{{ Str::limit($new->title, 100, ' ...') }}</a>
                            </h3>
                            <ul class="card-meta list-inline">
                                <li class="list-inline-item">
                                    <a href="author-single.html" class="card-meta-author">
                                        <img src="/clients/images/john-doe.jpg" alt="John Doe">
                                        <span>John Doe</span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <i class="ti-timer"></i>{{ $new->created_at }}
                                </li>
                                <li class="list-inline-item">
                                    <ul class="card-meta-tag list-inline">
                                        <li class="list-inline-item"><a href="">{{ $new->category->name }}</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <p>{{ Str::limit($new->description, 500, ' ...') }}</p>
                            <a href="{{ route('details', $new->id) }}" class="btn btn-outline-primary">Đọc
                                thêm</a>
                        </div>
                    </article>
                @endforeach
                {{ $news->links() }}
            </div>
        </div>
    </div>
    
</section>

@endsection
