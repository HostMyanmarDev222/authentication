<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

use App\Models\User;

class UserAuthController extends Controller
{
    public function login()
    {
        return view('cauth.login');
    }
    public function register()
    {
        return view('cauth.register');
    }
    public function create(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12',
        ]);
        // return $request->input();

        //if user validate successfully,register new user.
        // $user = new User();
        // $user->name=$request->name;
        // $user->email=$request->email;
        // $user->password=$request->Hash::make(password);
        // $query = $user->save()
        //USE QUERY BUILDER 
            $query = DB::table('users')
                        ->insert([
                            'name'=>$request->name,
                            'email'=>$request->email,
                            'password'=>Hash::make($request->password)
                        ]);
        if($query){
            return back()->with('success', 'You have been successfully registered');
        }
        else{
            return back()->with('fail', 'Something wrong');
        }
    }

    public function check(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required|min:5|max:12',
        ]);
        // $user = User::where('email','=',$request->email)->first();
        $user = DB::table('users')
                    ->where('email',$request->email)
                    ->first();
        if($user){
            if(Hash::check($request->password,$user->password)){
                $request->session()->put('LoggedUser',$user->id); //session create
                return redirect('profile');
            }
            else{
                return back()->with('fail','Invalid password');
            }
        }
        else{
            return back()->with('fail','No account found for this email');
        }
    }

    public function profile(){
        if(session()->has('LoggedUser')){
            $user = DB::table('users')
                    ->where('id',session('LoggedUser'))
                    ->first();
            // $user = User::where('id','=',session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo'=>$user
            ];
        }
        return view('admin.profile',$data);
    }

    function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('login');
        }
    }
}
