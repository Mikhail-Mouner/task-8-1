@extends('layout.app')
@section('app')
    <div class="card">
        <div class="card-header">Home</div>
        <div class="card-body">
            <nav class="nav nav-pills justify-content-center">
                <a class="nav-link btn-lg" href="{{ route('companies.index') }}">Companies</a>
                <a class="nav-link active btn-lg" href="{{ route('home') }}">Home</a>
                <a class="nav-link btn-lg" href="{{ route('employees.index') }}">Employees</a>
            </nav>
        </div>
    </div>

@endsection