<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{


    // public function __construct(){
     
    //     $this->authorizeResource(Admin::class,'admin');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
     $admins = Admin::all();
     return response()->view('cms.admins.index',['admins'=>$admins]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles =Role::where('guard_name','=','admin')->get();
        return response()->view('cms.admins.create',['roles'=>$roles]);
        
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
            'email_address' => 'required|email|unique:admins,email',
            'role_id' => 'required|numeric|exists:roles,id',
        ]);
        if(!$valedator->fails()){
            $admin =new Admin();
            $admin->name = $request->input('name');
            $admin->email = $request->input('email_address');
            $admin->password = Hash::make(12345);
            $isSaved = $admin->save();
            if($isSaved){
                $admin->assignRole(Role::findById($request->input('role_id'),'admin'));
            }
            return response()->json(
                ['message' => $isSaved ? __('Created Successfully') : __('Create Failed!')],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        }else{
            return response()->json(['message'=>$valedator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
        $roles = Role::where('guard_name','=','admin')->get();
        $adminRole = $admin->roles()->first();
        return response()->view('cms.admins.edit',[
            'admin' =>$admin,
            'adminRole'=> $adminRole ,
            'roles'=> $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
         //
         $valedator = Validator($request->all(),[
            'name' => 'required|string|min:3|max:100',
            // unique:users,email  تعني انه فريد في جدول اليوزر , تحت مسمى كولم ايميل 
            'email_address' => 'required|email|unique:admins,email,'.$admin->id,
            'role_id' => 'required|numeric|exists:roles,id',
        ]);

 

        if(!$valedator->fails()){
             $admin->name = $request->input('name');
            $admin->email = $request->input('email_address');
            $admin->password = Hash::make(12345);
            $isSaved = $admin->save();
            if($isSaved){
                $admin->syncRoles(Role::findById($request->input('role_id'),'admin'));
            }
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $isDeleted =$admin->delete();
        return response()->json(['message' => $isDeleted ? 'Delete Successfully' :'Delete Failed!'],
        $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
    );
    }
}
