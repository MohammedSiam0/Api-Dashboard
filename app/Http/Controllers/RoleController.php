<?php

namespace App\Http\Controllers;

 
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role ;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */                                                                                                                                                                                                                                                                 
    public function index()                    
    {
        $roles = Role::all();
        //$roles = Role::withCount('permissions')->get();
        return response()->view('cms.roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'guard_name' => 'required|string|in:admin,web',
            'name' => 'required|string',
        ])->validate();
        $role = new Role();
        $role->name = $request->input('name');
        $role->guard_name = $request->input('guard_name');
        $isSaved = $role->save();
        return response()->json(
            ['message' => $isSaved ? __(' created successfully') : __('Create failed!')],
            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return response()->view('cms.roles.edit',['role'=>$role]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validator = Validator($request->all(), [
            'guard_name' => 'required|string|in:admin,web',
            'name' => 'required|string',
        ]);
        if(!$validator->fails()){
         $role->name = $request->input('name');
        $role->guard_name = $request->input('guard_name');
        $isSaved = $role->save();
        return response()->json(
            ['message' => $isSaved ? __('Updated successfully') : __('Updated failed!')],
            $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST,
        );
    }else{
        return response()->json(['message'=>$validator->getMessageBag()->first()],
        Response::HTTP_BAD_REQUEST
    );
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */ 
    public function destroy(Role $role)
    {
       $isDeleted = $role->delete();
       return response()->json(['message'=>$isDeleted ? 'Deleted Successfully' : 'Delete Failed!'],
       $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST

);
    }
}