@extends('layout.app')
@section('title', '| Employees')
@section('css')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('app')
    <div class="card">
        <h5 class="card-header d-flex justify-content-between align-items-center">
            Employees
            <a href="{{ route('employees.create') }}">
                <button type="button" class="btn btn-sm btn-primary">
                    Add New
                </button>
            </a>
        </h5>
        <div class="card-body">
            @include('includes._alert')
            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="company"><strong>Company :</strong></label>
                        <select id='company' class="form-control">
                            <option value="0" selected>select Company</option>
                            @foreach($companies as $item)
                                <option value="{{ $item->id }}" >{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <table class="table table-bordered yajra-datatable">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Company</th>
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
                ajax: {
                    url: "{{ route('employees.list') }}",
                    data: function (d) {
                        d.company_id = $('#company').val()
                    }
                },
                initComplete: function () {
                    deleteItem()
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',},
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'company', name: 'company'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });


            $('#company').change(function(){
                table.draw();
            });

        });
    </script>
@endpush