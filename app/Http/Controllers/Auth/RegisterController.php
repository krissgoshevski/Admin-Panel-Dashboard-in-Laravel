<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    // /**
    //  * Create a new user instance after a valid registration.
    //  *
    //  * @param  array  $data
    //  * @return \App\Models\User
    //  */

    //     protected function create(array $data)
    //     {
    //         return User::create([
    //             'name' => $data['name'],
    //             'email' => $data['email'],
    //             'password' => Hash::make($data['password']),  
    //         ]);
    //     }



    public function register(Request $request)
        {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'favoriteColour' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required'],
        ]);

            // make avatar
          // new 
          $name = $request->input('name');

          $path = 'users/images/';
          $fontPath = public_path('fonts/Oliciy.ttf');
          $char = strtoupper(substr($name, 0, 1)); //get first char of name
          $newAvatarName = rand(12,34353).time().'_avatar.png';
          $dest = $path.$newAvatarName;

          $createAvatar = \makeAvatar($fontPath, $dest, $char);
          $picture = $createAvatar == true ? $newAvatarName : '';

        $user = new User;
        $user->name = $name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);
        $user->favoriteColour = $request->favoriteColour;
        $user->picture = $picture;

       

        if($user->save()) {
            return redirect()->route('login')->with('success', 'you are succesfully registered, now please "Log In" below');
        }

        return redirect()->route('register')->with('error', 'failder to register');

    }


}
