<?php

namespace App\Services\Validator;

use Illuminate\Support\Facades\Validator;

class ServiceEmployeeValidator
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'employeeID' => 'required|exists:employees,employeeID',
            'serviceID' => 'required|exists:services,serviceID',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        return $validator->validated();
    }
}
