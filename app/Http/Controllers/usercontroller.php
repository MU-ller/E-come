<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class usercontroller extends Controller
{
  function login(Request $request)
  {
      $user=User::where(['email'=> $request->email])->first();
      if(!$user|| !Hash::check($request->password,$user->password))
      {
          return "either user name or password is not much";
      }
      else
      {
          $request->session()->put('user',$user);
          return redirect('/');
      }
  }
  function register(Request $request)
  {
      $request->input();
      $user=new User();
      $user->name=$request->name;
      $user->email=$request->email;
      $user->password=Hash::make($request->password);
      $user->save();
      return redirect("/login");

  }
}
