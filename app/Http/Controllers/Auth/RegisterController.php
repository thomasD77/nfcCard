<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\listUrl;
use App\Models\Material;
use App\Models\Member;
use App\Models\URL;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users','email:rfc,dns'],
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
            ],
            'password_confirmation' => 'required|same:password'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $url = URL::first()->url;
        $member = new Member();
        $listURL = listUrl::where('id', $data['card_id'])->first();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        DB::table('user_role')->insert([
            'user_id' => $user->id,
            'role_id' => '3',
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),]);

        //Save member settings
        $member->user_id = $user->id;
        $member->card_id = $data['card_id'];
        $member->memberURL = $url . '/?' . $data['card_id'];
        $member->memberQRcode = $url . '/QRcode'. '/' . $data['card_id'];
        $member->material_id = $listURL->material_id;
        $member->package_id = $listURL->package_id;
        $member->titleMessage = "Thank you for this amazing SWAP";
        $member->save();

        //Connect User with member
        $user->member_id = $member->id;
        $user->save();

        //Connect ListURl with Member
        $listURL->member_id = $member->id;
        $listURL->save();

        return $user;
    }
}
