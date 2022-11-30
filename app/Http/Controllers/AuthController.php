<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function token(Request $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $scope = $request->scope ? [$request->scope] : ['customer-all'];
            $success['token'] = $user->createToken('bnb-bank-token', $scope)->plainTextToken;
            $success['name'] = $user->name;

            return response()->json([
                'status' => true,
                'data' => $success
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorised'
            ], 401);
        }
    }
}
