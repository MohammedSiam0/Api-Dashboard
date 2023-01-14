<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use Dotenv\Validator;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(){
     
        $this->authorizeResource(User::class,'user');
    }
    // for run create this file with model User 
    // php artisan make:controller UserController --model=User


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //$users = User::all();
        // المدينة في جدول ثاني , ف بنقدر نجيبها عن طريق الايدي الي  مع المستخدم , ف هلوقت بنقوله هاتلي المدينة مع المستخدم 
                            // كلمة ستي  هي اسم الفنكشن الي معرفة في مودل اليوزر city
     // الطريقة الي فوق الي بتجيب الكل بتزبط بس الصح نعمل العملية هنا مش في البليد وانتهى
     $users = User::with('city')->get();
     return response()->view('cms.users.index',['users'=> $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       // هاتلي المدن الي بكونو اكتف 
        $cities =City::where('active','=',true)->get();
        // فكرة ال المتغير الي بيرتسل هنا بيحمل البيانات على الصفحة المرادة 
        return response()->view('cms.users.create',['cities'=>$cities]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $valedator = Validator($request->all(),[
            'name' => 'required|string|min:3|max:100',
            // unique:users,email  تعني انه فريد في جدول اليوزر , تحت مسمى كولم ايميل 
            'email_address' => 'required|email|unique:users,email',
            'city_id' => 'required|numeric|exists:cities,id',
            // طريقة تحديد كم رقم تريد , موجودة في بوست مان تبع  سمارت ستور
          //  required|numeric|digits:9
        ]);
        if(auth('user-api')->check()){
            if(!$valedator->fails()){
                $user =new User();
                $user->name = $request->input('name');
                $user->email = $request->input('email_address');
                $user->password = $request->input('password');
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
                $user->password = Hash::make(12345);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $cities = City::where('active', '=', true)->get();
        return response()->view('cms.users.edit',['user'=>$user , 'cities'=>$cities , ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
          //
          $valedator = Validator($request->all(),[
            'name' => 'required|string|min:3|max:100',
                                                    //  علشان يستثني صاحب الايميل ويحفظ عادي على نفسه  .$user->id  الايميل ما بدي اعدله  بدي يكون هوا نفسه عادي ف بنحط                                                               
            'email_address' => 'required|email|unique:users,email,'.$user->id,
            'city_id' => 'required|numeric|exists:cities,id',
        ]);
        if(!$valedator->fails()){
             $user->name = $request->input('name');
            $user->email = $request->input('email_address');
            $user->password = Hash::make(12345);
            $user->city_id = $request->input('city_id');
            $isSaved = $user->save();
    
            return response()->json(
                ['message' => $isSaved ? __('Update Successfully') : __('Update Failed!')],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST,
            );
        }else{
            return response()->json(['message'=>$valedator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $isDeleted =$user->delete();
        return response()->json(['message' => $isDeleted ? 'Delete Successfully' :'Delete Failed!'],
        $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
    );
    }
}
