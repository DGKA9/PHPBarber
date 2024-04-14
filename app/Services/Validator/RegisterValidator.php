<?php

namespace App\Services\Validator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterValidator
{
    public function __construct()
    {

    }

    public function RegisterValidator(array $request)
    {

        $validator = Validator::make($request, [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
//            'password' => 'required|min:8',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            ],
            'roleID' => 'required'
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        return $request;
    }
}
