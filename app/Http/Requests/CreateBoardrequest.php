<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateBoardrequest extends Request
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
            'boardname'=>'required|unique:boards|max:50|min:2,boardname',
            'pincode'=>'required|unique:boards|max:20|min:3,pincode'

        ];
    }
}
