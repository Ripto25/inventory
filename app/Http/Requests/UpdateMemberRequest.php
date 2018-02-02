<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateMemberRequest extends StoreMemberRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
            $rules = parent::rules();
            $rules['email'] = 'required|unique:users,email,' . $this->route('member');
            return $rules;
        
    }
}
