<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Models\Expense;
use Illuminate\Http\JsonResponse;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $Income = Expense::all();

        return response()->json([
            'status' => true,
            'data' => $Income
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreExpenseRequest $request
     * @return JsonResponse
     */
    public function store(StoreExpenseRequest $request): JsonResponse
    {
        $Income = Expense::query()->create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Income Created successfully!",
            'data' => $Income
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $Income = Expense::query()->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $Income
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreExpenseRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(StoreExpenseRequest $request, int $id): JsonResponse
    {
        $Income = Expense::query()->findOrFail($id);

        $Income->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Income Updated successfully!",
            'data' => $Income
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $Income = Expense::query()->findOrFail($id);

        $Income->delete();

        return response()->json([
            'status' => true,
            'message' => "Income Deleted successfully!"
        ]);
    }
}
