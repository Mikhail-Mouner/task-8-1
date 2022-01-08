@extends('layout.app')
@section('title', '| Edit Company ('.$company->name.')')
@section('css')
@endsection

@section('app')
    <div class="card">
        <h5 class="card-header d-flex justify-content-between align-items-center">
            Edit Company ({{ $company->name }})
        </h5>
        <div class="card-body">
            <form action="{{ route('companies.update',$company->id) }}" method="post" autocomplete="off"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                   value="{{ old('name',$company->name) }}">
                            @error('name') <small class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address"
                                   value="{{ old('address',$company->address) }}">
                            @error('address') <small class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" class="form-control-file" name="logo" id="logo">
                            @error('logo') <small class="form-text text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <img style="max-height: 350px" src="{{$company->img_url}}" class="img-fluid rounded-top" alt="">
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