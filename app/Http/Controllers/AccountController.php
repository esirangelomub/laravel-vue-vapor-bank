<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Models\Account;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $account = Account::all();

        return response()->json([
            'status' => true,
            'data' => $account
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAccountRequest $request
     * @return JsonResponse
     */
    public function store(StoreAccountRequest $request): JsonResponse
    {
        $account = Account::query()->create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Account Created successfully!",
            'data' => $account
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
        $account = Account::query()->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $account
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreAccountRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(StoreAccountRequest $request, int $id): JsonResponse
    {
        $account = Account::query()->findOrFail($id);

        $account->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Account Updated successfully!",
            'data' => $account
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Account $account
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $account = Account::query()->findOrFail($id);

        $account->delete();

        return response()->json([
            'status' => true,
            'message' => "Account Deleted successfully!"
        ]);
    }
}
