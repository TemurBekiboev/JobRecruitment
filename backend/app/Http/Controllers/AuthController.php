<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request){
        $result = $this->authService->register($request->validated());

        // return redirect()->route('verification.notice');
       
        return response()->json($result,201);
    }

    public function login(LoginRequest $request){
        $result = $this->authService->login($request->validated());
        return response()->json($result,200);
    }
}
