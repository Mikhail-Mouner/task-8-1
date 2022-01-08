<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name' => 'required|string|unique:App\Models\Company,name|min:3|max:191',
                    'address' => 'required|string|min:3|max:191',
                    'logo' => 'nullable|mimes:jpg,jpeg,png,gif|max:20000',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|string|unique:App\Models\Company,name,' . $this->route()->company->id . '|min:3|max:191',
                    'address' => 'required|string|min:3|max:191',
                    'logo' => 'nullable|mimes:jpg,jpeg,png,gif|max:20000',
                ];
            }
            default:
                break;
        }
    }

}
