<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Config;
use Validator;
use Response;
use App\Admin\Tag;
use App\Admin\Logs;
use App\Admin\Category;
use Session;

class TagController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        
        return view('admin.tag.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.tag.create');
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
                'title' => 'required|unique:tags'
                ]);
        $tag = Tag::create($request->all());

        // $tag->created_at = date('Y-m-d H:i:s');
        $tag->users_created = Session::get('id_user');
        $tag->save();

        if ($tag) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Menambahkan Tag dengan nama '.$request->title.' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Tag',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan $tag->name"
            ]);
        }
        
        return redirect()->route('tag.create');
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
        $tag = Tag::find($id);
        return view('admin.tag.edit')->with(compact('tag'));
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
            'title' => 'required|unique:tags,id'
        ]);

        $post = $request->all();

        $tag = Tag::find($id);
        // $tag->update($request->all());
        $tag->title = $post['title'];
        $tag->description = $post['description'];
        $tag->updated_at = date('Y-m-d H:i:s');
        $tag->users_modified = Session::get('id_user');
        $tag->save();

        if ($tag) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Mengubah Tag menjadi '.$post['title'].' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Tag',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan $tag->title"
            ]);
        }

        return redirect()->route('tag.edit',$id);
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
        $tag = Tag::find($id);
        
        $tag->delete();

        if ($tag) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Menghapus Tag dengan judul = '.$tag->title.' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Tag',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Data berhasil dihapus"
            ]);
        }
        return redirect('tag');
    }

    public function getAllData(Request $request){
        $conditional = "";
        $requesttitle = $request->get('title');
        $querystringArray = ['title' => $requesttitle];

        $tag = DB::table('tags')
        ->where('title','like','%'.$requesttitle.'%')
        ->orderBy('id','desc')
        // ->paginate(1);
        ->paginate(Config::get('constants.limit_pagination_backend'));
        
        $tag->appends($querystringArray);

        if (count($tag) > 0) {
            foreach ($tag as $key => $value) {
                if (isset($value->users_created) && $value->users_created != '') {
                    $tag[$key]->created =  $this->__getUsers($value->users_created);
                }

                if (isset($value->users_modified) && $value->users_modified != '') {
                    $tag[$key]->modified =  $this->__getUsers($value->users_modified);
                }
            }
        }

        // return response()->json($tag); 
        // return view('admin.tag.list', compact('tag'))->render();

        $returnHTML = view('admin.tag.list')->with('tag', $tag)->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public function dataSelect(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Tag::select("id","title")
                    ->where('title','LIKE',"%$search%")
                    ->get();
        }else{
            $data = Tag::select("id","title")->limit(10)->get();
        }

        foreach ($data as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->title];
        }

        return response()->json($formatted_tags);
    }

    public function dataSelectSingle(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data =Tag::select("id","title")
                    ->where('title','LIKE',"%$search%")
                    ->get();
        }else{
            $data =Tag::select("id","title")->get();
        }
        return response()->json($data);
    }

    public function getDetail(Request $requests){
        $id = $requests->id;
        $tag = Tag::find($id)->toArray();

        if (count($tag) > 0) {
            $tag['created'] = DB::table('admins')->select('name','email')->where('id','=',$tag['users_created'])->get()[0];
            if ($tag['users_modified'] != '') {
                $tag['modified'] = DB::table('admins')->select('name','email')->where('id','=',$tag['users_modified'])->get()[0];
            }
        }

        return response()->json($tag);
    }

    private function __getUsers($id_user){
        return DB::table('admins')->select('name','email')->where('id','=',$id_user)->get()[0];
    }

    public function createPopup(Request $request){
        $validate = Validator::make($request->all(), [
                'title' => 'required|unique:tags'
                ]);

        if ($validate->fails()) {    
            return Response::json(array(
                'success' => false,
                'errors' => $validate->getMessageBag()->toArray()

            ), 400);
        }

        $category = Tag::create($request->all());

        // $category->created_at = date('Y-m-d H:i:s');
        $category->users_created = Session::get('id_user');
        $category->save();

        if ($category) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Menambahkan Tag dengan nama '.$request->title.' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Tag',
                'created_at'=> date('Y-m-d H:i:s')
            ]);
        }

        return Response::json(array(
            'success' => true,
            'errors' => ''
        ), 200);
    }
}
