@extends('clients.layouts.master')

@section('title')
    Home
@endsection

@section('breadcump')
    <div class="banner text-center">
        @include('clients.components.breadcump', [
            'page' => 'Hôm nay <br> Bạn thích đọc gì?',
            'breadcump' => ''
        ])
    </div>
@endsection

@section('content')
    <section class="section pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5">
                    <h2 class="h5 section-title">Tin nổi bật</h2>
                    <article class="card">
                        <div class="post-slider slider-sm">
                            {{-- <img style="height: 400px; width: 100%;" src="path/to/your/image.jpg" class="card-img-top" alt="post-thumb"> --}}
                            <img class="card-img-top" style="height: 400px; width: 100%;"
                                src="{{ \Storage::url($NewsTrend->image) }}" alt="Loading...">

                        </div>
                        <div class="card-body">
                            <h3 class="h4 mb-3"><a class="post-title" href="link/to/article">{{ $NewsTrend->title }}</a>
                            </h3>
                            <p>{{ Str::limit($NewsTrend->description, 400, ' ...') }}</p>
                            <a href="{{ route('details', $NewsTrend->id) }}" class="btn btn-outline-primary">Đọc thêm</a>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4">
                    <h2 class="h5 section-title">Bạn có thể quan tâm</h2>
                    @foreach ($NewsRandom as $new)
                        <article class="card mb-4">
                            <div class="card-body d-flex">
                                <img class="card-img-sm" src="{{ \Storage::url($new->image) }}" alt="Loading...">
                                <div class="ml-3">
                                    <h4><a href="{{ route('details', $new->id) }}" class="post-title">{{ $new->title }}</a></h4>
                                    <ul class="card-meta list-inline mb-0">
                                        <li class="list-inline-item mb-0">
                                            <i class="ti-time"></i>{{ $new->created_at }}
                                        </li>
                                        <li class="list-inline-item mb-0">
                                            <ul class="card-meta-tag list-inline">
                                                <li class="list-inline-item"><a href="{{ route('details', $new->id) }}">{{ $new->category_name }}</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section-sm">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <h2 class="h5 section-title">Bài đăng gần đây</h2>
                    <article class="card mb-4">
                        <div class="post-slider">
                            @foreach ($NewsLatest as $post)
                                <article class="card mb-4">
                                    <div class="post-slider">
                                        <img src="{{ \Storage::url($post->image) }}" style="height: 400px; width: 100%; class="card-img-top" alt="post-thumb">
                                    </div>
                                    <div class="card-body">
                                        <h3 class="h4 mb-3"><a class="post-title"
                                                href="{{ route('details', $post->id) }}">{{ $post->title }}</a></h3>
                                        <p>{{ Str::limit($post->description, 300, ' ...') }}</p>
                                        <a href="{{ route('details', $post->id) }}" class="btn btn-outline-primary">Đọc thêm</a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </article>

                </div>
            </div>
        </div>
    </section>
@endsection
