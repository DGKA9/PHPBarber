<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BranchBooking;
use App\Services\Validator\BranchBookingValidator;
use Illuminate\Http\Request;

class BranchBookingController extends Controller
{
    protected $branchBookingValidator;

    public function __construct(BranchBookingValidator $branchBookingValidator)
    {
        $this->branchBookingValidator = $branchBookingValidator;
    }

    public function getById($id)
    {
        $branchBooking = BranchBooking::find($id);
        return $branchBooking ? response()->json($branchBooking, 200) : response()->json(['message' => 'Không tìm thấy dịch vụ đặt hàng'], 404);
    }

    public function getAll()
    {
        try {
            $branchBookings = BranchBooking::all();
            return response()->json($branchBookings, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function create(Request $request)
    {
        try {
            $validatedData = $this->branchBookingValidator->validate($request->all());

            $branchBooking = BranchBooking::create($validatedData);

            return response()->json($branchBooking, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $branchBooking = BranchBooking::find($id);
        if (!$branchBooking) {
            return response()->json(['message' => 'Không tìm thấy Booking chi nhánh'], 404);
        }

        try {
            $validatedData = $this->branchBookingValidator->validate($request->all());

            $branchBooking->update($validatedData);

            return response()->json($branchBooking, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $branchBooking = BranchBooking::find($id);
        if (!$branchBooking) {
            return response()->json(['message' => 'Không tìm thấy Booking chi nhánh'], 404);
        }

        $branchBooking->delete();

        return response()->json(['message' => 'Booking chi nhánh đã được xóa'], 200);
    }
}
