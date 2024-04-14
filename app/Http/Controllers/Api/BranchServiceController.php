<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BranchService;
use App\Services\Validator\BranchServiceValidator;
use Illuminate\Http\Request;

class BranchServiceController extends Controller
{
    protected $branchServiceValidator;

    public function __construct(BranchServiceValidator $branchServiceValidator)
    {
        $this->branchServiceValidator = $branchServiceValidator;
    }

    public function getById($id)
    {
        $BranchService = BranchService::find($id);
        return $BranchService ? response()->json($BranchService, 200) : response()->json(['message' => 'Không tìm thấy dịch vụ đặt hàng'], 404);
    }

    public function getAll()
    {
        try {
            $BranchServices = BranchService::all();
            return response()->json($BranchServices, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function create(Request $request)
    {
        try {
            $validatedData = $this->branchServiceValidator->validate($request->all());

            $BranchService = BranchService::create($validatedData);

            return response()->json($BranchService, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $BranchService = BranchService::find($id);
        if (!$BranchService) {
            return response()->json(['message' => 'Không tìm thấy Dịch vụ chi nhánh'], 404);
        }

        try {
            $validatedData = $this->branchServiceValidator->validate($request->all());

            $BranchService->update($validatedData);

            return response()->json($BranchService, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $BranchService = BranchService::find($id);
        if (!$BranchService) {
            return response()->json(['message' => 'Không tìm thấy Dịch vụ chi nhánh'], 404);
        }

        $BranchService->delete();

        return response()->json(['message' => 'Dịch vụ chi nhánh đã được xóa'], 200);
    }
}
