<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginCheck implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

     protected $request;

     public function __construct($request){
        $this->request = $request;
     }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $email = $this->request->input('email');
        $pass = $this->request->input('password');
        $loginStatus= False;

        $cekemail = UserModel::where('email',$email)->count();
        if($cekemail>0){
            $adminPass = UserModel::where('email',$email)->value('password');

            if(Hash::check($pass,$adminPass)){
            $loginStatus= TRUE;
            }
        }
        if($loginStatus){
            $ambilUser = UserModel::where('email',$email)-> first();
            Session::put('loginStatus',TRUE);
            Session::put('ambilUser',$ambilUser);
        } else {
            $fail ("Email dan Password Salah");
        }
    }
}
