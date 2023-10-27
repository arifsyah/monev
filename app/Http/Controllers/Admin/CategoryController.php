<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use Response;
use Config;
use App\Admin\Category;
use App\Admin\Logs;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.category.create');
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
                'title' => 'required|unique:categories'
                ]);
        $category = Category::create($request->all());

        // $category->created_at = date('Y-m-d H:i:s');
        $category->users_created = Session::get('id_user');
        $category->save();

        if ($category) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Menambahkan Kategori dengan nama '.$request->title.' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Kategori',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan $category->name"
            ]);
        }
        
        return redirect()->route('category.create');
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
        $category = Category::find($id);
        return view('admin.category.edit')->with(compact('category'));
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
            'title' => 'required|unique:categories,id'
        ]);

        $post = $request->all();

        $category = Category::find($id);
        // $category->update($request->all());
        $category->title = $post['title'];
        $category->description = $post['description'];
        $category->updated_at = date('Y-m-d H:i:s');
        $category->users_modified = Session::get('id_user');
        $category->save();

        if ($category) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Mengubah Kategori menjadi '.$post['title'].' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Kategori',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan $category->title"
            ]);
        }


        return redirect()->route('category.edit',$id);
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
        $category = Category::find($id);
        
        $category->delete();

        if ($category) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Menghapus Kategori dengan judul = '.$category->title.' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Kategori',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Data berhasil dihapus"
            ]);
        }

        

        return redirect('category');
    }

    public function getAllData(Request $request){
        $conditional = "";
        $requesttitle = $request->get('title');
        $querystringArray = ['title' => $requesttitle];

        $category = DB::table('categories')
        ->where('title','like','%'.$requesttitle.'%')
        ->orWhere('description','like','%'.$requesttitle.'%')
        ->orderBy('id','desc')
        // ->paginate(1);
        ->paginate(Config::get('constants.limit_pagination_backend'));
        
        $category->appends($querystringArray);
        if (count($category) > 0) {
            foreach ($category as $key => $value) {
                if (isset($value->users_created) && $value->users_created != '') {
                    $category[$key]->created =  $this->__getUsers($value->users_created);
                }

                if (isset($value->users_modified) && $value->users_modified != '') {
                    $category[$key]->modified =  $this->__getUsers($value->users_modified);
                }
            }
        }
        
        // return response()->json($category); 
        // return view('admin.category.list', compact('category'))->render();
        
        $returnHTML = view('admin.category.list')->with('category', $category)->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }

    public function getDetail(Request $requests){
        $id = $requests->id;
        $category = Category::find($id)->toArray();

        if (count($category) > 0) {
            $category['created'] = DB::table('admins')->select('name','email')->where('id','=',$category['users_created'])->get()[0];
            if ($category['users_modified'] != '') {
                $category['modified'] = DB::table('admins')->select('name','email')->where('id','=',$category['users_modified'])->get()[0];
            }
        }

        return response()->json($category);
    }

    public function dataSelect(Request $request){
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Category::select("id","title")
                    ->where('title','LIKE',"%$search%")
                    ->get();
        }else{
            $data = Category::select("id","title")->take(10)->get();
        }
        return response()->json($data);
    }

    public function user() {
        // return $this->belongsTo('App\User','users_created');
    }   

    private function __getUsers($id_user){
        return DB::table('admins')->select('name','email')->where('id','=',$id_user)->get()[0];
    }

    public function createPopup(Request $request){
        $validate = Validator::make($request->all(), [
                'title' => 'required|unique:categories'
                ]);

        if ($validate->fails()) {    
            return Response::json(array(
                'success' => false,
                'errors' => $validate->getMessageBag()->toArray()

            ), 400);
        }

        $category = Category::create($request->all());

        // $category->created_at = date('Y-m-d H:i:s');
        $category->users_created = Session::get('id_user');
        $category->save();

        if ($category) {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'Menambahkan Kategori dengan nama '.$request->title.' ',
                'id_user'=>Session::get('id_user'),
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Kategori',
                'created_at'=> date('Y-m-d H:i:s')
            ]);
        }

        return Response::json(array(
            'success' => true,
            'errors' => ''
        ), 200);
    }
}
