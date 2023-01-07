<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Psy\CodeCleaner\FunctionContextPass;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthController extends Controller
{
    //
    // الطريقة الاولة المختصة بعمل كل الحسابات بس من توكن واحد

    public function loginPersonal (Request $requset){
        $valedator  =Validator($requset->all(),[

            'email'=>'required|email|exists:users,email',
            'password'=>'required|string|min:3',
        ]);
        if(!$valedator->fails()){
            
            //hidden ف علشان هيك بنخفي مثلا وقت انشاء الحساب من المودل تبع اليوزر في ال api هنا بتجيب كل البياات وما بلزمو في    
            $user = User::where('email',$requset->input('email'))->first();
            if(Hash::check($requset->input('password'),$user->password)){
                // هذا علشان نحدف اي توكن قبل عملية تسجيل الدخول وا يكون في حدا مسجل من جهاز اخر
                $this->revokeProviousTokens($user->id);
                //api انشاء توكن علشان المستخدم تبع 
                // اي اشي بتقدر  تحط عادي  'User'الاسم  
                $token =$user->createToken('User');  
                $user->setAttribute('token',$token->accessToken);  
                return response()->json(['message'=>'Logged in Successfully','data'=>$user],Response::HTTP_OK);
                        /// ملاحظة علشان نقلل وقت التوكن عشان يصير توكن ملوش لازمة بنروح على المسار التالي بروفايدر اوث سيرفس بروفايدر
            }else{
                            return response()->json(['message'=>'Login failed , wrong cresentials'],Response::HTTP_BAD_REQUEST);
                        }
                    }else{
                return response()->json(['message'=> $valedator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
            }
        
    }

    // الطريقة الثانية المختصة بعمل كل حساب من توكن جديد 
    public function loginPGCT (Request $requset){
        $valedator  =Validator($requset->all(),[

            'email'=>'required|email|exists:users,email',
            'password'=>'required|string|min:3',
        ]);
        if(!$valedator->fails()){
            return $this->generatePgctToken($requset);
          
            }else{
                return response()->json(['message'=> $valedator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
            }
    }

private function generatePgctToken(Request $request){
  try {
   
    $response =Http::asForm()->post('http://127.0.0.1:81/oauth/token',[
        'grant_type' =>'password',
        'client_id'=>'2',
        'client_secret'=>'FVhpN2HtSVrWKw1aY2tlfOXZJ4nFq8Ks7io2Nywt',
        'username'=>$request->input('email'),
        'password'=>$request->input('password'), 
        'scope'=>'*',

    ]);
    $user = User::where('email','=',$request->input('email'))->first();
    
    //      $this->revokeProviousTokens($user->id,2);

    $user->setAttribute('token',$response->json()['access_token']);
    
    // لو بدي اعرض اي اشيي زي الفلاتر يعني 
    return response()->json([
        'message' => 'Login Successfuly',
        'data' => $user ,
    ],Response::HTTP_OK);
  } catch (Exception $th) {
    return response()->json([
        'message'=>$response->json()['message']],
        Response::HTTP_BAD_REQUEST,
    ); 
    //throw $th;
  }
}

// دالة لتجعل المستخدم يسجل مرة واحدة فقط 

public function revokeProviousTokens($userId ,$clientId = 1){
    DB::table('oauth_access_tokens')
    ->where('user_id','=',$userId)
    ->where('client_id','=',$clientId)
    ->update([
        'revoked' =>true
    ]);
}

public function logout(){
    $revoked =auth('user-api')->user()->token()->revoke();
    return response()->json(
        [
            'message'=>$revoked ? 'Logged out successfully' : 'Logout failed!' ,
        ],
        $revoked ? Response::HTTP_OK :Response::HTTP_BAD_REQUEST
    );
}

}
