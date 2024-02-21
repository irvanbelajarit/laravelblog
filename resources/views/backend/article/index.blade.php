@extends('backend.layouts.templatedashboard')

@section('title', 'Article')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">


        </div>


        <h2>Artikel</h2>
        {{-- create --}}
        {{-- <a href="{{ route('category.create') }}" class="btn btn-sm btn-outline-secondary">Create</a> --}}
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('article.create') }}">Create</a>
        {{-- display validate --}}
        @if (session('success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong> {{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="swal" data-swal="{{ session('success') }}"></div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif
        <div class="table-responsive small">
            <table class="table table-striped table-sm" id="DataTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">User</th>
                        <th scope="col">Views</th>
                        <th scope="col">Status</th>

                        <th scope="col">Create at</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>



                </tbody>
            </table>
        </div>
    </main>


@endsection

@push('js')
    {{-- js datatable --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>
    {{-- sweet alert --}}
    <script>
        const swal = $('.swal').data('swal');
        if (swal) {
            Swal.fire({
                title: 'Success',
                text: swal,
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#DataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url()->current() }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'category_id',
                        name: 'category_id',

                    },
                    {
                        data: 'user_id',
                        name: 'user_id',
                    },
                    {
                        data: 'view_count',
                        name: 'view_count',
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'published_date',
                        name: 'published_date',
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }


                ]
            });
        });
    </script>

    <script>
        function deleteData(e) {
            let id = e;
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        // csrf
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "DELETE",
                        url: "{{ url('/article') }}" + "/" + id,
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            location.reload();
                        }
                    });

                }
            })

        }
    </script>
@endpush
