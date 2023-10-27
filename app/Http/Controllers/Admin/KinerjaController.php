<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use Response;
use Config;
use App\Admin\Kinerja;
use App\Admin\Program;
use App\Admin\Logs;
use Session;
use Illuminate\Support\Str;

class KinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.kinerja.index');
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
    public function store($tahun,Request $request)
    {
        //
        $this->validate($request, [
            'id_program' => 'required'
            ,'indikator_program' => 'required'
            ,'target_program' => 'required'
            ,'satuan_program' => 'required'
            ,'target_program_tw_1' => 'required'
            ,'target_program_tw_2' => 'required'
            ,'target_program_tw_3' => 'required'
            ,'target_program_tw_4' => 'required'
            ,'id_kegiatan' => 'required'
            ,'indikator_kegiatan' => 'required'
            ,'target_kegiatan' => 'required'
            ,'satuan_kegiatan' => 'required'
            ,'target_kegiatan_tw_1' => 'required'
            ,'target_kegiatan_tw_2' => 'required'
            ,'target_kegiatan_tw_3' => 'required'
            ,'target_kegiatan_tw_4' => 'required'
            ,'id_subkegiatan' => 'required'
            ,'indikator_subkegiatan' => 'required'
            ,'target_subkegiatan' => 'required'
            ,'satuan_subkegiatan' => 'required'
            ,'target_subkegiatan_tw_1' => 'required'
            ,'target_subkegiatan_tw_2' => 'required'
            ,'target_subkegiatan_tw_3' => 'required'
            ,'target_subkegiatan_tw_4' => 'required'
            ]);
        $data = $request->all();
        unset($data['_token']);
        $data['users_created'] = Session::get('id_user');
        $data['tahun'] = $tahun;
        $insert = Kinerja::create($data);
        if ($insert) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Menambahkan Kinerja dengan id '.$insert->id.' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Kinerja',
                'created_at'=> date('Y-m-d H:i:s')
            ]);
            $status = 200;
            return Response::json(array('data'=>$insert,'status'=>'success'));
        }else{
            return Response::json(array('data'=>'','status'=>'failed'));
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

    public function capaian($tahun)
    {
        //
        // $program = Program::with('kinerja')->get();
        // $program = DB::table('program')->join('kinerja','program.id','=','kinerja.id_program')->get();
        $program = json_decode(json_encode(DB::table('program')->select('*','program_attr.id as id_attr')->join('program_attr','program.id','=','program_attr.id_program')->where('program_attr.tahun','=',$tahun)->get()), true);
        
        if(count($program) > 0){
            foreach ($program as $key => $value) {
                $program[$key]['kegiatan'] = json_decode(json_encode(
                    DB::table('kegiatan')->select('*','kegiatan.title as title','program.title as nama_program','kegiatan_attr.id as id_attr')
                    ->join('kegiatan_attr','kegiatan.id','=','kegiatan_attr.id_kegiatan')
                    ->join('program','program.id','=','kegiatan_attr.id_program')
                    ->where('kegiatan_attr.tahun','=',$tahun)
                    ->where('kegiatan_attr.id_program','=',$value['id_program'])
                    ->get()),true);

                if(count($program[$key]['kegiatan'])>0){
                    foreach ($program[$key]['kegiatan'] as $key2 => $value2) {
                        $program[$key]['kegiatan'][$key2]['subkegiatan'] = json_decode(json_encode(
                            DB::table('subkegiatan')->select('*','subkegiatan.title as title','program.title as nama_program','kegiatan.title as nama_kegiatan','subkegiatan_attr.id as id_attr')
                            ->join('subkegiatan_attr','subkegiatan.id','=','subkegiatan_attr.id_subkegiatan')
                            ->join('program','program.id','=','subkegiatan_attr.id_program')
                            ->join('kegiatan','kegiatan.id','=','subkegiatan_attr.id_kegiatan')
                            ->where('subkegiatan_attr.tahun','=',$tahun)
                            ->where('subkegiatan_attr.id_kegiatan','=',$value2['id_kegiatan'])
                            ->get()),true);
                    }
                }
            }
        }
        
        return view('admin.kinerja.capaian')->with(compact('tahun','program'));
    }

    public function getRealisasiProgram(Request $request){
        $data = $request->all();
        $id = $data['id'];
        $detail = DB::table('program_attr')->where('id','=',$id)->get();
        
        return Response::json(array('message'=>'success','data'=>json_decode(json_encode($detail),true),'status'=>'success'));
    }

    public function editRealisasiProgram(Request $request){
        $data = $request->all();

        $update = DB::table('program_attr')->where('id','=',$data['id_program_attr_modal'])
        ->update(array(
            'realisasi'=>$data['realisasi_program_tahunan']
            ,'realisasi_tw_1'=>$data['realisasi_program_tw_1']
            ,'realisasi_tw_2'=>$data['realisasi_program_tw_2']
            ,'realisasi_tw_3'=>$data['realisasi_program_tw_3']
            ,'realisasi_tw_4'=>$data['realisasi_program_tw_4']
        ));
    }

    public function getRealisasiKegiatan(Request $request){
        $data = $request->all();
        $id = $data['id'];
        $detail = DB::table('kegiatan_attr')->where('id','=',$id)->get();
        
        return Response::json(array('message'=>'success','data'=>json_decode(json_encode($detail),true),'status'=>'success'));
    }

    public function editRealisasiKegiatan(Request $request){
        $data = $request->all();

        $update = DB::table('kegiatan_attr')->where('id','=',$data['id_kegiatan_attr_modal'])
        ->update(array(
            'realisasi'=>$data['realisasi_kegiatan_tahunan']
            ,'realisasi_tw_1'=>$data['realisasi_kegiatan_tw_1']
            ,'realisasi_tw_2'=>$data['realisasi_kegiatan_tw_2']
            ,'realisasi_tw_3'=>$data['realisasi_kegiatan_tw_3']
            ,'realisasi_tw_4'=>$data['realisasi_kegiatan_tw_4']
        ));
    }
    
    public function getRealisasiSubKegiatan(Request $request){
        $data = $request->all();
        $id = $data['id'];
        $detail = DB::table('subkegiatan_attr')->where('id','=',$id)->get();
        
        return Response::json(array('message'=>'success','data'=>json_decode(json_encode($detail),true),'status'=>'success'));
    }

    public function editRealisasiSubKegiatan(Request $request){
        $data = $request->all();

        $update = DB::table('subkegiatan_attr')->where('id','=',$data['id_subkegiatan_attr_modal'])
        ->update(array(
            'realisasi'=>$data['realisasi_subkegiatan_tahunan']
            ,'realisasi_tw_1'=>$data['realisasi_subkegiatan_tw_1']
            ,'realisasi_tw_2'=>$data['realisasi_subkegiatan_tw_2']
            ,'realisasi_tw_3'=>$data['realisasi_subkegiatan_tw_3']
            ,'realisasi_tw_4'=>$data['realisasi_subkegiatan_tw_4']
        ));
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
}
