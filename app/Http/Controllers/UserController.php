<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidation;
use App\Http\Requests\RegisterValidation;
use App\Http\Requests\UserUpdateValidation;
use App\Models\Friend;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function friends()
    {
        //dd(Auth::user()->friends);
        $friends = collect();
        //friends collection with model for performance
        foreach (Auth::user()->friends as $friend){
            $friends->push([
                'user'=> User::all()->firstWhere('login',$friend['login']),
                'canAccept'=>$friend['canAccept'],
                'accepted'=>$friend['accepted'],
            ]);
        }
        return view('users.friends', compact('friends'));
    }
    public function friendAdd(Request $request)
    {
        if($request['friend']==Auth::user()->login) return back();  //can't add yourself
        $friendLogin = $request->validate(['friend'=>'required'])['friend'];
        if(Auth::user()->friend($friendLogin)) return back(); // can't add existing friend

        $friend = User::firstWhere('login',$friendLogin);
        //add friend for user
        Auth::user()->friends([['login' => $friend->login, 'canAccept' => false, 'accepted'=>false]]);
        //and user for friend
        $friend->friends([['login' => Auth::user()->login, 'canAccept' => true, 'accepted'=>false]]);

        return redirect()->route('friends')->with(['success'=>true]);
    }
    public function friendDelete(Request $request)
    {
        $friendLogin = $request->validate(['friend'=>'required'])['friend'];
        //Delete for yourself
        Auth::user()->friendDelete($friendLogin);
        //and how for friend? Is this working?
        //How this should work?
        User::all()->firstWhere('login',$friendLogin)->friendDelete(Auth::user()->login);
        return redirect()->route('friends')->with(['deleted'=>true]);
    }
    public function friendAccept(Request $request)
    {
        $friendLogin = $request->validate(['friend'=>'required'])['friend'];

        //Auth::user()->friendsReplace(['login' => $friendLogin, 'canAccept' => true, 'accepted'=>true]);

        //Accept for yourself
        Auth::user()->friendAccept($friendLogin);

        //and how for friend?
        User::all()->firstWhere('login',$friendLogin)->friendAccept(Auth::user()->login);

        return redirect()->route('friends')->with(['accepted'=>true]);
    }
    public function profile($id)
    {
        return view('users.profile', ['user' => User::find($id)]);
    }







    //открывает кабинет
    public function cabinet()
    {
        return view('users.cabinet');
    }
    public function cabinetEdit(UserUpdateValidation $request)
    {

        $validation = $request->validated();
        if($request['password'] != null) $validation['password'] = Hash::make($request['password']);
        else unset($validation['password']);

        unset($validation['image']);
        if($request->hasFile('image')){
            $photo = $request->file('image')->store('public');
            $validation['image'] =explode('/', $photo)[1];
        }
        Auth::user()->update($validation);
        return redirect()->route('cabinet')->with(['success'=>true]);
    }
    //открывает авторизацию
    public function login()
    {
        return view('users.login');
    }
    //авторизирует пользователя если валидация правильная
    public function loginPost(LoginValidation $request)
    {
        if(Auth::attempt($request->validated())){
            $request->session()->regenerate();
            return redirect()->route('cabinet')->with(['auth'=>true]);
        }
        return back()->withErrors(['auth'=>'Login or password incorrect']);
    }
    //открывает регистрацию
    public function register()
    {
        return view('users.register');
    }
    //регистрирует пользователя из регитсрации пароль хэширует
    public function registerPost(RegisterValidation $request)
    {
        $validation = $request->validated();
        $validation['password'] = Hash::make($validation['password']);
        User::create($validation);
        return redirect()->route('login')->with(['register'=> true]);
    }
    //выход пользователя
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();
        return redirect()->route('home')->with(['success'=> true]);
    }

}
