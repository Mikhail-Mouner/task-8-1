<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    public function getEmployees(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::with('company')->latest()->get();

            return DataTables::of( $data )
                ->addIndexColumn()
                ->editColumn( 'image', '<img width="50px" height="50px" src="{{$img_url}}" />' )
                ->addColumn( 'action', function ($row) {
                    $actionBtn = '<a href="' . route( 'employees.edit',
                            $row->id ) . '" class="edit btn btn-success btn-sm">Edit</a>';
                    $actionBtn .= '<a href="#" data-action="' . route( 'employees.destroy',
                            $row->id ) . '" class="delete btn btn-danger btn-sm">Delete</a>';

                    return $actionBtn;
                } )
                ->editColumn( 'company', function ($row) {
                    $actionBtn = '<img width="50px" height="50px" src="'.$row->company->img_url.'" />';
                    $actionBtn .= '<br />';
                    $actionBtn .= 'Company: '.$row->company->name;

                    return $actionBtn;
                } )
                ->rawColumns( [ 'image', 'action','company' ] )
                ->make( TRUE );
        }
    }

}
