<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:visitors|unique:admins',
                'password' => 'required|string|min:8',
        ]);
        if ($request->is_admin =="1"){
            $admin = Admin::create([
                'name' => $request->name,
                'email' =>  $request->email,
                'password' => Hash::make($request->password),
           ]);
        return response()->json([
                    'success' => true,
                    'message' => 'admin created successfuly',
        ]);
        }
        else if($request->is_admin =="0") {
            $visitor = Visitor::create([
                'name' => $request->name,
                'email' =>  $request->email,
                'password' => Hash::make($request->password),
           ]);
        return response()->json([
                    'success' => true,
                    'message' => 'visitor created successfuly',
        ]);
    }
}
    public function login(Request $request)
    {
       
        if(Auth::guard('admins')->attempt(['email' => $request->email, 'password' => $request->password])) {   
         $admin= Auth::guard('admins')->user();    
         $token = $admin->createToken('MyApp',['admins'])->plainTextToken;
         return response()->json([
             'success' => true,
             'message' =>'welcome you logged successfuly',
             'data' => [
                 'admin' => [
                     'id' => $admin->id,
                     'name' => $admin->name,
                     'email' => $admin->email,  
                 ],
                 'token' => [
                     'access_token' => $token,
                     'token_type' => 'Bearer',
                 ],
             ],
         ]);
      
         } 
     
          if(Auth::guard('visitors')->attempt(['email' => $request->email, 'password' => $request->password])) {   
            $visitor= Auth::guard('visitors')->user();    
            $token = $visitor->createToken('MyApp',['visitors'])->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => 'welcome you logged successfuly',
                'data' => [
                    'visitor' => [
                        'id' => $visitor->id,
                        'name' => $visitor->name,
                        'email' => $visitor->email,  
                    ],
                    'token' => [
                        'access_token' => $token,
                        'token_type' => 'Bearer',
                    ],
                ],
            ]);
         
            } 
    } 
    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        return [
            'success' => 'true',
            'message' => 'user logged out'
        ];
    }
}
