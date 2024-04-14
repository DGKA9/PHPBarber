<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceEmployee;
use App\Services\Validator\ServiceEmployeeValidator;
use Illuminate\Http\Request;

class ServiceEmployeeController extends Controller
{
    protected $serviceEmployeeValidator;

    public function __construct(ServiceEmployeeValidator $serviceEmployeeValidator)
    {
        $this->serviceEmployeeValidator = $serviceEmployeeValidator;
    }

    public function getById($id)
    {
        $ServiceEmployee = ServiceEmployee::find($id);
        return $ServiceEmployee ? response()->json($ServiceEmployee, 200) : response()->json(['message' => 'Không tìm thấy dịch vụ đặt hàng'], 404);
    }

    public function getAll()
    {
        try {
            $ServiceEmployees = ServiceEmployee::all();
            return response()->json($ServiceEmployees, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function create(Request $request)
    {
        try {
            $validatedData = $this->serviceEmployeeValidator->validate($request->all());

            $ServiceEmployee = ServiceEmployee::create($validatedData);

            return response()->json($ServiceEmployee, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $ServiceEmployee = ServiceEmployee::find($id);
        if (!$ServiceEmployee) {
            return response()->json(['message' => 'Không tìm thấy Nhân viên thuộc dịch vụ'], 404);
        }

        try {
            $validatedData = $this->serviceEmployeeValidator->validate($request->all());

            $ServiceEmployee->update($validatedData);

            return response()->json($ServiceEmployee, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $ServiceEmployee = ServiceEmployee::find($id);
        if (!$ServiceEmployee) {
            return response()->json(['message' => 'Không tìm thấy Nhân viên thuộc dịch vụ'], 404);
        }

        $ServiceEmployee->delete();

        return response()->json(['message' => 'Nhân viên thuộc dịch vụ đã được xóa'], 200);
    }
}
