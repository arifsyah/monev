<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use Response;
use Config;
use App\Admin\Program;
use App\Admin\Logs;
use Session;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.program.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.program.create');
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
            'title' => 'required|unique:program'
            ]);
        $slug = Str::slug($request->title);
        $request['slug'] = $slug;
        $program = Program::create($request->all());

        // $program->created_at = date('Y-m-d H:i:s');
        $program->users_created = Session::get('id_user');
        $program->save();

        if ($program) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Menambahkan Program dengan nama '.$request->title.' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Program',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan $program->name"
            ]);
        }
        
        return redirect()->route('program.create');
    }

    public function storeDetail(Request $request){
        $data = $request->all();
        $this->validate($request, [
            'tahun' => 'required'
            ,'indikator_program' => 'required'
            ,'target_program' => 'required'
            ,'satuan_program' => 'required'
            ,'target_program_tw_1' => 'required'
            ,'target_program_tw_2' => 'required'
            ,'target_program_tw_3' => 'required'
            ,'target_program_tw_4' => 'required'
            ]);

        $check = DB::select('SELECT COUNT(id) as jumlah 
            FROM program_attr 
            WHERE tahun = "'.$data['tahun'].'" AND id_program = "'.$data['id_program_modal'].'" ');
        $check = $check[0]->jumlah;
        
        if($check > 0){
            return Response::json(array('data'=>array(),'status'=>'failed'));
        }else{
            $data['indikator'] = $request['indikator_program'];
            $data['satuan'] = $request['satuan_program'];
            $data['target_tw_1'] = $request['target_program_tw_1'];
            $data['target_tw_2'] = $request['target_program_tw_2'];
            $data['target_tw_3'] = $request['target_program_tw_3'];
            $data['target_tw_4'] = $request['target_program_tw_4'];
            $data['id_program'] = $request['id_program_modal'];
            $data['target'] = $request['target_program'];
            $data['users_created'] = Session::get('id_user');
            
            unset($data['indikator_program']);
            unset($data['satuan_program']);
            unset($data['target_program_tw_1']);
            unset($data['target_program_tw_2']);
            unset($data['target_program_tw_3']);
            unset($data['target_program_tw_4']);
            unset($data['id_program_modal']);
            unset($data['target_program']);
            
            $insert = DB::table('program_attr')->insert($data);
            if($insert){
                //insert Log
                $insertLog = Logs::create([
                    'detail'=>'Menambahkan Kinerja Program',
                    'id_user'=>Session::get('id_user'),
                    'ip_address'=>$_SERVER['REMOTE_ADDR'],
                    'module_name'=>'Kinerja Program',
                    'created_at'=> date('Y-m-d H:i:s')
                ]);
                $status = 200;
                Session::flash("flash_notification", [
                    "level"=>"success",
                    "message"=>"Berhasil menambahkan kinerja program"
                ]);

                return Response::json(array('data'=>array(),'status'=>'success'));
            }else{
                return Response::json(array('data'=>array(),'status'=>'failed'));
            }
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
        $program = Program::find($id);
        return view('admin.program.edit')->with(compact('program'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatedata(Request $request, $id)
    {
        //
        $this->validate($request, [
            'title' => 'required|unique:program,id'
        ]);

        $post = $request->all();

        $program = Program::find($id);
        // $program->update($request->all());
        $program->title = $post['title'];
        $program->description = $post['description'];
        $program->slug = Str::slug($program->title);
        $program->updated_at = date('Y-m-d H:i:s');
        $program->users_modified = Session::get('id_user');
        $program->save();

        if ($program) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Mengubah Program menjadi '.$post['title'].' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Program',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan $program->title"
            ]);
        }


        return redirect()->route('program.edit',$id);
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

        $program = DB::table('program')
        ->where('title','like','%'.$requesttitle.'%')
        ->orWhere('description','like','%'.$requesttitle.'%')
        ->orderBy('id','desc')
        // ->paginate(1);
        ->paginate(Config::get('constants.limit_pagination_backend'));
        
        $program->appends($querystringArray);
        
        if (count($program) > 0) {
            foreach ($program as $key => $value) {
                if (isset($value->users_created) && $value->users_created != '') {
                    $program[$key]->created =  $this->__getUsers($value->users_created);
                }

                if (isset($value->users_modified) && $value->users_modified != '') {
                    $program[$key]->modified =  $this->__getUsers($value->users_modified);
                }
            }
        }
        
        $returnHTML = view('admin.program.list')->with('program', $program)->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }


    public function delete($id){
        $program = Program::find($id);
        
        $program->delete();

        if ($program) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Menghapus Program dengan judul = '.$program->title.' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Program',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Data berhasil dihapus"
            ]);
        }
        return redirect('program');
    }

    public function getDetail(Request $requests){
        $id = $requests->id;
        $program = Program::find($id)->toArray();

        if (count($program) > 0) {
            $program['attr'] = json_decode(json_encode(DB::table('program_attr')->where('id_program','=',$id)->get()), true);
        }

        return response()->json($program);
    }

    public function dataSelect(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Program::select("id","title")
                    ->where('title','LIKE',"%$search%")
                    ->get();
        }else{
            $data = Program::select("id","title")->take(10)->get();
        }
        return response()->json($data);
    }

    private function __getUsers($id_user){
        return DB::table('admins')->select('name','email')->where('id','=',$id_user)->get()[0];
    }

    public function editDetail(Request $requests){
        $data = $requests->all();
        $id = $data['id_edit'];
        $this->validate($requests, [
            'tahunedit' => 'required'
            ,'indikator_program_edit' => 'required'
            ,'target_program_edit' => 'required'
            ,'satuan_program_edit' => 'required'
            ,'target_program_tw_1_edit' => 'required'
            ,'target_program_tw_2_edit' => 'required'
            ,'target_program_tw_3_edit' => 'required'
            ,'target_program_tw_4_edit' => 'required'
            ]);
        
        $update = DB::table('program_attr')->where('id','=',$id)->update(array(
            'tahun'=>$requests['tahunedit']
            , 'indikator'=>$requests['indikator_program_edit']
            , 'target'=>$requests['target_program_edit']
            , 'satuan'=>$requests['satuan_program_edit']
            , 'target_tw_1'=>$requests['target_program_tw_1_edit']
            , 'target_tw_2'=>$requests['target_program_tw_2_edit']
            , 'target_tw_3'=>$requests['target_program_tw_3_edit']
            , 'target_tw_4'=>$requests['target_program_tw_4_edit']

        ));
        if($update){
            return Response::json(array('message'=>'success','data'=>array(),'status'=>'success'));
        }else{
            return Response::json(array('message'=>'failed','data'=>array(),'status'=>'failed'));
        }
    }

    public function getdetailkinerja(Request $requests){
        $id = $requests->id;
        $attr = DB::table('program_attr')->where('id','=',$id)->first();
        $attr = json_decode(json_encode($attr), true);
        if(count($attr)){
            return Response::json(array('message'=>'success','data'=>$attr,'status'=>'success'));
        }else{
            return Response::json(array('message'=>'failed','data'=>array(),'status'=>'failed'));
        }
        
    }

    public function deleteKinerja(Request $requests){
        $id_kinerja = $requests->id_kinerja;
        $delete = DB::table('program_attr')->where('id', $id_kinerja)->delete();
        if($delete){
            return Response::json(array('message'=>'success','status'=>'success'));
        }else{
            return Response::json(array('message'=>'failed','status'=>'failed'));
        }
    }
}
