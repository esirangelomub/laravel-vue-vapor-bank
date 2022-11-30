<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIncomeRequest;
use App\Models\Income;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function index(): JsonResponse
    {
        if (app()->make('isAdmin')) {
            $incomes = Income::all();
        } else {
            $incomes = Income::where(['accounts_id' => app()->make('getAccountId')])->get();
        }

        return response()->json([
            'status' => true,
            'data' => $incomes
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
     * @throws BindingResolutionException
     */
    public function show(int $id): JsonResponse
    {
        if (app()->make('isAdmin')) {
            $income = Income::query()->findOrFail($id);
        } else {
            $income = Income::where([
                'accounts_id' => app()->make('getAccountId'),
                'id' => $id
            ])->first();
        }

        return response()->json([
            'status' => true,
            'data' => $income
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
