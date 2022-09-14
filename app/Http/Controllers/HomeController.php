<?php

namespace App\Http\Controllers;

use App\Mail\thank;
use App\Models\Post;
use App\Models\User;
use App\Mail\ContactMail;
use App\Mail\ArrivalMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

  

public function SendMessage(Request $request){
        

        $message=[
        'required'=>"مطلوب",
        'fullname.max'=>"الحد الاعلى 40 حرف",
        'message.max'=>"الحد الاعلى 300 حرف",
        'regex'=>"احرف فقط",
        'email'=>"عنوان بريد الكتروني غير صالح",
        ];
        $details=Validator::make($request->only('fullname','email','message'),[
        'fullname'=>'bail|required|max:40|regex:/[a-zA-Z\s]+/  ',
        'email'=>'bail|required|email',
        'message'=>'bail|required|max:300|'
        ],$message);
        
        if($details->fails())
        return response()->json(['error'=>$details->errors()]);
        
     $info = [
        'fullname' => $request->fullname,
        'email' => $request->email,
        'message' => $request->message,
        ];
        Mail::to('hamzi.98.it@gmail.com')->send(new ContactMail($info));
        Mail::to($request->email)->send(new thank($info));

}
        
public function register( Request $request){

    $messages=[
            'required' => 'حقل مطلوب',
            'unique' => 'مـستخدم ',
            'min' => 'يجب أن يحتوي على ثمانية أحرف على الأقل',
            'confirmed' => 'كلمة المرور غير متطابقة',
            'email' => 'عنوان البريد الإلكتروني غير صالح',
            ];
    $validator=Validator::make($request->only('username','email','password','password_confirmation'), [
        'email' => 'bail|required|string|email|max:255|unique:users,email',
        'password' => 'bail|required|string|min:8|confirmed',
    ],$messages);
    
    if ($validator->fails()) 
    return response()->json(['error'=>$validator->errors()]);
    
    $user=User::create([
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'randomNumber'=>random_int(100000, 999999),
    ]);
    Auth::login($user);
}

public function redirect_google (){
    return Socialite::driver('google')->redirect();
}

public function callback_google (){
    $user = Socialite::driver('google')->user();
    $this->CreateOrUpdate($user,'google');
    return redirect('/profile');
}

public function CreateOrUpdate ($data,$provider){
    $user =User::where('email',$data->email)->first();
    if($user){
        $user->update([
            'provider'=>$provider,
            'provider_id'=>$data->id,
        ]); }
    else{
        $user=User::create([
            'email'=>$data->email,
            'provider'=>$provider,
            'provider_id'=>$data->id,
            'avatar'=>$data->avatar,
            'randomNumber'=>random_int(100000, 999999),
        ]);}

    Auth::login($user);
}

public function MessagePrivate($id,$number)
{
 $user=User::findOrfail($id);
 if($user->randomNumber ==$number ){

    return view('post',compact('id','number','user'));
 }
 return view('welcome');
}


public function SendMessagePrivate(Request $request)
{
$messages=[
        'required' => 'حقل مطلوب',
        'max' => ' 255 حرفًا كحد أقصى ',
        'string' => ' نص فقط ',
];
$validator=Validator::make($request->only('post','id','number'), [
    'post' => 'bail|required|string|max:255|',
    'id' => 'required',
    'number' => 'required',
],$messages);

if ($validator->fails()) 
return response()->json(['error'=>$validator->errors()]);

$user=User::findOrfail($request->id);
if($user->randomNumber ==$request->number ){

Post::create(['body'=>$request->post,'user_id'=>$request->id,]);
     $info = [
        'fullname' => $user->username,
        ];
        Mail::to($user->email)->send(new ArrivalMessage($info));
}
}
}
