<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use Response;
use Config;
use App\Admin\Bidang;
use App\Admin\Logs;
use Session;

class UnitKerjaController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        
        return view('admin.bidang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.bidang.create');
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
                'title' => 'required|unique:bidang'
                ]);
        $bidang = Bidang::create($request->all());

        // $bidang->created_at = date('Y-m-d H:i:s');
        $bidang->users_created = Session::get('id_user');
        $bidang->save();

        if ($bidang) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Menambahkan Unit Kerja dengan nama '.$request->title.' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Unit Kerja',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan $bidang->name"
            ]);
        }
        
        return redirect()->route('unit_kerja.create');
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
        $bidang = Bidang::find($id);
        return view('admin.bidang.edit')->with(compact('bidang'));
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

    public function updatedata(Request $request, $id){
        //
        $this->validate($request, [
            'title' => 'required|unique:bidang,id'
        ]);

        $post = $request->all();

        $bidang = Bidang::find($id);
        // $bidang->update($request->all());
        $bidang->title = $post['title'];
        $bidang->description = $post['description'];
        $bidang->updated_at = date('Y-m-d H:i:s');
        $bidang->users_modified = Session::get('id_user');
        $bidang->save();

        if ($bidang) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Mengubah Unit Kerja menjadi '.$post['title'].' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Unit Kerja',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan $bidang->title"
            ]);
        }


        return redirect()->route('unit_kerja.edit',$id);
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
    }

    public function delete($id){
        $bidang = Bidang::find($id);
        
        $bidang->delete();

        if ($bidang) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Menghapus Unit Kerja dengan judul = '.$bidang->title.' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Unit Kerja',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Data berhasil dihapus"
            ]);
        }

        

        return redirect('unit_kerja');
    }

    public function getAllData(Request $request){
        $conditional = "";
        $requesttitle = $request->get('title');
        $querystringArray = ['title' => $requesttitle];

        $bidang = DB::table('bidang')
        ->where('title','like','%'.$requesttitle.'%')
        ->orWhere('description','like','%'.$requesttitle.'%')
        ->orderBy('id','desc')
        // ->paginate(1);
        ->paginate(Config::get('constants.limit_pagination_backend'));
        
        $bidang->appends($querystringArray);
        
        if (count($bidang) > 0) {
            foreach ($bidang as $key => $value) {
                if (isset($value->users_created) && $value->users_created != '') {
                    $bidang[$key]->created =  $this->__getUsers($value->users_created);
                }

                if (isset($value->users_modified) && $value->users_modified != '') {
                    $bidang[$key]->modified =  $this->__getUsers($value->users_modified);
                }
            }
        }
        // return response()->json($bidang); 
        // return view('admin.bidang.list', compact('bidang'))->render();
        
        $returnHTML = view('admin.bidang.list')->with('bidang', $bidang)->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public function getDetail(Request $requests){
        $id = $requests->id;
        $bidang = Bidang::find($id)->toArray();

        if (count($bidang) > 0) {
            $bidang['created'] = DB::table('admins')->select('name','email')->where('id','=',$bidang['users_created'])->get()[0];
            if ($bidang['users_modified'] != '') {
                $bidang['modified'] = DB::table('admins')->select('name','email')->where('id','=',$bidang['users_modified'])->get()[0];
            }
        }

        return response()->json($bidang);
    }

    public function dataSelect(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Bidang::select("id","title")
                    ->where('title','LIKE',"%$search%")
                    ->get();
        }else{
            $data = Bidang::select("id","title")->take(10)->get();
        }
        return response()->json($data);
    }

    public function user() {
        // return $this->belongsTo('App\User','users_created');
    }   

    private function __getUsers($id_user){
        return DB::table('admins')->select('name','email')->where('id','=',$id_user)->get()[0];
    }
}
