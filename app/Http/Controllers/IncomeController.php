<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIncomeRequest;
use App\Models\Income;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $Income = Income::all();

        return response()->json([
            'status' => true,
            'data' => $Income
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreIncomeRequest $request
     * @return JsonResponse
     */
    public function store(StoreIncomeRequest $request): JsonResponse
    {
        $Income = Income::query()->create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Income Created successfully!",
            'data' => $Income
        ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $Income = Income::query()->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $Income
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreIncomeRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(StoreIncomeRequest $request, int $id): JsonResponse
    {
        $income = Income::query()->findOrFail($id);

        $income->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Income Updated successfully!",
            'data' => $income
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
        $Income = Income::query()->findOrFail($id);

        $Income->delete();

        return response()->json([
            'status' => true,
            'message' => "Income Deleted successfully!"
        ]);
    }
}
