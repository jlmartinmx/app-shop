<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use GuzzleHttp\Psr7\Request; // revisar donde se usa y para q.
use Illuminate\Http\Request as Req;// se usa el alias Req x q ya existe otro Request en linea anterior.


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data){
        // 74 15:42
        return Validator::make($data, [
            'name'      => 'required|string|max:255',
            'email'     => 'nullable|email|max:255|unique:users',
            'password'  => 'required|string|min:6|confirmed',
            'phone'     => 'required',
            'address'   => 'required',
            'username'  => 'required|unique:users' 
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // este metodo es llamado x la logica del paq auth despues de q se valido los
    // datos del formulario x metodo validator()
    protected function create(array $data)
    {
        return User::create([
            'name'      => $data['name'],
            'email'     => $data['email'] ?: '',
            'password'  => bcrypt($data['password']),
            'phone'     => $data['phone'], 
            'address'   => $data['address'],
            'username'  => $data['username']
        ]);
    }

    // 74 4:51
    // sobreescribiendo metodo x q existe en trait RegistersUsers q se usa arriba al inicio de esta clase
    // y al sobreescribir metodos interceptamos su llamada desde este controlador al metodo 
    // showRegistrationForm q se encuentra dentro del paquete trait RegistersUsers y el fin de
    // interceptar la llamada es insertar valores x ejm en este caso name y email.
    public function showRegistrationForm(Req $request){
        $name = $request->input('name');
        $email = $request->input('email');

        return view('auth.register')->with(compact('name','email'));

    }
}
