<?php

namespace Modules\Authentication\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Patient\Entities\Patient;
use Modules\Authentication\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{

    public function register(RegisterRequest $request): JsonResponse
    {
        $patient = Patient::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number
        ]);

        return response()->json(['status' => 'success', 'message' => 'User registered']);
    }
}
