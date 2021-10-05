<?php

namespace Modules\Authentication\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Authentication\Http\Requests\AdminLoginRequest;
use Modules\Authentication\Http\Requests\DoctorLoginRequest;
use Modules\Authentication\Http\Requests\PatientLoginRequest;
use Modules\Authentication\Traits\AuthenticationService;

class AuthenticationController extends Controller
{
    use AuthenticationService;

    /**
     * @param AdminLoginRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function adminLogin(AdminLoginRequest $request)
    {
        $login = $this->login($request, 'admins');

        return response()->json([
            $login->response,
            $login->status
        ]);
    }

    /**
     * @param DoctorLoginRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function doctorLogin(DoctorLoginRequest $request)
    {
        $login = $this->login($request, 'doctors');

        return response()->json([
            $login->response,
            $login->status
        ]);
    }

    /**
     * @param PatientLoginRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function patientLogin(PatientLoginRequest $request)
    {
        $login = $this->login($request, 'patients');

        return response()->json([
            $login->response,
            $login->status
        ]);
    }
    
   
}
