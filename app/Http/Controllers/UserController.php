<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
        // dd($request->firstname . " " .  $request->lastname);
        $username = $request->username;
        $name = $request->name;
        $email = $request->email;
        $gender = $request->male ? "male" : "female";
        $age = $request->age;
        $profession = $request->profession;
        $password = $request->password;
        $token = Str::random(35);
        $user = User::insert([
            "username" => $username,
            "name" => $name,
            "email" => $email,
            "age" => $age,
            "profession" => $profession,
            "gender" => $gender,
            "password" => Hash::make($password),
            "email_verification_token" => $token
        ]);
        $data = [
            "token" => $token
        ];
        $mailSent = Mail::send('conformemail',$data, function ($message) use ($email) {
            $message->from('shuvosarkeruapcse@gmail.com');
            $message->to($email);
            $message->subject('Verify Your Email Address');
        });

        // if($mailSent) dd($mailSent);
        return redirect("verifyemail");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view("user", ["user" => $user]);
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
    public function update(Request $req)
    {
        $email = $req->email;
        $name = $req->name;
        $address = $req->address;
        $age = $req->age;
        $phone = $req->phone;
        $profession = $req->profession;
        $role = $req->role;
        $username = $req->username;
        $id = $req->id;
        // dd($address);
        User::find($id)->update([
            "email" => $email,
            "name" => $name,
            "address" => $address,
            "age" => $age,
            "phone" => $phone,
            "profession" => $profession,
            "role" => $role,
            "username" => $username,
        ]);

        return redirect()->route("user.show",["id" => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        User::find(request()->id)->delete();
        return back();
    }


    public function deactivate() {
        User::find(request()->id)->update([
            "active" => 0
        ]);
        return back();
    }


    public function activate() {
        User::find(request()->id)->update([
            "active" => 1
        ]);
        return back();
    }

    public function login(Request $req)
    {
        $t = Auth::attempt(['username' => $req->username, 'password' => $req->password]);
        if($t) {
            return redirect("profile");
        } else {
            return back()->with("error", "Credentials Are Not right");
        }
    }

    public function verify ( $token ) {
        $user  = User::where("email_verification_token", $token)->first();
        // dd($user);
        if( $user ) {
            $user->update([
                "email_verified_at" => Carbon::now(),
                "email_verification_token" => null,
            ]);
            return view("userverified", ["success" => "Email Varified" ]);
        } else {
            return view("userverified", ["error" => "Invalid URL" ]);
        }

    }

    public function ResetPassword (Request $req) {
        $email = $req->email;
        $password = $req->password;
        User::where("email", $email)->update([
            "password" => Hash::make($password)
        ]);

        return "Password is Reset,,, You can login now ";
    }

    public function sendPasswordResetToken(Request $req) {
        $email = $req->email;
        if ( !User::where("email", $email)->count() ) {
            return back()->with(["error" => "Invalid Email"]);
        }
        $token = Str::random(40);
        DB::table('password_resets')->insert([
            "email" => $email,
            "token" => $token
        ]);
        Mail::send('passwordReset', ["token"=>$token], function ($message) use ($email) {
            $message->from('shuvosarkeruapcse@gmail.com');
            $message->to($email);
            $message->subject('Password Reset Link');
        });

        return "<h3 style='style:text-align:center'>Reset Link Has Been Sent, Please Check Your Email</h3>";
    }
}
