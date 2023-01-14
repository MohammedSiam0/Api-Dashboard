<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function showLogin(Request $request)
    {
        //  في الإصدارات القديمة كانت تستخدم add  بدل merge  
        // تهذف هذه الي احضار القيمة الموجودة في الرابط وليس محتوى الريكوست 
        $request->merge(['guard' => $request->guard]);
        $validator = Validator($request->all(), [
            'guard' => 'required|string|in:admin,web'
        ]);
        if (!$validator->fails()) {
            return response()->view('cms.auth.login', ['guard' => $request->input('guard')]);
        } else {
            // انه يطلعله فش صفحة ويحط القيمة لحاله تبعتها
            abort(Response::HTTP_NOT_FOUND);
        }

    }

    public function login(Request $request)
    {
            $table = $request->guard =='web' ? 'users' :'admins';
        $validator = Validator($request->all(), [
          //  'email' => "required|email",
           'email' => "required|email|exists:$table,email",
            'password' => 'required|string|min:3',
            //'remember' => 'required|boolean',
            'guard' => 'required|string|in:admin,web',
        ]);

        if (!$validator->fails()) {
            $crendentials = ['email' => $request->input('email'), 'password' => $request->input('password')];
            if (Auth::guard($request->input('guard'))->attempt($crendentials, $request->input('remember'))) {
                return response()->json(['message' => 'Logged in successfully'], Response::HTTP_OK);
            } else {
                return response()->json(
                    ['message' => 'Login failed, check your credentials'],
                    Response::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }

    public function logout(Request $request)
    {   // فحص اذا ويب او لاء 
        $guard = auth('web')->check() ? 'web' : 'admin';
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        // هنا مررنا الجراد علشان نعرف وين يوجهنا بالاخر نفس صفحة اللوجن مستخدمين 
        return redirect()->route('cms.login', $guard);
    }


    
    public function showRegister(Request $request)
    {
        //  في الإصدارات القديمة كانت تستخدم add  بدل merge  
        // تهذف هذه الي احضار القيمة الموجودة في الرابط وليس محتوى الريكوست 
        $cities =City::where('active','=',true)->get();
      //  return response()->view('cms.users.index',['users'=> $users]);
        $request->merge(['guard' => $request->guard]);
        $validator = Validator($request->all(), [
            'guard' => 'required|string|in:web'
        ]);
        if (!$validator->fails()) {
            return response()->view('cms.auth.rejester',['cities'=> $cities]);
        } else {
            // انه يطلعله فش صفحة ويحط القيمة لحاله تبعتها
            abort(Response::HTTP_NOT_FOUND);
        }

    }
    public function register(Request $request){
       
        //
        $valedator = Validator($request->all(),[
            'name' => 'required|string|min:3|max:100',
             'email_address' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3|max:100',
            'city_id' => 'required|numeric|exists:cities,id',
            // طريقة تحديد كم رقم تريد , موجودة في بوست مان تبع  سمارت ستور
          //  required|numeric|digits:9
        ]);
        if(auth('user-api')->check()){
            if(!$valedator->fails()){
                $user =new User();
                $user->name = $request->input('name');
                $user->email = $request->input('email_address');           
                 $user->password = Hash::make($request['password']);
                $user->city_id = $request->input('city_id');
                 $user->save();
         return response()->json([
                'status' => true,
                'message' => "User Created successfully!",
                "data" => $user
            ], 200);
                
            }
        
          }else {
            if(!$valedator->fails()){
                $user =new User();
                $user->name = $request->input('name');
                $user->email = $request->input('email_address');
                // الطريقة الصحيحة لحفظ الباسورد لانه لازم تكون مشفرة 
                $user->password = Hash::make($request['password']);
                $user->city_id = $request->input('city_id');
                $isSaved = $user->save();
        
                return response()->json(
                    ['message' => $isSaved ? __('Created Successfully') : __('Create Failed!')],
                    $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
                );
            }else{
                return response()->json(['message'=>$valedator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
            }
          
          }
    }



}
