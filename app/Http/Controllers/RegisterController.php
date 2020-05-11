<?php
namespace App\Http\Controllers;
 
 use App\User;
 use Illuminate\Http\Request;
  
 class RegisterController extends Controller
 {
     /**
      * Handles Registration Request
      *
      * @param Request $request
      * @return \Illuminate\Http\JsonResponse
      */
     public function register(Request $request)
     {
         $this->validate($request, [

            
             'nom' => 'required|min:3',
             'prenom' => 'required',
             'adresse' => 'required',
             'telephone' => 'required|integer',
             'email' => 'required|email|unique:users',
             'password' => 'required|min:6',
         ]);
  
         $user = User::create([
             'nom' => $request->nom,
             'prenom' => $request->prenom,
             'adresse'=>$request->adresse,
             'telephone'=>$request->telephone,
             'email' => $request->email,
             'password' => bcrypt($request->password)
         ]);
  
         $token = $user->createToken('TutsForWeb')->accessToken;
  
         return response()->json(['token' => $token], 200);
     }
     
     public function login(Request $request)
     {
         $credentials = [
             'email' => $request->email,
             'password' => $request->password
         ];
  
         if (auth()->attempt($credentials)) {
             $token = auth()->user()->createToken('TutsForWeb')->accessToken;
             return response()->json(['token' => $token], 200);
         } else {
             return response()->json(['error' => 'erreur'], 401);
         }
     }
  
     /**
      * Returns Authenticated User Details
      *
      * @return \Illuminate\Http\JsonResponse
      */
     public function details()
     {
         return response()->json(['user' => auth()->user()], 200);
     }
}