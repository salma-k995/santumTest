<?php

namespace App\Http\Controllers;
use App\Models\Visitor;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
  
        public function delete($id){
            $visitor = Visitor::find($id);
            if($visitor){
                $visitor->delete();
                return response()->json([
                    'message' => 'visitor deleted successfuly',
                    'success' => 'true',
                ]);
            }
            else  return response()->json([
                'message' => 'visitor is alerady deleted ',
                'success' => 'false',
            ]);
            
        }
    
        public function retrieve(){
            $visitors= Visitor::onlyTrashed()->get();
            return response()->json([
              'message' => 'Deleted visitor showed successfuly',
              'success' => 'true',
              'data' =>  $visitors,
             ]);
        }
      
}
