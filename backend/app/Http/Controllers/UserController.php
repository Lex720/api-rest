<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // Reglas de validación
    protected $rules = [
                'name'      => 'required',
                'email'     => 'required|email',
                'password'  => 'required'
            ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();

        //return view('create');
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
            return ['error' => 'request must be an array'];
        }
 
        try 
        {
            // Ejecucion del validador
            $validator = \Validator::make($request->all(), $this->rules);

            if ($validator->fails()) 
            {
                return [
                    'created' => false,
                    'errors'  => $validator->errors()->all()
                ];
            }
            else
            {
                User::create($request->all());

                return ['created' => true];
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
            return ['error' => 'request must be an array'];
        }
 
        try 
        {
            // Ejecucion del validador
            $validator = \Validator::make($request->all(), $this->rules);

            if ($validator->fails()) 
            {
                return [
                    'updated' => false,
                    'errors'  => $validator->errors()->all()
                ];
            }
            else
            {
                $user = User::find($id);

                $user->update($request->all());
                
                return ['updated' => true];
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
}
