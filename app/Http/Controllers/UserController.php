<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::select('id','email', 'name', 'role')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'role'=> 'required'
            ]);
            if(!User::where('email',$request->email)->exists()){
                $user = new User();
                $user->name=$request->name;
                $user->email=$request->email;
                $user->password=Hash::make($request->password);
                $user->role=$request->role;
                $user->save();
                return ['status'=>true];
            }else{
                return ['status'=>false, 'message'=>'Email already exist'];
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role'=> 'required'
        ]);
        $user= User::where('id', $id)->first();
        $user->name=$request->name;
        $user->password=Hash::make($request->password);
        $user->role=$request->role;
        $user->update();
        return ['status'=>true];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::where('id', $id)->delete();
    }

    public function userRole(Request $request){

        return [];
    }
}
