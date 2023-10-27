<?php
namespace App\Http\Controllers;
use App\Admin;
use App\Mail\SendEmail;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon; 
use DB;
use App\Admin\Logs;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    public function getAdminLogin()
    {
        
        if (auth()->guard('admin')->user()) return redirect()->route('admin.dashboard');
        return view('adminLogin');
    }
    public function adminAuth(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required',
            'password' => 'required',
        ]);
        
        if (auth()->guard('admin')->attempt(['nip' => $request->input('nip'), 'password' => $request->input('password'), 'status' => 1]))
        {
            //insert Log
            $insertLog = Logs::create([
                'detail'=>'User '.auth()->guard('admin')->user()->name.' melakukan Login ',
                'id_user'=>auth()->guard('admin')->user()->id,
                'ip_address'=>$_SERVER['REMOTE_ADDR'],
                'module_name'=>'Login',
                'created_at'=> date('Y-m-d H:i:s')
            ]);

            Session::put('id_user', auth()->guard('admin')->user()->id);
            Session::put('role', auth()->guard('admin')->user()->role);
            Session::put('name', auth()->guard('admin')->user()->name);
            return redirect()->route('admin.dashboard');
        }else{


            Session::flash("flash_notification", [
                "level"=>"error",
                "message"=>"Gagal Login, Silakan periksa kembali nip dan password"
            ]);
            return redirect('/login');
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('login');
    }

    public function forgotPassword(Request $request){

        return view('admin.forgotpassword');
    }

    public function forgotPasswordPost(Request $request){
        $email = $request->email;
        
        $this->validate($request,[
            'email' => 'required|email',
        ]);

        $token = str_random(64);
        $getuser = DB::table('admins')->where('email',$email)->get()->first();
        
        if (empty($getuser)) {
            return redirect()->route('forgotpassword')->with(['message'=>'User dengan email tersebut tidak ditemukan','status'=>'error']);
        }else{
            DB::table('password_resets')->insert(
              ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
            );

            // Mail::to('arifsyah11@gmail.com')->send(new SendEmail($data));
            // return view('admin.forgotpassword');
            Mail::send('email.email', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password Notification');
            });    

            return redirect()->route('forgotpassword')->with(['message'=>'Silakan cek email anda','status'=>'success']);
        }
        
    }

    public function resetPassword(Request $request, $token = ''){
        $getuser = DB::table('password_resets')->where('token',$token)->get()->first();
        if (empty($getuser)) {
            return redirect('login');
        }

        return view('admin.resetpassword',['token'=>$token]);
    }

    public function resetPasswordPost(Request $request){
        $password = $request->get('password');
        $password_confirmation = $request->get('password_confirmation');
        $token = $request->token;
        $rules = [
            'password' => 'min:6|required|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ];

        $customMessages = [
            'required'=> 'Silakan melengkapi form',
            'same' => 'password dan konfirmasi password harus sama'
        ];

        // $this->validate($request, [
        //     'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
        //     'password_confirmation' => 'min:6|required'
        // ]);

        // $validate = $this->validate($request, $rules, $customMessages);
        $validate = Validator::make($request->all(), $rules, $customMessages);
        if ($validate->fails()) {
            return redirect()->route('resetpassword', ['token' => $token])->withErrors($validate)->withInput();;
            // return view('admin.resetpassword',['token'=>$token]);
        }else{
            $getEmail = DB::table('password_resets')->where('token',$token)->get()->first();
            $email = $getEmail->email;

            $getUser = DB::table('admins')->where('email',$email)->get()->first();
            $iduser = $getUser->id;

            $doUpdate = DB::table('admins')->where('id',$iduser)->update(['password'=>bcrypt($password)]);
            if ($doUpdate) {
                //delete password resets
                DB::table('password_resets')->where('token',$token)->delete();
            }

            $request->session()->flash('success_reset_password', 'Berhasil mengubah password anda, Silakan Login');
            $request->session()->flash('status_reset_password', 1);
            return redirect('login');
        }
    }

    public function setPassword(Request $request){
        return view('admin.setpassword');
    }
}