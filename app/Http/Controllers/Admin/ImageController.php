<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Config;
use App\Admin\Image;
use App\Admin\Logs;
use Session;
use Jaykeren\ImageMoo\Facades\ImageMoo;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $conditional = "";
        $requestnama = $request->get('nama');
        $querystringArray = ['nama' => $requestnama];

        $image = DB::table('images')
        ->where('nama','like','%'.$requestnama.'%')
        ->orderBy('id','desc')
        ->paginate(Config::get('constants.limit_pagination_backend'));
        
        $image->appends($querystringArray);

        return view('admin.image.index',['image'=>$image]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'nama' => 'required',
                'path' => 'image|max:2048'
                ]);
        
        $image = Image::create($request->except('path'));

        if ($request->hasFile('path')) {

            $tmpName = $request->file('path')->getPathName(); 
            list($width, $height, $type, $attr) = getimagesize($tmpName);
            # Rasio Ukuran Images #
            $rasio = $width/Config::get("constants.width_resize");
            // Mengambil file yang diupload
            $uploaded_cover = $request->file('path');
            // mengambil extension file
            $extension = $uploaded_cover->getClientOriginalExtension();
            // membuat nama file random berikut extension
            $pathdir = date('Y/m/d');

            $path_create = public_path() . DIRECTORY_SEPARATOR . 'images/'.$pathdir.'/';
            $exp = explode("/",$path_create);
            $way = '';
            foreach($exp as $n){
                $way .= $n.'/';
                @mkdir($way);       
            }
            
            $width_resize = Config::get("constants.width_resize");
            $x1 = $request->get('x1');
            $x2 = $request->get('x2');
            $y1 = $request->get('y1');
            $y2 = $request->get('y2');

            $filename = date('Y_m_d_H_i_s').'_'.md5(time()).'.'.$extension;
            // menyimpan cover ke folder public/img
            $destinationPath = $path_create;
            $uploaded_cover->move($destinationPath, $filename);
            // mengisi field cover di book dengan filename yang baru dibuat
            $image->path = $pathdir.'/'.$filename;

            //crop 
            $source = $destinationPath.$filename;
            $thepath = public_path() . DIRECTORY_SEPARATOR . 'images/crop/'.$pathdir.'/';
            $exp2 = explode("/",$thepath);
            $way2 ='';
            foreach($exp2 as $n){
                $way2.=$n.'/';
                @mkdir($way2);       
            }

            $des_path =  $thepath.$filename;
            $xx1 = $x1 * $rasio;
            $yy1 = $y1 * $rasio;
            $xx2 = $x2 * $rasio;
            $yy2 = $y2 * $rasio;

            if($des_path !=''){
                ImageMoo::load($source)
                     ->crop($xx1,$yy1,$xx2,$yy2)
                     ->save($des_path);
            }
            //endcrop

            //resize crop
            $image_dimension = Config::get('constants.image_dimension');
            if (count($image_dimension) > 0) {
                $thepath_thumb = public_path() . DIRECTORY_SEPARATOR . 'images/thumb/'.$pathdir.'/';

                $exp3 = explode("/",$thepath_thumb);
                $way3 ='';
                foreach($exp3 as $n){
                    $way3.=$n.'/';
                    @mkdir($way3);       
                }

                $exp_file = explode('.', $filename, 2);
                foreach ($image_dimension as $key => $value) {
                    $size_file = explode('x',$value);
                    $file_final_name_resize = $exp_file[0].'_'.$value.'_thumb.'.$exp_file[1];
                    $des_path_resize =  $thepath_thumb.$file_final_name_resize;

                    ImageMoo::load($des_path)
                    ->stretch($size_file[0],$size_file[1])
                    ->save($des_path_resize);
                }
            }
        }

        // $image->created_at = date('Y-m-d H:i:s');
        $image->users_created = Session::get('id_user');
        $image->save();

        if ($image) {
            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan $image->nama"
            ]);
        }
        
        return redirect()->route('image.create');
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
        $image = Image::find($id);
        return view('admin.image.edit')->with(compact('image'));
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
            'nama' => 'required',
            'path' => 'image|max:2048'
        ]);
        
        $post = $request->except('path');

        $image = Image::find($id);
        // $image->update($request->all());
        $image->nama = $post['nama'];
        $image->description = $post['description'];

        $image->updated_at = date('Y-m-d H:i:s');
        $image->users_updated = Session::get('id_user');

        if ($request->hasFile('path')) {

            $imageoldpath = $image->path;
            if ($imageoldpath != '') {
                if (file_exists(public_path().'/images/'.$imageoldpath)) {
                    @unlink(public_path().'/images/'.$imageoldpath);
                }

                if (file_exists(public_path().'/images/crop/'.$imageoldpath)) {
                    @unlink(public_path().'/images/crop/'.$imageoldpath);
                }

                $exp_file_old = explode(".",$imageoldpath);

                foreach (Config::get('constants.image_dimension') as $key => $value) {
                    $pathdel = public_path().'/images/thumb/'.$exp_file_old[0]."_".$value."_thumb.".$exp_file_old[1];
                    
                    if (file_exists($pathdel)) {
                        @unlink($pathdel);
                    }
                }

            }

            $tmpName = $request->file('path')->getPathName(); 
            list($width, $height, $type, $attr) = getimagesize($tmpName);
            # Rasio Ukuran Images #
            $rasio = $width/Config::get("constants.width_resize");
            // Mengambil file yang diupload
            $uploaded_cover = $request->file('path');
            // mengambil extension file
            $extension = $uploaded_cover->getClientOriginalExtension();
            // membuat nama file random berikut extension
            $pathdir = date('Y/m/d');

            $path_create = public_path() . DIRECTORY_SEPARATOR . 'images/'.$pathdir.'/';
            $exp = explode("/",$path_create);
            $way = '';
            foreach($exp as $n){
                $way .= $n.'/';
                @mkdir($way);       
            }

            $width_resize = Config::get("constants.width_resize");
            $x1 = $request->get('x1');
            $x2 = $request->get('x2');
            $y1 = $request->get('y1');
            $y2 = $request->get('y2');

            $filename = date('Y_m_d_H_i_s').'_'.md5(time()).'.'.$extension;
            // menyimpan cover ke folder public/img
            $destinationPath = $path_create;
            $uploaded_cover->move($destinationPath, $filename);
            // mengisi field cover di book dengan filename yang baru dibuat
            $image->path = $pathdir.'/'.$filename;

            //crop 
            $source = $destinationPath.$filename;
            $thepath = public_path() . DIRECTORY_SEPARATOR . 'images/crop/'.$pathdir.'/';
            $exp2 = explode("/",$thepath);
            $way2 ='';
            foreach($exp2 as $n){
                $way2.=$n.'/';
                @mkdir($way2);       
            }

            $des_path =  $thepath.$filename;
            $xx1 = $x1 * $rasio;
            $yy1 = $y1 * $rasio;
            $xx2 = $x2 * $rasio;
            $yy2 = $y2 * $rasio;

            if($des_path !=''){
                ImageMoo::load($source)
                     ->crop($xx1,$yy1,$xx2,$yy2)
                     ->save($des_path);
            }
            //endcrop

            //resize crop
            $image_dimension = Config::get('constants.image_dimension');
            if (count($image_dimension) > 0) {
                $thepath_thumb = public_path() . DIRECTORY_SEPARATOR . 'images/thumb/'.$pathdir.'/';

                $exp3 = explode("/",$thepath_thumb);
                $way3 ='';
                foreach($exp3 as $n){
                    $way3.=$n.'/';
                    @mkdir($way3);       
                }

                $exp_file = explode('.', $filename, 2);
                foreach ($image_dimension as $key => $value) {
                    $size_file = explode('x',$value);
                    $file_final_name_resize = $exp_file[0].'_'.$value.'_thumb.'.$exp_file[1];
                    $des_path_resize =  $thepath_thumb.$file_final_name_resize;

                    ImageMoo::load($des_path)
                    ->stretch($size_file[0],$size_file[1])
                    ->save($des_path_resize);
                }
            }
        }

        $image->save();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $image->nama"
        ]);

        return redirect()->route('image.edit',$id);
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
        $image = Image::find($id);
        $imageoldpath = $image->path;
        if ($imageoldpath != '') {
            if (file_exists(public_path().'/images/'.$imageoldpath)) {
                @unlink(public_path().'/images/'.$imageoldpath);
            }

            if (file_exists(public_path().'/images/crop/'.$imageoldpath)) {
                @unlink(public_path().'/images/crop/'.$imageoldpath);
            }

            $exp_file_old = explode(".",$imageoldpath);

            foreach (Config::get('constants.image_dimension') as $key => $value) {
                $pathdel = public_path().'/images/thumb/'.$exp_file_old[0]."_".$value."_thumb.".$exp_file_old[1];
                
                if (file_exists($pathdel)) {
                    @unlink($pathdel);
                }
            }

        }

        $image->delete();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data berhasil dihapus"
        ]);

        return redirect('image');
    }

    public function viewlist($id_gambar = '',Request $request){

        // $image = Image::find($id);
        $conditional = "";
        $requestnama = $request->get('nama');
        $querystringArray = ['nama' => $requestnama];

        $image = DB::table('images')
        ->where('nama','like','%'.$requestnama.'%')
        ->orderBy('id','desc')
        ->paginate(Config::get('constants.limit_pagination_backend')) ;
        
        $image->appends($querystringArray);

        return view('admin.image.viewlist',['image'=>$image]);
    }

    public function getDetailImage(Request $request){
        $id = $request->get('id');
        $image = Image::find($id);
        $returnarray = array('id'=>$image->id,'path'=>$image->path);
        return json_encode($returnarray) ;
    }
}
