<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Auth;

use App\Province;
use App\Town;
use App\Stay;
use Image;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $user_id = Auth::user()->id;

      $user = User::where('id', '=', $user_id)
      ->with('stays')
      ->with('province')
      ->with('town')
      ->first();

        return view('users.index', [
            'user' => $user
        ]);
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
        //
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
      $user = User::where('id', $id)->first();
      $provinces = Province::all();
      $towns = Town::all();

      return view('users.edit', [
            'user' => $user,
            'provinces' => $provinces,
            'towns' => $towns
        ]);
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
      $this->validate($request, [
        'name' => 'required|max:255',
        'surname' => 'required|max:255',
        'province_id' => 'required',
        'town_id' => 'required',
        'username' => 'required|max:255|unique:users,username,'.$id,
        'email' => 'required|email|unique:users,email,'.$id,
        'password' => 'max:255',
        'passwordConfirmation' => 'same:password',

      ]);

      $user = User::findOrFail($id);
      if($request->hasFile('image')) {
        if (File::exists(public_path('/images/images' . $user->image ))) {
          File::delete(public_path('/images/images' . $user->image ));
        }
          $image = $request->file('image');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          Image::make($image)->resize(220, 271)->save( public_path('/images/images' . $filename ) );
          $user->image = $filename;
      }
      $user->username = $request->username;
      $user->name = $request->name;
      $user->surname = $request->surname;
      $user->email = $request->email;
      if ($request->password) {
        if($request->password == $request->passwordConfirmation) {
            $user->password = bcrypt($request->password);
        }
        else {
            return Redirect::back()->withErrors('ERROR: Las contraseñas no coinciden');
        }
      }
      $user->province_id = $request->province_id;
      $user->town_id = $request->town_id;
      $user->save();

      return redirect('users');
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

    public function getTownList($province_id)
    {
        $town = Town::where("province_id",$province_id)->get();

        return response()->json($town);
    }

    public function userStay($id)
    {
      $stays = Stay::where('user_id', '=', $id)
      ->with('province')
      ->paginate(9);

      return view('users.userStay', [
        'stays' => $stays
      ]);
    }

}
