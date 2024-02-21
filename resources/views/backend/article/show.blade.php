@extends('backend.layouts.templatedashboard')

@section('title', 'Detail Article')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2>Detail Artikel</h2>

        </div>




        <div class="table-responsive small">
            <table class="table table-striped table-sm" id="DataTable">
                <tr>
                    <th>Title</th>
                    <td>{{ $article->title }}</td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td>{{ $article->category->name }}</td>
                </tr>
                <tr>
                    <th>Content</th>
                    <td>{!! $article->body !!}</td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td><img src="{{ asset('images/' . $article->image) }}" alt="" width="200"></td>
                </tr>
                <tr>
                    <th>views</th>
                    <td>{{ $article->view_count }}</td>
                </tr>
                <tr>
                    <th>status</th>
                    @if ($article->status == 1)
                        <td><span class="badge bg-success">Published</span> </td>
                    @else
                        <td><span class="badge bg-danger">Draft</span> </td>
                    @endif
                </tr>
                <tr>
                    <th>Published Date</th>
                    <td>{{ $article->published_date }}</td>
                </tr>
            </table>
            <div class="float-end">
                <a href="{{ url('article') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </main>


@endsection
