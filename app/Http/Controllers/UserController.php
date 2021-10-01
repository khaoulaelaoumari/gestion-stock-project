<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=DB::table('users')->select('id','name','prenom','email','phone','role')->get();
        return datatables::of($data)
        // ->addColumn('responsive_id', function($row){
        //             $btn ="";
        //             return $btn;
        //         })
                ->rawColumns(['id','name','prenom','email','phone','role'])
                ->make(true);
        // return response()->json($data);
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
        $request->validate([
            'name' => 'required|string',
            'prenom' => 'required|string',
            'phone'=>'required|min:10|numeric',
            'role' => 'required',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|',
            // 'c_password' => 'required|same:password',
          ]);
      
          $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'prenom' => $request->prenom,
            'phone'=>$request->phone,
            'role'=>$request->role,
            'password' => bcrypt($request->password)
          ]);
          if ($user->save()) {
            
            return redirect('app/user/list');
            // $pageConfigs = ['blankPage' => true];
            // return view('/content/authentication/auth-login-v1', ['pageConfigs' => $pageConfigs]);
            // return response()->json([
            //   'message' => 'Successfully created user!'
            // ], 201);
          } else {
            return response()->json(['error' => 'Provide proper details']);
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request)
    {
        try{
            $user_id=$request->id_user;
            $category = User::where('id',$user_id);
            $category->update([
                'name' => $request->name,
                'prenom' => $request->prenom, 
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => $request->role,
                ]);
            return redirect('app/user/list');
        }catch(\Exception $e) {
            return ($e->getMessage());
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::where('id',$request->id)->delete();
      
        return Response()->json('Success');
    }
}
