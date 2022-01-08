<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index()
    {
        return view( 'pages.company.index' );
    }

    public function create()
    {
        return view( 'pages.company.create' );
    }

    public function store(CompanyRequest $request)
    {
        if ($request->has( 'logo' )) {
            $img = $request->file( 'logo' );
            $file_name = $this->imageStore( $img, $request->name );
        } else {
            $file_name = 'no-image.png';
        }

        Company::create( [
            'name' => $request->name,
            'address' => $request->address,
            'logo' => $file_name,
        ] );

        session()->flash( 'mssg', [ 'status' => 'success', 'data' => 'Insert Data Successfully' ] );

        return redirect()->route( 'companies.index' );
    }

    public function show(Company $company)
    {
        //
    }

    public function edit(Company $company)
    {
        return view( 'pages.company.edit',compact('company') );
    }

    public function update(CompanyRequest $request, Company $company)
    {
        if ($request->has( 'logo' )) {
            $img = $request->file( 'logo' );
            $this->removeImage( $company->logo );
            $file_name = $this->imageStore( $img, $request->name );
        } else {
            $file_name = $company->logo;
        }

        $company->update( [
            'name' => $request->name,
            'address' => $request->address,
            'logo' => $file_name,
        ] );

        session()->flash( 'mssg', [ 'status' => 'success', 'data' => 'Updated Data Successfully' ] );
        return redirect()->route( 'companies.index' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Company  $company
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {

        $this->removeImage( $company->logo );
        $company->delete();

        return redirect()->route( 'companies.index' );
    }

    public function imageStore($img_data, $name)
    {
        $file_name = Str::slug( $name ) . '.' . $img_data->getClientOriginalExtension();
        $path = Storage::disk( 'public' )->putFileAs( 'company', $img_data, $file_name );

        return $path;
    }

    public function removeImage($logo)
    {
        if ($logo != 'no-image.png') {
            Storage::disk('public')->delete($logo);
        }

        return TRUE;
    }

}
