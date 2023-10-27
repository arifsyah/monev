<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Config;
use App\Admin\File;
use App\Admin\RelFileTag;
use App\Admin\Category;
use App\Admin\Tag;
use App\Admin\Logs;
use App\Admin\FileHistory;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Filesystem\FilesystemManager;

class FileController extends Controller
{
    //
    //
    public function index(Request $request)
    {
        //
        // return response()->download(storage_path('2021/09/23/2021_09_23_06_04_44_f7a323cb291fb568335864dafc4c988c.xlsx'));
        // $path = storage_path().'/files/2021/09/23/2021_09_23_06_04_44_f7a323cb291fb568335864dafc4c988c.xlsx';
        // echo $path;
        // if (file_exists($path)) {
        //     return Response::download($path);
        // }

        return view('admin.file.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.file.create');
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
        $this->validate($request, 
            ['title' => 'required','id_kategori' => 'required','path' => 'required'],
            ['title.required'=>'Silakan mengisi judul','id_kategori.required' => 'Silakan memilih Kategori','path.required' => 'Silakan memilih file']);
        if ($request['id_bidang'] == '') {
            $request['id_bidang'] = 0;
        }
        $file = File::create($request->except('path'));
        $id_file = $file->id;
        
        //input tag ke table
        $tags = $request->get('itemTag');
        $datatags = array();
        if ($tags != '' && count($tags) > 0) {
            foreach ($tags as $key => $value) {
               $datatags[] = array('id_files'=>$id_file , 'id_tag'=>$value);
               // $datatags[] = array();
            }

            $insertTag = RelFileTag::insert($datatags);
        }
        //end input tag

        if ($request->hasFile('path')) {
            $tmpName = $request->file('path')->getPathName(); 
            // list($width, $height, $type, $attr) = getimagesize($tmpName);
            $uploaded_file = $request->file('path');
            $extension = $uploaded_file->getClientOriginalExtension();

            $pathdir = date('Y/m/d');
            $path_create = storage_path() . DIRECTORY_SEPARATOR . 'files/'.$pathdir.'/';
            $exp = explode("/",$path_create);
            $way = '';
            foreach($exp as $n){
                $way .= $n.'/';
                @mkdir($way);       
            }

            $filename = Str::slug($request->title,'_').'_'.date('Y_m_d_H_i_s').'_'.md5(time()).'.'.$extension;
            $destinationPath = $path_create;
            $uploaded_file->move($destinationPath, $filename);
            // mengisi field cover di book dengan filename yang baru dibuat
            $file->path = $pathdir.'/'.$filename;
        }

        // $file->created_at = date('Y-m-d H:i:s');
        $file->users_created = Session::get('id_user');
        $file->save();

        if ($file) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Menambahkan File / Dokumen dengan nama '.$request->title.' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'File / Dokumen',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan $file->name"
            ]);
        }

        return redirect()->route('file.create');
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
        $id_tags = array();
        $string_tags = array();
        $string_tags_fix = '';
        $file = File::find($id);
        $data = $file->toArray();
        // echo "<pre>";
        // print_r($data);
        // die();
        $data['kategori'] = json_decode(json_encode(DB::table('categories')->where('id',$data['id_kategori'])->select('id','title')->first() ?? ''), true);
        $data['bidang'] = json_decode(json_encode(DB::table('bidang')->where('id',$data['id_bidang'])->select('id','title')->first() ?? ''), true);
        
        $getTags = DB::select("
            SELECT * FROM rel_files_tag WHERE id_files = '".$data['id']."'
        ");

        $getTagsArray = json_decode(json_encode($getTags), true);
        $data['tags'] = $getTagsArray;

        if (count($data['tags']) > 0) {
            foreach ($data['tags'] as $key => $value) {
                $data['tags'][$key]['detail'] = Tag::find($value,['title'])->first()->toArray();

                $id_tags[] = $value['id_tag'];
                
            }

            foreach ($data['tags'] as $key => $value) {
                $string_tags[] = $value['detail']['title'];
            }
        }
        
        $pathfile = storage_path() . DIRECTORY_SEPARATOR . 'files/' . $data['path'];
        $is_file_exists = 0;
        if (file_exists($pathfile)) {
            $is_file_exists = 1;
        }
        
        $id_tags_fix = implode(",", $id_tags);
        $string_tags_fix = implode(",", $string_tags);
        
        return view('admin.file.edit')->with(compact('file','data','id_tags_fix','string_tags_fix','pathfile','is_file_exists'));
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
            'title' => 'required|unique:files,id'
        ]);

        $post = $request->all();

        $file = File::find($id);
        
        $file_lama_id = $file->id;
        $file_lama_title = $file->title;
        $file_lama_description = $file->description;
        $file_lama_slug = $file->slug;
        $file_lama_created_at = $file->created_at;
        $file_lama_updated_at = $file->updated_at;
        $file_lama_users_created = $file->users_created;
        $file_lama_users_modified = $file->users_modified;
        $file_lama_path = $file->path;
        $file_lama_id_kategori = $file->id_kategori;
        $file_lama_tahun = $file->tahun;

        $file->title = $post['title'];
        $file->id_kategori = $post['id_kategori'];
        $file->description = $post['description'];
        $file->id_bidang = $post['id_bidang'];
        $file->tahun = $post['tahun'];
        $file->updated_at = date('Y-m-d H:i:s');
        $file->users_modified = Session::get('id_user');

        if ($request->hasFile('path')) {
            $tmpName = $request->file('path')->getPathName(); 
            // list($width, $height, $type, $attr) = getimagesize($tmpName);
            $uploaded_file = $request->file('path');
            $extension = $uploaded_file->getClientOriginalExtension();

            $pathdir = date('Y/m/d');
            $path_create = storage_path() . DIRECTORY_SEPARATOR . 'files/'.$pathdir.'/';
            $exp = explode("/",$path_create);
            $way = '';
            foreach($exp as $n){
                $way .= $n.'/';
                @mkdir($way);       
            }

            $filename = Str::slug($request->title,'_').'_'.date('Y_m_d_H_i_s').'_'.md5(time()).'.'.$extension;
            $destinationPath = $path_create;
            $uploaded_file->move($destinationPath, $filename);
            // mengisi field cover di book dengan filename yang baru dibuat
            $file->path = $pathdir.'/'.$filename;
        }

        $file->save();

        //input tag ke table
        $tags = $request->get('itemTag') ?? array();
        $datatags = array();
        //delete rel files tag
        DB::table('rel_files_tag')->where('id_files',$id)->delete();

        if (count($tags) > 0) {
            foreach ($tags as $key => $value) {
               $datatags[] = array('id_files'=>$id , 'id_tag'=>$value);
               // $datatags[] = array();
            }

            $insertTag = RelFileTag::insert($datatags);
        }

        if ($file) {
            //Insert File History
            $insertFileHistory = FileHistory::create([
                'title'=>$file_lama_title,
                'description'=>$file_lama_title,
                'slug'=>$file_lama_slug,
                'created_at'=>$file_lama_created_at,
                'updated_at'=> $file_lama_updated_at,
                'users_created'=> $file_lama_users_created,
                'users_modified'=> $file_lama_users_modified,
                'path'=> $file_lama_path,
                'id_kategori'=> $file_lama_id_kategori,
                'tahun'=> $file_lama_tahun,
                'id_file'=> $file_lama_id,
            ]);

            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Mengubah File/Dokumen menjadi '.$post['title'].' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'File/Dokumen',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan $file->title"
            ]);
        }

        return redirect()->route('file.edit',$id);
    }

    public function download(Request $request, $id){

        $file = File::find($id)->toArray();
        $path = storage_path().'/files/'.$file['path'];
        $infoPath = pathinfo($path);
        $extension = $infoPath['extension'];

        if ($extension == 'pdf' || $extension == 'PDF') {
            return Response::make(file_get_contents($path), 200, ['Content-Type'=> 'application/pdf','Content-Disposition' => 'inline; filename="'.$file['title'].'"']);
        }else{
            if (file_exists($path)) {
                //insert Log
                $insertLog = Logs::create([
                    'detail'=>'Mengunduh File / Dokumen dengan nama '.$file['title'].' ',
                    'id_user'=>Session::get('id_user'),
                    'ip_address'=>$_SERVER['REMOTE_ADDR'],
                    'module_name'=>'File / Dokumen',
                    'created_at'=> date('Y-m-d H:i:s')
                ]);

                return Response::download($path);
                // return response()->file($path);
            }else{
                return redirect('/');
            }
        }
    }

    public function downloadHistory(Request $request, $id){

        $filehistory = FileHistory::find($id)->toArray();
        $path = storage_path().'/files/'.$filehistory['path'];
        $infoPath = pathinfo($path);
        $extension = $infoPath['extension'];

        if ($extension == 'pdf' || $extension == 'PDF') {
            return Response::make(file_get_contents($path), 200, ['Content-Type'=> 'application/pdf','Content-Disposition' => 'inline; filename="'.$filehistory['title'].'"']);
        }else{
            if (file_exists($path)) {
                //insert Log
                $insertLog = Logs::create([
                    'detail'=>'Mengunduh File / Dokumen dengan nama '.$filehistory['title'].' ',
                    'id_user'=>Session::get('id_user'),
                    'ip_address'=>$_SERVER['REMOTE_ADDR'],
                    'module_name'=>'File / Dokumen',
                    'created_at'=> date('Y-m-d H:i:s')
                ]);

                return Response::download($path);
            }else{
                return redirect('/');
            }
        }
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
        $file = File::find($id);
        $path = $file->path;
        $title = $file->title;

        $files_history = FileHistory::where('id_file','=',$id)->get()->toArray();
        if (count($files_history) > 0) {
            foreach ($files_history as $key => $value) {
                if ($value['path'] != '') {
                    if (file_exists(storage_path().'/files/'.$value['path'])) {
                        @unlink(storage_path().'/files/'.$value['path']);
                    }
                }
            }
        }
        
        $rel_files_tag = DB::table('rel_files_tag')->where('id_files','=',$id);

        $rel_files_tag->delete();
        $file->delete();

        if ($path != '') {
            if (file_exists(storage_path().'/files/'.$path)) {
                @unlink(storage_path().'/files/'.$path);
            }
        }

        

        if ($file) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Menghapus File dengan judul = '.$title.' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'File',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Data berhasil dihapus"
            ]);
        }
        

        return redirect('file');
    }

    public function getAllData(Request $request){
        $conditional = "";
        $requesttitle = $request->get('title');
        $requestdescription = $request->get('description');
        $requestid_kategori = $request->get('id_kategori');
        $requestid_bidang = $request->get('id_bidang');
        $request_tahun = $request->get('tahun');
        $requestid_tag = $request->get('id_tag');
        $querystringArray = ['title' => $requesttitle,'id_kategori'=>$requestid_kategori,'description'=>$requestdescription,'tahun'=>$request_tahun,'id_tag'=>$requestid_tag,'id_bidang'=>$requestid_bidang];
       
        if ($requestid_tag != '') {
            $file = DB::table('files')->join('rel_files_tag','rel_files_tag.id_files','=','files.id')->where('rel_files_tag.id_tag','=',$requestid_tag)->orderBy('id','desc');
        }else{
            $file = DB::table('files')->orderBy('id','desc');
        }
        //check file history
     
        if ($requesttitle != '') {$file = $file->where('title','like','%'.$requesttitle.'%');}
        
        if ($requestdescription != '') {$file = $file->where('description','like','%'.$requestdescription.'%');}

        if ($requestid_kategori != '' && $requestid_kategori != 0) {$file = $file->where('id_kategori','=',$requestid_kategori);}

        if ($requestid_bidang != '' && $requestid_bidang != 0) {$file = $file->where('id_bidang','=',$requestid_bidang);}

        if ($request_tahun != '' && $request_tahun != 0) {$file = $file->where('tahun','=',$request_tahun);}


        $file = $file->paginate(Config::get('constants.limit_pagination_backend'));
        // $file = $file->paginate(1);

        $file->appends($querystringArray);
        

        //mengambil relasi
        if (count($file) > 0) {
            foreach ($file as $key => $value) {
                if (isset($value->users_created) && $value->users_created != '') {
                    $file[$key]->created =  $this->__getUsers($value->users_created);
                }

                if (isset($value->users_modified) && $value->users_modified != '') {
                    $file[$key]->modified =  $this->__getUsers($value->users_modified);
                }

                if (isset($value->id_kategori) && $value->id_kategori != '') {
                    $file[$key]->kategori =  $this->__getKategori($value->id_kategori);
                }

                if (isset($value->id_bidang) && $value->id_bidang != '') {
                    $file[$key]->bidang =  $this->__getBidang($value->id_bidang);
                }

                $file[$key]->jumlah_history = DB::table('files_history')->where('id_file','=',$value->id)->get()->count();
            }
        }
        
        $returnHTML = view('admin.file.list')->with('file', $file)->render();
        //getTag
        // $file = $this->__getTag($file);
        
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    private function __getUsers($id_user){
        return DB::table('admins')->select('name','email')->where('id','=',$id_user)->get()[0] ?? array();
    }

    private function __getKategori($id_kategori){
        return DB::table('categories')->select('title')->where('id','=',$id_kategori)->get()[0] ?? array();   
    }

    private function __getBidang($id_bidang){
        return DB::table('bidang')->select('title')->where('id','=',$id_bidang)->get()[0] ?? array();   
    }

    private function __getTag($data){
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                
                // $value->tags = $this->__getDetailTag($value->id);
            }
        }

        return $data;
        
    }

    public function getDetail(Request $requests){
        $id = $requests->id;
        $file = File::find($id)->toArray();

        if (count($file) > 0) {
            $file['created'] = DB::table('admins')->select('name','email')->where('id','=',$file['users_created'])->get()[0];
            
            if ($file['users_modified'] != '') {
                $file['modified'] = DB::table('admins')->select('name','email')->where('id','=',$file['users_modified'])->get()[0];
            }

            if (isset($file['id_kategori']) && $file['id_kategori'] != '') {
                $file['kategori'] =  $this->__getKategori($file['id_kategori']);
            }

            $file['tag'] = $this->__getDetailTag($id);
        }

        return response()->json($file);
    }

    public function getHistory(Request $request){
        $id = $request->id;
        $history_merge = [];
        $history = FileHistory::where('id_file','=',$id)->orderBy('id','desc')->get()->toArray();

        $file = File::where('id','=',$id)->get()->toArray()[0];
        if (count($file) > 0) {
            $file['created'] = DB::table('admins')->select('name','email')->where('id','=',$file['users_created'])->get()[0];
            
            if ($file['users_modified'] != '') {
                $file['modified'] = DB::table('admins')->select('name','email')->where('id','=',$file['users_modified'])->get()[0];
            }

            if (isset($file['id_kategori']) && $file['id_kategori'] != '') {
                $file['kategori'] =  $this->__getKategori($file['id_kategori']);
            }

            // $file['tag'] = $this->__getDetailTag($id);
        }
        // echo "<pre>";
        // print_r($file);
        // print_r($history);
        // die();
        $history_merge[0] = $file;
        foreach ($history as $key => $value) {
            if (isset($value['users_created']) && $value['users_created'] != '') {
                $history[$key]['created'] =  $this->__getUsers($value['users_created']);
            }

            if (isset($value['users_modified']) && $value['users_modified'] != '') {
                $history[$key]['modified'] =  $this->__getUsers($value['users_modified']);
            }

            if (isset($value['id_kategori']) && $value['id_kategori'] != '') {
                $history[$key]['kategori'] =  $this->__getKategori($value['id_kategori']);
            }

            $history[$key]['tag'] = $this->__getDetailTag($value['id']);
            $history_merge[$key + 1] = $history[$key];
        }
        

        return response()->json($history_merge);
    }

    private function __getDetailTag($id){
        $rel = DB::table('rel_files_tag')->select('id_tag')->where('id_files','=',$id)->get();

        if (count($rel) > 0) {
            foreach ($rel as $key => $value) {
                $rel[$key]->tagdetail = DB::table('tags')->select('title')->where('id','=',$value->id_tag)->get();
            }
        }

        return $rel;
    }

    public function dataSelect(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data =File::select("id","title")
                    ->where('title','LIKE',"%$search%")
                    ->get();
        }
        return response()->json($data);
    }

    public function organizeFile(){
        echo "asdasd";
        die();
    }
}
