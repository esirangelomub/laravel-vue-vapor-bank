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
        if (app()->make('isAdmin')) {
            $expenses = Expense::all();
        } else {
            $expenses = Expense::where(['accounts_id' => app()->make('getAccountId')])->get();
        }

        return response()->json([
            'status' => true,
            'data' => $expenses
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
        $expense = Expense::query()->create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Income Created successfully!",
            'data' => $expense
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
        if (app()->make('isAdmin')) {
            $expense = Expense::query()->findOrFail($id);
        } else {
            $expense = Expense::where([
                'accounts_id' => app()->make('getAccountId'),
                'id' => $id
            ])->first();
        }

        return response()->json([
            'status' => true,
            'data' => $expense
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
        $expense = Expense::query()->findOrFail($id);

        $expense->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Income Updated successfully!",
            'data' => $expense
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
        $expense = Expense::query()->findOrFail($id);

        $expense->delete();

        return response()->json([
            'status' => true,
            'message' => "Income Deleted successfully!"
        ]);
    }
}
