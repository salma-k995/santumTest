<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
class VisitorController extends Controller
{
 
    public function me(){
        $user= Auth::user();
        return response()->json([
            'success' => true,
            'message' => 'visitor showed successfuly',
            'data' => $user
        ]);
    }
}
