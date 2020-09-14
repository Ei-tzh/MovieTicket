<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'                  =>   'required|unique:users',
            'email'                 =>   'required|email',
            // 'ph_no'                 =>   'required|digits_between:9,11',
            'image'                 =>   'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'password'              =>   'required|min:8|confirmed'
            
        ]);
        if($request->hasfile('image')){
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('/public/images/admin',$filename);
            $url=Storage::url('images/admin/'.$filename);
        }else{
            $user_url=Storage::url('images/admin/user.jpg');
        }
        
        User::create([
            'name' => $request->name,
            'email' =>$request->email,
            'role'=>$request->role,
            'image'=>$request->image==''?$user_url:$url,
            'password'=>Hash::make($request->newPassword)
        ]);
        return redirect()->route('users.index');
        //return $request->role;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
