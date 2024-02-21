@extends('backend.layouts.templatedashboard')

@section('title', 'Update Article')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">


        </div>


        <h2>Update Artikel</h2>
        {{-- create --}}
        {{-- <a href="{{ route('category.create') }}" class="btn btn-sm btn-outline-secondary">Create</a> --}}


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif

        <form method="post" action="{{ route('article.update', $article->id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="hidden" name="oldImg" value="{{ $article->image }}">
            <div class="row">
                <div class="col-6">

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                            value="{{ old('title', $article->title) }}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        {{-- category --}}
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" aria-label="Default select example" name="category_id">
                            @foreach ($category as $cat)
                                <option value="{{ $cat->id }}" @if ($cat->id == $article->category_id) selected @endif>
                                    {{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>




            </div>
            <div class="row">
                <div class="col">

                    <div class="mb-3">
                        <label for="body" class="form-label">Body</label>
                        <textarea class="form-control" id="body" name="body" rows="3">{{ old('body', $article->body) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- image --}}

                <div class="col">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image (max 2 Mb)</label>
                        <input class="form-control" type="file" id="image" name="image">
                        <div class="mt-2">
                            <img src="{{ asset('images/' . $article->image) }}" width="200" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    {{-- status --}}
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" aria-label="Default select example" name="status">
                            <option value="1" ?{{ $article->status == 1 ? 'selected' : '' }}>Publish</option>
                            <option value="0" ?{{ $article->status == 0 ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                </div>
                {{-- publish_date --}}

                <div class="col-6">
                    <div class="mb-3">
                        <label for="publish_date" class="form-label">Publish Date</label>
                        <input type="date" class="form-control" id="publish_date" name="published_date"
                            value="{{ old('publish_date', $article->published_date) }}">
                    </div>
                </div>
            </div>

            <div class="float-end">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>




        </form>
    </main>


@endsection

@push('js')
    {{-- js datatable --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
@endpush
