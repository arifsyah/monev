<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use Response;
use Config;
use App\Admin\Program;
use App\Admin\Kegiatan;
use App\Admin\Subkegiatan;
use App\Admin\Logs;
use Session;
use Illuminate\Support\Str;

class SubkegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.subkegiatan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.subkegiatan.create');
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
            'title' => 'required|unique:subkegiatan'
            ]);
            
        $slug = Str::slug($request->title);
        $request['slug'] = $slug;
        $subkegiatan = Subkegiatan::create($request->all());

        // $subkegiatan->created_at = date('Y-m-d H:i:s');
        $subkegiatan->users_created = Session::get('id_user');
        $subkegiatan->save();

        if ($subkegiatan) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Menambahkan Subkegiatan dengan nama '.$request->title.' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Subkegiatan',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan $subkegiatan->name"
            ]);
        }
        
        return redirect()->route('subkegiatan.create');
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
        $subkegiatan = Subkegiatan::find($id);
        $data = $subkegiatan->toArray();

        return view('admin.subkegiatan.edit')->with(compact('subkegiatan','data'));
    }

    public function updatedata(Request $request, $id)
    {
        //
        $this->validate($request, [
            'title' => 'required|unique:subkegiatan,id'
            // ,'id_program' => 'required'
        ]);
        $slug = Str::slug($request->title);
        $request['slug'] = $slug;
        $post = $request->all();

        $subkegiatan = SubKegiatan::find($id);
        // $subkegiatan->update($request->all());
        $subkegiatan->title = $post['title'];
        $subkegiatan->description = $post['description'];
        // $subkegiatan->id_program = $post['id_program'];
        $subkegiatan->slug = Str::slug($subkegiatan->title);
        $subkegiatan->updated_at = date('Y-m-d H:i:s');
        $subkegiatan->users_modified = Session::get('id_user');
        $subkegiatan->save();

        if ($subkegiatan) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Mengubah Sub Kegiatan menjadi '.$post['title'].' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Sub Kegiatan',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan $subkegiatan->title"
            ]);
        }


        return redirect()->route('subkegiatan.edit',$id);
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

        $subkegiatan = DB::table('subkegiatan')
        ->where('title','like','%'.$requesttitle.'%')
        ->orWhere('description','like','%'.$requesttitle.'%')
        ->orderBy('id','desc')
        // ->paginate(1);
        ->paginate(Config::get('constants.limit_pagination_backend'));
        
        $subkegiatan->appends($querystringArray);
        
        if (count($subkegiatan) > 0) {
            foreach ($subkegiatan as $key => $value) {
                if (isset($value->users_created) && $value->users_created != '') {
                    $subkegiatan[$key]->created =  $this->__getUsers($value->users_created);
                }

                if (isset($value->users_modified) && $value->users_modified != '') {
                    $subkegiatan[$key]->modified =  $this->__getUsers($value->users_modified);
                }
            }
        }
        
        $returnHTML = view('admin.subkegiatan.list')->with('subkegiatan', $subkegiatan)->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public function delete($id){
        $subkegiatan = Subkegiatan::find($id);
        
        $subkegiatan->delete();

        if ($subkegiatan) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Menghapus Subkegiatan dengan judul = '.$subkegiatan->title.' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Subkegiatan',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Data berhasil dihapus"
            ]);
        }
        return redirect('subkegiatan');
    }

    public function getDetail(Request $requests){
        $id = $requests->id;
        $subkegiatan = Subkegiatan::find($id)->toArray();
        
        $program = Program::all();
        $program = json_decode(json_encode($program), true);

        $kegiatan = Kegiatan::all();
        $kegiatan = json_decode(json_encode($kegiatan), true);
        
        if (count($subkegiatan) > 0) {
            $subkegiatan['attr'] = json_decode(json_encode(DB::table('subkegiatan_attr')->where('id_subkegiatan','=',$id)->get()), true);
            if(count($subkegiatan['attr']) > 0){
                foreach ($subkegiatan['attr'] as $key => $value) {
                    $subkegiatan['attr'][$key]['kegiatan'] = json_decode(json_encode(DB::table('kegiatan')->where('id','=',$value['id_kegiatan'])->first()), true);
                    $subkegiatan['attr'][$key]['program'] = json_decode(json_encode(DB::table('program')->where('id','=',$value['id_program'])->first()), true);
                }
            }
        }
        
        return response()->json(array(['subkegiatan'=>$subkegiatan,'kegiatan'=>$kegiatan,'program'=>$program]) );
    }

    public function dataSelect(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Subkegiatan::select("id","title")
                    ->where('title','LIKE',"%$search%")
                    ->get();
        }else{
            $data = Subkegiatan::select("id","title")->take(10)->get();
        }
        return response()->json($data);
    }

    private function __getUsers($id_user){
        return DB::table('admins')->select('name','email')->where('id','=',$id_user)->get()[0];
    }

    public function storeDetail(Request $request){
        $data = $request->all();
        $id_program = $data['id_program_modal'];
        $id_kegiatan = $data['id_kegiatan_modal'];
        $id_subkegiatan = $data['id_subkegiatan_modal'];
        $this->validate($request, [
            'tahun' => 'required'
            ,'indikator_subkegiatan' => 'required'
            ,'target_subkegiatan' => 'required'
            ,'satuan_subkegiatan' => 'required'
            ,'target_subkegiatan_tw_1' => 'required'
            ,'target_subkegiatan_tw_2' => 'required'
            ,'target_subkegiatan_tw_3' => 'required'
            ,'target_subkegiatan_tw_4' => 'required'
            ]);

        $check = DB::select('SELECT COUNT(id) as jumlah 
            FROM subkegiatan_attr 
            WHERE tahun = "'.$data['tahun'].'" AND id_subkegiatan = "'.$data['id_subkegiatan_modal'].'" AND id_program = "'.$id_program.'" AND id_kegiatan = "'.$id_kegiatan.'" ');
        $check = $check[0]->jumlah;
        
        if($check > 0){
            return Response::json(array('data'=>array(),'status'=>'failed'));
        }else{
            $data['indikator'] = $request['indikator_subkegiatan'];
            $data['satuan'] = $request['satuan_subkegiatan'];
            $data['target_tw_1'] = $request['target_subkegiatan_tw_1'];
            $data['target_tw_2'] = $request['target_subkegiatan_tw_2'];
            $data['target_tw_3'] = $request['target_subkegiatan_tw_3'];
            $data['target_tw_4'] = $request['target_subkegiatan_tw_4'];
            $data['id_subkegiatan'] = $request['id_subkegiatan_modal'];
            $data['id_kegiatan'] = $request['id_kegiatan_modal'];
            $data['id_program'] = $request['id_program_modal'];
            $data['target'] = $request['target_subkegiatan'];
            $data['users_created'] = Session::get('id_user');
            
            unset($data['indikator_subkegiatan']);
            unset($data['satuan_subkegiatan']);
            unset($data['target_subkegiatan_tw_1']);
            unset($data['target_subkegiatan_tw_2']);
            unset($data['target_subkegiatan_tw_3']);
            unset($data['target_subkegiatan_tw_4']);
            unset($data['id_kegiatan_modal']);
            unset($data['target_subkegiatan']);
            unset($data['id_program_modal']);
            unset($data['id_subkegiatan_modal']);
            
            $insert = DB::table('subkegiatan_attr')->insert($data);
            if($insert){
                //insert Log
                $insertLog = Logs::create([
                    'detail'=>'Menambahkan Kinerja Sub Kegiatan',
                    'id_user'=>Session::get('id_user'),
                    'ip_address'=>$_SERVER['REMOTE_ADDR'],
                    'module_name'=>'Kinerja Sub Kegiatan',
                    'created_at'=> date('Y-m-d H:i:s')
                ]);
                $status = 200;
                Session::flash("flash_notification", [
                    "level"=>"success",
                    "message"=>"Berhasil menambahkan kinerja sub kegiatan"
                ]);

                return Response::json(array('data'=>array(),'status'=>'success'));
            }else{
                return Response::json(array('data'=>array(),'status'=>'failed'));
            }
        }
    }

    public function getdetailkinerja(Request $requests){
        $id = $requests->id;
        $attr = DB::table('subkegiatan_attr')->where('id','=',$id)->first();
        $attr = json_decode(json_encode($attr), true);
        $attr['program'] = json_decode(json_encode(DB::table('program')->where('id','=',$attr['id_program'])->first()), true);
        $attr['kegiatan'] = json_decode(json_encode(DB::table('kegiatan')->where('id','=',$attr['id_kegiatan'])->first()), true);
        
        if(count($attr)){
            return Response::json(array('message'=>'success','data'=>$attr,'status'=>'success'));
        }else{
            return Response::json(array('message'=>'failed','data'=>array(),'status'=>'failed'));
        }
        
    }

    public function deleteKinerja(Request $requests){
        $id_kinerja = $requests->id_kinerja;
        $delete = DB::table('subkegiatan_attr')->where('id', $id_kinerja)->delete();
        if($delete){
            return Response::json(array('message'=>'success','status'=>'success'));
        }else{
            return Response::json(array('message'=>'failed','status'=>'failed'));
        }
    }

    public function editDetail(Request $requests){
        $data = $requests->all();
        $id = $data['id_edit'];
        $this->validate($requests, [
            'tahunedit' => 'required'
            ,'indikator_subkegiatan_edit' => 'required'
            ,'target_subkegiatan_edit' => 'required'
            ,'satuan_subkegiatan_edit' => 'required'
            ,'target_subkegiatan_tw_1_edit' => 'required'
            ,'target_subkegiatan_tw_2_edit' => 'required'
            ,'target_subkegiatan_tw_3_edit' => 'required'
            ,'target_subkegiatan_tw_4_edit' => 'required'
            ]);
        
        $update = DB::table('subkegiatan_attr')->where('id','=',$id)->update(array(
            'tahun'=>$requests['tahunedit']
            , 'indikator'=>$requests['indikator_subkegiatan_edit']
            , 'target'=>$requests['target_subkegiatan_edit']
            , 'satuan'=>$requests['satuan_subkegiatan_edit']
            , 'target_tw_1'=>$requests['target_subkegiatan_tw_1_edit']
            , 'target_tw_2'=>$requests['target_subkegiatan_tw_2_edit']
            , 'target_tw_3'=>$requests['target_subkegiatan_tw_3_edit']
            , 'target_tw_4'=>$requests['target_subkegiatan_tw_4_edit']

        ));
        if($update){
            return Response::json(array('message'=>'success','data'=>array(),'status'=>'success'));
        }else{
            return Response::json(array('message'=>'failed','data'=>array(),'status'=>'failed'));
        }
    }
}
