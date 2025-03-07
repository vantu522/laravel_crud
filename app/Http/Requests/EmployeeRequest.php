<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $employeeId = $this->route('employee'); // Lấy ID nhân viên đang cập nhật
    
        return [
            'name' =>'required|max:255',
            'email' => 'required|email|unique:employees,email,' . $employeeId,
            'phone_number' => 'required|max:10',
            'address' => 'required'
        ];
    }
    
}
