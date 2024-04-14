<?php

namespace App\Services\Validator;

use Illuminate\Support\Facades\Validator;

class BranchServiceValidator
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'branchID' => 'required|exists:branches,branchID',
            'serviceID' => 'required|exists:services,serviceID',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        return $validator->validated();
    }
}
