<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use Response;
use Config;
use App\Admin\Kegiatan;
use App\Admin\Program;
use App\Admin\Logs;
use Session;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.kegiatan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.kegiatan.create');
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
            'title' => 'required|unique:kegiatan'
            // ,'id_program' => 'required'
            ]);
            
        $slug = Str::slug($request->title);
        $request['slug'] = $slug;
        $kegiatan = Kegiatan::create($request->all());

        // $kegiatan->created_at = date('Y-m-d H:i:s');
        $kegiatan->users_created = Session::get('id_user');
        $kegiatan->save();

        if ($kegiatan) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Menambahkan Kegiatan dengan nama '.$request->title.' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Kegiatan',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan $kegiatan->name"
            ]);
        }
        
        return redirect()->route('kegiatan.create');
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
        $kegiatan = Kegiatan::find($id);
        $data = $kegiatan->toArray();

        // $data['program'] = json_decode(json_encode(DB::table('program')->where('id',$data['id_program'])->select('id','title')->first() ?? ''), true);

        return view('admin.kegiatan.edit')->with(compact('kegiatan','data'));
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
            'title' => 'required|unique:kegiatan,id'
            // ,'id_program' => 'required'
        ]);
        $slug = Str::slug($request->title);
        $request['slug'] = $slug;
        $post = $request->all();

        $kegiatan = Kegiatan::find($id);
        // $kegiatan->update($request->all());
        $kegiatan->title = $post['title'];
        $kegiatan->description = $post['description'];
        // $kegiatan->id_program = $post['id_program'];
        $kegiatan->slug = Str::slug($kegiatan->title);
        $kegiatan->updated_at = date('Y-m-d H:i:s');
        $kegiatan->users_modified = Session::get('id_user');
        $kegiatan->save();

        if ($kegiatan) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Mengubah Kegiatan menjadi '.$post['title'].' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Kegiatan',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan $kegiatan->title"
            ]);
        }


        return redirect()->route('kegiatan.edit',$id);
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

    public function getAllData(Request $request){
        $conditional = "";
        $requesttitle = $request->get('title');
        $querystringArray = ['title' => $requesttitle];

        $kegiatan = DB::table('kegiatan')
        ->where('title','like','%'.$requesttitle.'%')
        ->orWhere('description','like','%'.$requesttitle.'%')
        ->orderBy('id','desc')
        // ->paginate(1);
        ->paginate(Config::get('constants.limit_pagination_backend'));
        
        $kegiatan->appends($querystringArray);
        
        if (count($kegiatan) > 0) {
            foreach ($kegiatan as $key => $value) {
                if (isset($value->users_created) && $value->users_created != '') {
                    $kegiatan[$key]->created =  $this->__getUsers($value->users_created);
                }

                if (isset($value->users_modified) && $value->users_modified != '') {
                    $kegiatan[$key]->modified =  $this->__getUsers($value->users_modified);
                }
            }
        }
        
        $returnHTML = view('admin.kegiatan.list')->with('kegiatan', $kegiatan)->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public function delete($id){
        $kegiatan = Kegiatan::find($id);
        
        $kegiatan->delete();

        if ($kegiatan) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Menghapus Kegiatan dengan judul = '.$kegiatan->title.' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Kegiatan',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Data berhasil dihapus"
            ]);
        }
        return redirect('kegiatan');
    }

    public function getDetail(Request $requests){
        $id = $requests->id;
        $kegiatan = Kegiatan::find($id)->toArray();
        $program = Program::all();
        $program = json_decode(json_encode($program), true);

        if (count($kegiatan) > 0) {
            $kegiatan['attr'] = json_decode(json_encode(DB::table('kegiatan_attr')->where('id_kegiatan','=',$id)->get()), true);
            if(count($kegiatan['attr']) > 0){
                foreach ($kegiatan['attr'] as $key => $value) {
                    $kegiatan['attr'][$key]['program'] = json_decode(json_encode(DB::table('program')->where('id','=',$value['id_program'])->first()), true);
                }
            }
        }
        // echo '<pre>';
        // print_r($kegiatan);
        // echo '</pre>';
        // die();
        return response()->json(array(['kegiatan'=>$kegiatan,'program'=>$program]));
    }

    public function storeDetail(Request $request){
        $data = $request->all();
        $id_program = $data['id_program_modal'];
        $this->validate($request, [
            'tahun' => 'required'
            ,'indikator_kegiatan' => 'required'
            ,'target_kegiatan' => 'required'
            ,'satuan_kegiatan' => 'required'
            ,'target_kegiatan_tw_1' => 'required'
            ,'target_kegiatan_tw_2' => 'required'
            ,'target_kegiatan_tw_3' => 'required'
            ,'target_kegiatan_tw_4' => 'required'
            ]);

        $check = DB::select('SELECT COUNT(id) as jumlah 
            FROM kegiatan_attr 
            WHERE tahun = "'.$data['tahun'].'" AND id_kegiatan = "'.$data['id_kegiatan_modal'].'" AND id_program = "'.$id_program.'" ');
        $check = $check[0]->jumlah;

        if($check > 0){
            return Response::json(array('data'=>array(),'status'=>'failed'));
        }else{
            $data['indikator'] = $request['indikator_kegiatan'];
            $data['satuan'] = $request['satuan_kegiatan'];
            $data['target_tw_1'] = $request['target_kegiatan_tw_1'];
            $data['target_tw_2'] = $request['target_kegiatan_tw_2'];
            $data['target_tw_3'] = $request['target_kegiatan_tw_3'];
            $data['target_tw_4'] = $request['target_kegiatan_tw_4'];
            $data['id_kegiatan'] = $request['id_kegiatan_modal'];
            $data['id_program'] = $request['id_program_modal'];
            $data['target'] = $request['target_kegiatan'];
            $data['users_created'] = Session::get('id_user');
            
            unset($data['indikator_kegiatan']);
            unset($data['satuan_kegiatan']);
            unset($data['target_kegiatan_tw_1']);
            unset($data['target_kegiatan_tw_2']);
            unset($data['target_kegiatan_tw_3']);
            unset($data['target_kegiatan_tw_4']);
            unset($data['id_kegiatan_modal']);
            unset($data['target_kegiatan']);
            unset($data['id_program_modal']);
            
            $insert = DB::table('kegiatan_attr')->insert($data);
            if($insert){
                //insert Log
                $insertLog = Logs::create([
                    'detail'=>'Menambahkan Kinerja Kegiatan',
                    'id_user'=>Session::get('id_user'),
                    'ip_address'=>$_SERVER['REMOTE_ADDR'],
                    'module_name'=>'Kinerja Kegiatan',
                    'created_at'=> date('Y-m-d H:i:s')
                ]);
                $status = 200;
                Session::flash("flash_notification", [
                    "level"=>"success",
                    "message"=>"Berhasil menambahkan kinerja kegiatan"
                ]);

                return Response::json(array('data'=>array(),'status'=>'success'));
            }else{
                return Response::json(array('data'=>array(),'status'=>'failed'));
            }
        }
    }

    public function editDetail(Request $requests){
        $data = $requests->all();
        $id = $data['id_edit'];
        $this->validate($requests, [
            'tahunedit' => 'required'
            ,'indikator_kegiatan_edit' => 'required'
            ,'target_kegiatan_edit' => 'required'
            ,'satuan_kegiatan_edit' => 'required'
            ,'target_kegiatan_tw_1_edit' => 'required'
            ,'target_kegiatan_tw_2_edit' => 'required'
            ,'target_kegiatan_tw_3_edit' => 'required'
            ,'target_kegiatan_tw_4_edit' => 'required'
            ]);
        
        $update = DB::table('kegiatan_attr')->where('id','=',$id)->update(array(
            'tahun'=>$requests['tahunedit']
            , 'indikator'=>$requests['indikator_kegiatan_edit']
            , 'target'=>$requests['target_kegiatan_edit']
            , 'satuan'=>$requests['satuan_kegiatan_edit']
            , 'target_tw_1'=>$requests['target_kegiatan_tw_1_edit']
            , 'target_tw_2'=>$requests['target_kegiatan_tw_2_edit']
            , 'target_tw_3'=>$requests['target_kegiatan_tw_3_edit']
            , 'target_tw_4'=>$requests['target_kegiatan_tw_4_edit']

        ));
        if($update){
            return Response::json(array('message'=>'success','data'=>array(),'status'=>'success'));
        }else{
            return Response::json(array('message'=>'failed','data'=>array(),'status'=>'failed'));
        }
    }

    public function dataSelect(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Kegiatan::select("id","title")
                    ->where('title','LIKE',"%$search%")
                    ->get();
        }else{
            $data = Kegiatan::select("id","title")->take(10)->get();
        }
        return response()->json($data);
    }

    private function __getUsers($id_user){
        return DB::table('admins')->select('name','email')->where('id','=',$id_user)->get()[0];
    }

    public function getdetailkinerja(Request $requests){
        $id = $requests->id;
        $attr = DB::table('kegiatan_attr')->where('id','=',$id)->first();
        $attr = json_decode(json_encode($attr), true);
        $attr['program'] = json_decode(json_encode(DB::table('program')->where('id','=',$attr['id_program'])->first()), true);

        if(count($attr)){
            return Response::json(array('message'=>'success','data'=>$attr,'status'=>'success'));
        }else{
            return Response::json(array('message'=>'failed','data'=>array(),'status'=>'failed'));
        }
        
    }

    public function deleteKinerja(Request $requests){
        $id_kinerja = $requests->id_kinerja;
        $delete = DB::table('kegiatan_attr')->where('id', $id_kinerja)->delete();
        if($delete){
            return Response::json(array('message'=>'success','status'=>'success'));
        }else{
            return Response::json(array('message'=>'failed','status'=>'failed'));
        }
    }
}
