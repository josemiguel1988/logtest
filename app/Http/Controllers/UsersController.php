<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class UsersController extends Controller
{
    public function index(){
        return response()->json(User::all(),200);
    }

    public function store(Request $request){

        try{
            $validator = Validator::make($request->toArray(),[
                'name' => 'required|string',
                'email' => 'required|email|string',
                'birthday' => 'required|date_format:Y-m-d',
                'gender' => 'required|string'
            ]);

            if($validator->fails()){
                return response()->json($validator->messages(), 409);
            }
            
            $userWithEmail = User::where('email',$request->input('email'))->first();
            if($userWithEmail){
                return response()->json('Já existe um utilizador com esse email registado.',409);
            }

            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->birthday = $request->input('birthday');
            $user->gender = $request->input('gender');
            $user->save();

            return response()->json("Utilizador registado com sucesso.",200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(),500);
        }

        
    }

    public function update(Request $request,$id){
        try{
            $validator = Validator::make($request->toArray(),[
                'name' => 'required|string',
                'email' => 'required|email|string',
                'birthday' => 'required|date_format:Y-m-d',
                'gender' => 'required|string'
            ]);

            if($validator->fails()){
                return response()->json($validator->messages(), 409);
            }
            
            $user = User::findOrFail($id);
            
            $userWithEmail = User::where('email',$request->input('email'))->where('id','!=',$id)->first();
            if($userWithEmail){
                return response()->json('Já existe um utilizador com esse email registado.',409);
            }

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->birthday = $request->input('birthday');
            $user->gender = $request->input('gender');
            $user->save();

            return response()->json("Utilizador atualizado com sucesso.",200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }

    public function show($id){
        try{
            $user = User::findOrFail($id);
            
            return response()->json($user,200);
            
        }catch(\Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }

    public function destroy($id){
        try{
            $user = User::findOrFail($id);
            
            $user->delete();

            return response()->json("Utilizador eliminado com sucesso.",200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
}
