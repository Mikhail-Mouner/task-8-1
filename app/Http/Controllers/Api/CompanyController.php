<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    public function getCompanies(Request $request)
    {
        if ($request->ajax()) {
            $data = Company::withCount('employees')->latest()->get();

            return DataTables::of( $data )
                ->addIndexColumn()
                ->editColumn( 'logo', '<img width="50px" height="50px" src="{{$img_url}}" />' )
                ->addColumn( 'action', function ($row) {
                    $actionBtn = '<a href="'.route('companies.edit',$row->id).'" class="edit btn btn-success btn-sm">Edit</a>';
                    $actionBtn .= '<a href="#" data-action="'.route('companies.destroy',$row->id).'" class="delete btn btn-danger btn-sm">Delete</a>';

                    return $actionBtn;
                } )
                ->rawColumns( [ 'logo', 'action' ] )
                ->make( TRUE );
        }
    }

}
