<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Admin\File;

class AdminController extends Controller
{
    public function dashboard(){
        $data = File::selectRaw('year(created_at) year, DATE(created_at) date, count(*) value')
                ->groupBy('year', 'date')
                ->orderBy('year', 'desc')
                ->get()->take(30)->toArray();
        $data = json_encode($data);
        
        $jumlah = DB::table('files')->count();
        $jumlah_user = DB::table('admins')->where('status','=','1')->count();
        // $user = ;
        if (auth()->guard('admin')->user()) {

            $file = DB::table('files')->orderBy('created_at','desc')->take(5)->get()->toArray();
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
            
            return view('admin.dashboard2')->with(compact('file','jumlah','jumlah_user','data'));
            # code...
        }else{
            return redirect('login');
        }
        
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
}  