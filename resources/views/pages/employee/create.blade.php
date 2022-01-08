@extends('layout.app')
@section('title', '| Add New Employee')
@section('css')
@endsection

@section('app')
    <div class="card">
        <h5 class="card-header d-flex justify-content-between align-items-center">
            Add New Employee
        </h5>
        <div class="card-body">
            <form action="{{ route('employees.store') }}" method="post" autocomplete="off"
                  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                            @error('name') <small class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                            @error('email') <small class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                   value="{{ old('password') }}">
                            @error('password') <small class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company">Company</label>
                            <select class="form-control" name="company_id" id="company">
                                @foreach($companies as $item)
                                    <option value="{{ $item->id }}" {{ old('email') == $item->id? 'selected' : NULL }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('company_id') <small class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" name="image" id="image">
                            @error('image') <small class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection