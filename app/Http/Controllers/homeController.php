<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use App\student;
use App\teacher;
use App\admin;
use Exception;
use DB;

class homeController extends Controller
{
    public function home(){
        return view('home');
    }
    public function about(){
        return view('about');
    }
    public function logreg(){
        return view('logreg');
    }
    public function logreg_admin(){
        return view('admin-logreg');
    }
    public function prosesregister(request $r){
        $validator = Validator::make($r->all(),[
            'fullname' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        if($validator->fails()){
            Session::flash('alert_warning','Form uncompletely filled');
            return redirect('/logreg');
        }
        else if($r->password != $r->confirm_password){
            Session::flash('alert_warning','Password confirmation does not match');
            return redirect('/logreg');
        }
        else{
            if($r->kategori == "teacher"){
                $email = DB::table('teachers')->where('email','like','%'.$r->email.'%')->count();
                if($email > 0){
                    Session::flash('alert_warning','Email has been registered, please use another email');
                    return redirect('/logreg');
                }
                else{
                try{
                $create = teacher::create([
                    'level' => $r->kategori,
                    'nama' => $r->fullname,
                    'email' => $r->email,
                    'password' => md5($r->password)
                ]);
                Session::flash('alert_success','Register Success');
                return redirect('/logreg');
                }
                catch(\Exception $e){
                    $message = $e->getMessage();
                    Session::flash('alert_warning',$message);
                    return redirect('/logreg');
                }
            }
        }
            else{
                $email = DB::table('students')->where('email','like','%'.$r->email.'%')->count();
                if($email > 0){
                    Session::flash('alert_warning','Email has been registered, please use another email');
                    return redirect('/logreg');
                }
                else{
                try{
                $create = student::create([
                    'level' => $r->kategori,
                    'nama' => $r->fullname,
                    'email' => $r->email,
                    'password' => md5($r->password)
                ]);
                Session::flash('alert_success','Register Success');
                return redirect('/logreg');
                }
                catch(\Exception $e){
                    $message = $e->getMessage();
                    Session::flash('alert_warning',$message);
                    return redirect('/logreg');
                }
                }
            }
        }
    }
    public function prosesregisteradmin(request $r){
        $validator = Validator::make($r->all(),[
            'fullname' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        if($validator->fails()){
            Session::flash('alert_warning','Form uncompletely filled');
            return redirect('/logreg-admin');
        }
        else if($r->password != $r->confirm_password){
            Session::flash('alert_warning','Password confirmation does not match');
            return redirect('/logreg-admin');
        }
        else{
            $email = DB::table('admin')->where('email','like','%'.$r->email.'%')->count();
            if($email > 0){
                Session::flash('alert_warning','Email has been registered, please use another email');
                return redirect('/logreg-admin');
            }
            else{
            try{
            $create = admin::create([
                'level' => "admin",
                'nama' => $r->fullname,
                'email' => $r->email,
                'password' => md5($r->password)
            ]);
            Session::flash('alert_success','Register Success');
            return redirect('/logreg-admin');
            }
            catch(\Exception $e){
                $message = $e->getMessage();
                Session::flash('alert_warning',$message);
                return redirect('/logreg-admin');
            }
            }
        }
    }
    public function proseslogin(request $r){
        $validator = Validator::make($r->all(),[
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        if($validator->fails()){
            Session::flash('alert_warning','Form uncompletely filled');
            return redirect('/logreg');
        }
        else{
            if($r->kategori == 'teacher'){
            try{
                $login = teacher::where('email',$r->email)->where('password',md5($r->password));
                if($login->count() > 0){
                    $data = $login->first();
                    Session::put('id_user',$data->id);
                    Session::put('email_user',$data->email);
                    Session::put('fullname_user',$data->nama);
                    Session::put('level_user',$data->level);
                    Session::put('login_status',true);
                    return redirect('/home-teacher');
                }
                else{
                    Session::flash('alert_warning','Wrong email or password');
                    return redirect('/logreg');
                }
            }
            catch(\Exception $e){
                $message = $e->getMessage();
                    Session::flash('alert_warning',$message);
                    return redirect('/logreg');
            }
            }
            else{
                try{
                    $login = student::where('email',$r->email)->where('password',md5($r->password));
                    if($login->count() > 0){
                        $data = $login->first();
                        Session::put('id_user',$data->id);
                        Session::put('email_user',$data->email);
                        Session::put('fullname_user',$data->nama);
                        Session::put('level_user',$data->level);
                        Session::put('login_status',true);
                        return redirect('/home-student');
                    }
                    else{
                        Session::flash('alert_warning','Wrong email or password');
                        return redirect('/logreg');
                    }
                }
                catch(\Exception $e){
                    $message = $e->getMessage();
                        Session::flash('alert_warning',$message);
                        return redirect('/logreg');
                }
            }
        }
    }
    public function prosesloginadmin(request $r){
        $validator = Validator::make($r->all(),[
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        if($validator->fails()){
            Session::flash('alert_warning','Form uncompletely filled');
            return redirect('/logreg-admin');
        }
        else{
            try{
                $login = admin::where('email',$r->email)->where('password',md5($r->password));
                if($login->count() > 0){
                    $data = $login->first();
                    Session::put('id_user',$data->id);
                    Session::put('email_user',$data->email);
                    Session::put('fullname_user',$data->nama);
                    Session::put('level_user',$data->level);
                    Session::put('login_status',true);
                    return redirect('/home-admin');
                }
                else{
                    Session::flash('alert_warning','Wrong email or password');
                    return redirect('/logreg-admin');
                }
            }
            catch(\Exception $e){
                $message = $e->getMessage();
                    Session::flash('alert_warning',$message);
                    return redirect('/logreg-admin');
            }
        }
    }
    public function logout(){
        Session::flush();
        return redirect('/home');
    }
}
