<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
                    'name' => 'required|string|min:3|max:191',
                    'email' => 'required|email|unique:App\Models\Employee,email|min:3|max:191',
                    'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:20000',
                    'company_id' => 'required|exists:App\Models\Company,id',
                    'password' => 'required|string|min:6|max:191',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|string|min:3|max:191',
                    'email' => 'required|email|unique:App\Models\Employee,email,' . $this->route()->employee->id . '|min:3|max:191',
                    'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:20000',
                    'company_id' => 'required|exists:App\Models\Company,id',
                ];
            }
            default:
                break;
        }
    }

}
