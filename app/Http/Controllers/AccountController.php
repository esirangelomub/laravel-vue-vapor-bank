<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
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
        $token = null;
        if ($account) {
            $user = User::find($account->users_id);
            $scope = $request->scope ? [$request->scope] : ['customer-all'];
            $token = $user->createToken('bnb-bank-token', $scope)->plainTextToken;
        }

        return response()->json([
            'status' => true,
            'message' => "Account Created successfully! You will be redirected to the Home",
            'data' => $account,
            'token' => $token
        ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(string $any, int $id): JsonResponse
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
    public function update(StoreAccountRequest $request, string $any, int $id): JsonResponse
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
    public function destroy(string $any, int $id): JsonResponse
    {
        $account = Account::query()->findOrFail($id);

        $account->delete();

        return response()->json([
            'status' => true,
            'message' => "Account Deleted successfully!"
        ]);
    }
}
