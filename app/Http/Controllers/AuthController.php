<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use View;
use Redirect;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\storage;

use App\Province;
use App\Town;
use App\User;
use Image;
use Crypt;

class AuthController extends Controller
{

  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {

      $provinces = Province::all();
      $towns = Town::all();

      return view('register', [
        'provinces' => $provinces,
        'towns' => $towns
      ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

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

  /**
   * Muestra el formulario para login.
   */
  public function showLogin()
  {
      // Verificamos que el usuario no esté autenticado
      if (Auth::check())
      {
          // Si está autenticado lo mandamos a la raíz donde estara el mensaje de bienvenida.
          return Redirect::to('/');
      }
      // Mostramos la vista login.
      return View::make('login');
  }

    /**
     * Valida los datos del usuario.
     */
    public function postLogin()
    {
        // Guardamos en un arreglo los datos del usuario.
        $userdata = array(
            'username' => Input::get('username'),
            'password'=> Input::get('password')
        );
        // Validamos los datos y además mandamos como un segundo parámetro la opción de recordar el usuario.
        if(Auth::attempt($userdata, Input::get('remember-me', 0)))
        {
            // De ser datos válidos nos mandara a la bienvenida
            return Redirect::to('/');
        }
        // En caso de que la autenticación haya fallado manda un mensaje al formulario de login y también regresamos los valores enviados con withInput().
        return Redirect::to('login')
                    ->with('mensaje_error', 'Tus datos son incorrectos')
                    ->withInput();
    }

    /**
     * Muestra el formulario de login mostrando un mensaje de que cerró sesión.
     */
    public function logOut()
    {
        Auth::logout();
        return Redirect::to('login')
                    ->with('mensaje_error', 'Tu sesión ha sido cerrada.');
    }

    public function getTownList($province_id)
    {
        $town = Town::where("province_id",$province_id)->get();

        return response()->json($town);
    }

    public function registerStore(Request $request)
    {
      $this->validate($request, [
        'name' => 'required|max:255',
        'surname' => 'required|max:255',
        'province_id' => 'required',
        'town_id' => 'required',
        'username' => 'required|max:255|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'passwordConfirmation' => 'required|same:password',

      ]);

      $user = new User;
      if($request->hasFile('image')) {
          $image = $request->file('image');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          Image::make($image)->resize(220, 271)->save( public_path('/images/images' . $filename ) );
          $user->image = $filename;
      }
      $user->username = $request->username;
      $user->name = $request->name;
      $user->surname = $request->surname;
      $user->email = $request->email;
      $user->password = $request->password;
      $user->password = bcrypt($request['password']);
      $user->province_id = $request->province_id;
      $user->town_id = $request->town_id;
      $user->save();
      return redirect('login');
    }

}
