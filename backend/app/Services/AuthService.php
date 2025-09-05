<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;  

class AuthService{

    protected $users;

    public function __construct(UserRepositoryInterface $users)
    {
        $this->users = $users;
    }

    public function register(array $data){
        $data['password'] = Hash::make($data['password']);

        $user = $this->users->create($data);

        $token = $user->createToken('auth_token')->plainTextToken;

         return [
            'user' => $user,
            'token' => $token
        ];
        $user->sendEmailVerificationNotification();
        event(new Registered($user));
    }

    public function login(array $data){
        $user = $this->users->findByEmail($data['email']);

        if(!$user || !Hash::check($data['password'], $user->password)){
            throw ValidationException::withMessages([
                'email' => 'The credentials are incorrect, please provide correct info!'
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function logout($user){
        return $user->currentAccessToken()->delete();
    }
}