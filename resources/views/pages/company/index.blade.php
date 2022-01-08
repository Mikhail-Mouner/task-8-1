@extends('layout.app')
@section('title', '| Companies')
@section('css')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('app')
    <div class="card">
        <h5 class="card-header d-flex justify-content-between align-items-center">
            Companies
            <a href="{{ route('companies.create') }}">
                <button type="button" class="btn btn-sm btn-primary">
                    Add New
                </button>
            </a>
        </h5>
        <div class="card-body">
            @include('includes._alert')
            <table class="table table-bordered yajra-datatable">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Total Of Employee</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
@endpush
@method("DELETE")
@push('js')
    <script type="text/javascript">
        $(function () {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('companies.list') }}",
                initComplete: function () {
                    deleteItem()
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',},
                    {
                        data: 'logo',
                        name: 'logo',
                        orderable: false,
                        searchable: false
                    },
                    {data: 'name', name: 'name'},
                    {data: 'address', name: 'address'},
                    {data: 'employees_count', name: 'employees_count'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

        });
    </script>
@endpush