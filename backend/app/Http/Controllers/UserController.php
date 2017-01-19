<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    protected $rules_create = [
                'firstname' => 'required',
                'lastname'  => 'required',
                'email'     => 'required|email|unique:users,email',
                'role'      => 'required|in:admin,user',
                'user'      => 'required|unique:users,user',
                'password'  => 'required|confirmed|min:6',
            ];

    protected $rules_update = [
                'firstname' => 'required',
                'lastname'  => 'required',
                'email'     => 'required|email',
                'role'      => 'required|in:admin,user',
            ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('tasks')->orderBy('id', 'asc')->get();

        if ($users->isEmpty()) return null;

        return $users;
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
        if (!is_array($request->all())) 
        {
            return ['error' => 'Request must be an array'];
        }
 
        try 
        {
            $validator = \Validator::make($request->all(), $this->rules_create);

            if ($validator->fails()) 
            {
                return [
                    'created' => false,
                    'errors'  => $validator->errors()->all()
                ];
            }
            else
            {
                $user = new User;
                $user->firstname = $request->firstname;
                $user->lastname = $request->lastname;
                $user->email = $request->email;
                $user->role = $request->role;
                $user->user = $request->user;
                $user->password = bcrypt($request->password);
                
                if ($user->save())
                {
                    return ['created' => true];
                }

                return ['created' => false];
            }

        } 
        catch (Exception $e) 
        {
            \Log::info('Error creating user: '.$e);

            return \Response::json(['created' => false], 500);
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
        return User::findOrFail($id);
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
        if (!is_array($request->all())) 
        {
            return ['error' => 'Request must be an array'];
        }
 
        try 
        {
            $validator = \Validator::make($request->all(), $this->rules_update);

            if ($validator->fails()) 
            {
                return [
                    'updated' => false,
                    'errors'  => $validator->errors()->all()
                ];
            }
            else
            {
                $email_exist = User::where('id', '!=', $id)->where('email', '=', $request->email)->first();
                if ($email_exist != null) return ['error' => 'Email already been taken'];

                $user = User::find($id);
                $user->firstname = $request->firstname;
                $user->lastname = $request->lastname;
                $user->role = $request->role;
                $user->email = $request->email;
                
                if ($user->save())
                {
                    return ['updated' => true];
                }

                return ['updated' => false];
            }

        } 
        catch (Exception $e) 
        {
            \Log::info('Error updating user: '.$e);

            return \Response::json(['updated' => false], 500);
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
        $user = User::findOrFail($id);

        $user = User::destroy($id);

        return ['deleted' => true];
    }

    /**
     * Display a listing of the users ids.
     *
     * @return \Illuminate\Http\Response
     */
    public function ids()
    {
        $users = User::select('id', 'firstname')->get();

        return $users;
    }
}
