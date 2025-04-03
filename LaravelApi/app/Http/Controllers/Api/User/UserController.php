<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $user=User::all();
            return response()->json(['success'=>true,'message'=>$user, 'total_records'=>$user->count() ,'status'=>200]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage(),'status'=>500]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try{
            $data=$request->validated();
            $data['password']=$request->email;
            $data=User::create($data);
            return response()->json(['success'=>true,'message'=>'User created Successfully!','data'=>$data,'status'=>200]);
        }catch(\Exception $e){
            return response()->json(['success'=>false, 'message'=>$e->getMessage(),'status'=>500]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $data=User::find($id);
            return response()->json(['success'=>true,'message'=>'User fetched Successfully!','data'=>$data,'status'=>200]);
        }catch(\Exception $e){
            return response()->json(['success'=>false, 'message'=>$e->getMessage(),'status'=>500]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try{
            $data=User::find($id);
            return response()->json(['success'=>true,'message'=>'User fetched Successfully!','data'=>$data,'status'=>200]);
        }catch(\Exception $e){
            return response()->json(['success'=>false, 'message'=>$e->getMessage(),'status'=>500]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        try{
            $data=$request->validated();
            $user=User::find($id);
            $user->update($data);
            return response()->json(['success'=>true,'message'=>'User Updated Successfully!','data'=>$user,'status'=>200]);
        }catch(\Exception $e){
            return response()->json(['success'=>false, 'message'=>$e->getMessage(),'status'=>500]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
