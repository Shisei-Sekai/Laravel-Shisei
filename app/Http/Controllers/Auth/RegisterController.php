<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\User;
use App\Http\Controllers\Controller;
use App\UserRoles;
use App\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;

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
    protected $redirectTo = '/';

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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $code = str_random(40);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'avatar' => 'https://i.pinimg.com/originals/56/de/52/56de52932d542ed611e8daa147dbf8f8.jpg',
            'signature' => '',
            'money' => 0,
            'confirmation_code'=> $code,
        ]);
        $user->confirmation_code = $code;
        $user->save();
        //Assign the "user" role to that user
        $role = new UserRoles();
        $role->user_id = $user->id;
        $role->role_id = Role::all()->where('name','=','user')->first()['id'];
        $role->save();

        Mail::send('email.verify',['name'=>$data['name'],'confirmationCode'=>$code],function ($m) use($data){
            $m->from('contact@jojo.com.ve','Shisei Sekai Contact');

            $m->to($data['email'],$data['name'])->subject('Email Confirm');
        });
        return $user;
    }

    public function confirm($confirmationCode){
        if(!$confirmationCode){
            return redirect('home');
        }
        $user = User::where('confirmation_code','=',$confirmationCode)->get()->first();
        $user->confirmed = true;
        $user->confirmation_code = null;
        $user->save();
        return view('confirmed');
    }

    public function register(Request $request){
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //$this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
