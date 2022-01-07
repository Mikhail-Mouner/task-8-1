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
            $data = Company::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('logo', '<img src="{{$logo}}" />')
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['logo','action'])
                ->make(true);
        }
    }
}
