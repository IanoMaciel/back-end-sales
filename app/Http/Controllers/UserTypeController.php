<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserTypeController extends Controller {
    protected UserType $userType;

    public function __construct(UserType $userType) {
        $this->userType = $userType;
    }

    public function index(): JsonResponse {
        return response()->json($this->userType->query()->orderBy('type')->get());
    }
}
