<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index()
    {
        return view( 'pages.employee.index' );
    }

    public function create()
    {
        $companies = Company::all();

        return view( 'pages.employee.create', compact( 'companies' ) );
    }

    public function store(EmployeeRequest $request)
    {
        if ($request->has( 'image' )) {
            $img = $request->file( 'image' );
            $file_name = $this->imageStore( $img, $request->name );
        } else {
            $file_name = 'no-image.png';
        }

        Employee::create( [
            'name' => $request->name,
            'email' => $request->email,
            'company_id' => $request->company_id,
            'password' => Hash::make($request->password),
            'image' => $file_name,
        ] );

        session()->flash( 'mssg', [ 'status' => 'success', 'data' => 'Insert Data Successfully' ] );

        return redirect()->route( 'employees.index' );
    }

    public function show(Employee $employee)
    {
        //
    }

    public function edit(Employee $employee)
    {
        $companies = Company::all();

        return view( 'pages.employee.edit', compact( [ 'employee', 'companies' ] ) );
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        if ($request->has( 'image' )) {
            $img = $request->file( 'image' );
            $this->removeImage( $employee->image );
            $file_name = $this->imageStore( $img, $request->name );
        } else {
            $file_name = $employee->image;
        }

        $employee->update( [
            'name' => $request->name,
            'email' => $request->email,
            'company_id' => $request->company_id,
            'image' => $file_name,
        ] );

        session()->flash( 'mssg', [ 'status' => 'success', 'data' => 'Updated Data Successfully' ] );

        return redirect()->route( 'employees.index' );
    }

    public function destroy(Employee $employee)
    {
        $this->removeImage( $employee->image );
        $employee->delete();

        return redirect()->route( 'employees.index' );
    }

    public function imageStore($img_data, $name)
    {
        $file_name = Str::slug( $name ) . '.' . $img_data->getClientOriginalExtension();
        $path = Storage::disk( 'public' )->putFileAs( 'employee', $img_data, $file_name );

        return $path;
    }

    public function removeImage($logo)
    {
        if ($logo != 'no-image.png') {
            Storage::disk( 'public' )->delete( $logo );
        }

        return TRUE;
    }

}
