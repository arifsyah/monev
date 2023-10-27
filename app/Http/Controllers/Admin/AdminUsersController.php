<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Config;
use App\Admin;
use App\Admin\Logs;
use Session;
class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Session::get('role') != 1) {
            return redirect('/');
        }
        $conditional = "";
        $requestname = $request->get('name');
        $requestemail = $request->get('email');

        $querystringArray = ['name' => $requestname, 'email' => $requestemail];

        $admin = DB::table('admins')
        ->where('name','like','%'.$request->get('name').'%')
        ->where('email','like','%'.$request->get('email').'%')
        ->orderBy('id','desc')
        ->paginate(Config::get('constants.limit_pagination_backend'));
        
        $admin->appends($querystringArray);

        return view('admin.users.index',['admin'=>$admin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.users.create');
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
        $this->validate($request, [
                'name' => 'required|unique:admins'
                ,'email' => 'required|unique:admins'
                ,'password' => 'required'
                ,'password_confirmation' => 'required|same:password'
                ]);
        // $admin = Admin::create($request->all());
        $data = $request->all();
        $admin = Admin::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'status'=>$data['status'],
            'role'=>$data['role'],
            'password'=>bcrypt($data['password'])
        ]);

        if ($admin) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Menambahkan pengguna '.$request->name.' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Pengguna',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan $admin->name"
            ]);
        }
        

        return redirect()->route('users.create');
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
        $admin = Admin::find($id);
        $role = $admin->role;

        if (Session::get('role') != 1) {
            if ($id != Session::get('id_user')) {
                return redirect('/');
            }
        }

        return view('admin.users.edit')->with(compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function updatedata(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name' => 'required|unique:admins,id'
            ,'email' => 'required|unique:admins,id'
            ,'password_confirmation' => 'same:password'
        ]);

        $post = $request->all();

        $admin = Admin::find($id);
        // $admin->update($request->all());
        $admin->name = $post['name'];
        $admin->email = $post['email'];
        $admin->role = $post['role'];
        $admin->status = $post['status'];
        if ($post['password'] != '') {
            $admin->password = bcrypt($post['password']);
        }
        $admin->save();

        //insert Log
        $insertLog = Logs::create([
            'detail'=>'Mengubah pengguna '.$admin->name.' ',
            'id_user'=>Session::get('id_user'),
            'ip_address'=>$_SERVER['REMOTE_ADDR'],
            'module_name'=>'Pengguna',
            'created_at'=> date('Y-m-d H:i:s')
        ]);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $admin->title"
        ]);

        return redirect()->route('users.edit',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $admin = Admin::find($id);
        
        $admin->delete();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Admin berhasil dihapus"
        ]);

        return redirect('users');
    }

    public function delete($id){
        $admin = Admin::find($id);
        
        $admin->delete();

        //insert Log
        $insertLog = Logs::create([
            'detail'=>'Menghapus pengguna '.$admin->name.' ',
            'id_user'=>Session::get('id_user'),
            'ip_address'=>$_SERVER['REMOTE_ADDR'],
            'module_name'=>'Pengguna',
            'created_at'=> date('Y-m-d H:i:s')
        ]);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data berhasil dihapus"
        ]);

        return redirect('users');   
    }
}
