<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class GroupPostRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'bail|required|max:255',
            'description' => 'required',
            '_netID.*' => 'required|unique:users,netid',
            '_firstName.*' => 'required',
            '_lastName.*' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            '_netID.*.required' => "Owner's netID is required",
            '_firstName.*.required' => "Owner's first name is required",
            '_lastName.*.required' => "Owner's last name is required",
        ];
    }
}
