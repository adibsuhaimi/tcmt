<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\facades\Auth;
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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);

        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password')

        ]);
        $user->save();
        return redirect('/users')->with('success', 'Contact saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function profile($id)
    {
        $user = User::find($id);

        if ($user)
        {
            return view('user.profile')->withUser($user);
        }
        else
        {
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $user = User::find($id);

        if ($user)
        {
            return view('user.profile')->withUser($user);
        }
        else{
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit()
    {
        if (Auth::user())
        {
            $user = User::find(Auth::user()->id);
            if($user)
            {
                return view('user.edit')->withUser($user);
            }
            else
            {
                return redirect()->back();
            }
        }
        else
        {
            return redirect()->back();
        }
        
    }

    public function passwordedit()
    {
        if (Auth::user())
        {
            return view('user.passwordedit');
        }
        else
        {
            return redirect()->back();
        }
        
    }

    public function passwordupdate(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if($user)
        {
            if(Hash::check($request['oldpassword'],$user->password))
            {
                $user->password = Hash::make($request['password']);

                $user->save();

                $request->session()->flash('success','Your password has been updated ');
                return redirect()->back();
            } 
            else
            {
                $request->session()->flash('error','The entered password does not match with current password ');
                return redirect()->back();
            }
        }

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if ($user)
        {
            $validate = null;
            if(Auth::user()->email === $request['email'])
            {
                $validate = $request->validate([
                    'name'=>'required',
                    'email'=>'required'
                ]);
            }
            else
            {
                $validate = $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
                ]);
            }

            if ($validate)
            {
                $user->name =  $request->get('name');
                $user->email = $request->get('email');

                $user->save();

                $request->session()->flash('success', 'Your information have now been updated');
                return redirect()->back();
            }
            else
            {
                return redirect()->back();
            }
            
        }
        else
        {
            return redirect()-back();
        }
        
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
