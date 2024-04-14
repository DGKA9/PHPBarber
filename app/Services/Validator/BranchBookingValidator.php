<?php

namespace App\Services\Validator;

use Illuminate\Support\Facades\Validator;

class BranchBookingValidator
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'branchID' => 'required|exists:branches,branchID',
            'bookingID' => 'required|exists:bookings,bookingID',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        return $validator->validated();
    }
}
