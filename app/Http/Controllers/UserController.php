<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts=Post::where('user_id',Auth::id())->orderBy('id', 'DESC')->get();
        return view('profile',compact('posts'));
    }
   
   
    public function EnterUsername()
    {
        return view('EnterUsername');
    }
    
    public function AddUserName(Request $request)
    {
        $message=[
            'required' => 'حقل مطلوب',
            'username.max' => ' 25 حرفًا كحد أقصى ',
            'unique' => 'مـستخدم ',
            'regex' => '   أدخال حروف English فقط  ويمكن استخدام  ( -  .   _ ) | مثال h-r ',
            ];
            $details=Validator::make($request->only('username'),[
                'username' => 'bail|required|regex:/^[a-z][a-z-_.]*$/|string|max:25|unique:users,username',
            ],$message);
            
            if($details->fails())
            return response()->json(['error'=>$details->errors()]);
    
           User::where('id',Auth::id())->update(['username'=>$request->username,]);
        
    
    }


    public function DeletePost($id)
    {
        $post= Post::findOrfail($id);

        if($post->user_id == Auth::user()->id){
        $post->delete();
        return ('/profile');}
        else 
            return abort(404, 'Page Not Found');

    }


    public function UplodeImage(Request $request)
    {

        $messages=[
            'image' => 'الصيغة صورة فقط',
            'mimes' => 'نوع غير جيد',
            'max' => 'يجب ان يكون اقل من 2 ميجا',
            ];
            $validators=Validator::make($request->only('photo'),[
            'photo' => 'bail|required|image|mimes:jpg,jpeg,png,gif|max:2048',
            ] ,$messages );
    
            if ($validators->fails()) 
            return response()->json(['error'=>$validators->errors()]);
    
    }

    }
    
    



