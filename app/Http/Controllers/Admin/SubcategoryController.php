<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Config;
use App\Admin\Subcategory;
use Session;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        
        return view('admin.subcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.subcategory.create');
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
                'title' => 'required|unique:subcategories'
                ]);
        $subcategory = Subcategory::create($request->all());

        // $subcategory->created_at = date('Y-m-d H:i:s');
        $subcategory->users_created = Session::get('id_user');
        $subcategory->save();

        if ($subcategory) {
            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Berhasil menyimpan $subcategory->name"
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
        $subcategory = Subcategory::find($id);
        return view('admin.subcategory.edit')->with(compact('subcategory'));
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
            'title' => 'required|unique:subcategories,id'
        ]);

        $post = $request->all();

        $subcategory = Subcategory::find($id);
        // $subcategory->update($request->all());
        $subcategory->title = $post['title'];
        $subcategory->description = $post['description'];
        $subcategory->updated_at = date('Y-m-d H:i:s');
        $subcategory->users_modified = Session::get('id_user');
        $subcategory->save();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $subcategory->title"
        ]);

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
        $subcategory = Subcategory::find($id);
        
        $subcategory->delete();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Data berhasil dihapus"
        ]);

        return redirect('subcategory');
    }

    public function getAllData(Request $request){
        $conditional = "";
        $requesttitle = $request->get('title');
        $querystringArray = ['title' => $requesttitle];
        
        $subcategory = DB::table('subcategories')
        ->where('title','like','%'.$requesttitle.'%')
        ->orderBy('id','desc')
        // ->paginate(1);
        ->paginate(Config::get('constants.limit_pagination_backend'));
        
        $subcategory->appends($querystringArray);
        // return response()->json($subcategory); 
        // return view('admin.subcategory.list', compact('subcategory'))->render();

        $returnHTML = view('admin.subcategory.list')->with('subcategory', $subcategory)->render();

        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }
}
