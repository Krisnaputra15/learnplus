<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Hash;
use DB;
use Validator;
use Illuminate\Support\Facades\File;
use App\admin;
use App\student;
use App\teacher;
use App\classes;
use App\topics;
use App\data_topik;
use App\data_murid;
use App\attachment_guru;
use App\attachment_murid;

class adminController extends Controller
{
    public function home(){
        $classes = classes::all();
        $forcount = classes::count();
        return view('admin.home',compact('classes','forcount'));
    }
    public function dashboard(){
        $profile = admin::where('id',Session::get('id_user'))->first();
        return view('admin.dashboard',compact('profile'));
    }
    public function editprofile($id){
        $profile = admin::where('id',$id)->first();
        return view('admin.editprofile',compact('profile'));
    }
    public function editprofileprocess(request $r,$id){
        $admin = admin::where('id',$id)->first();
        $path = '/upload/profile_picture/admin';
        if($r->hasFile('picture')){
            if($r->old_password != null && $admin->password == md5($r->old_password)){
                if($r->new_password != $r->password_confirmation){
                    Session::flash('alert_warning',"Password confirmation doesn't match with new password");
                    return redirect('/admin-'.$r->id_user.'-edit');
                }
                $file = $r->file('picture');
                $filename = $file->getClientOriginalName();
                $file->move(public_path($path),$filename);
                $update = admin::where('id',$id)->update([
                    'nama' => $r->fullname,
                    'email' => $r->email,
                    'password' => md5($r->new_password),
                    'about_urself' => $r->about_urself,
                    'picture' => $filename
                ]);
                Session::flash('alert_success',"Your data have been updated succesfully");
                return redirect('/dashboard-admin');
            }
            else{
                $file = $r->file('picture');
                $filename = $file->getClientOriginalName();
                $file->move(public_path($path),$filename);
                $update = admin::where('id',$id)->update([
                    'nama' => $r->fullname,
                    'email' => $r->email,
                    'about_urself' => $r->about_urself,
                    'picture' => $filename
                ]);
                Session::flash('alert_success',"Your data have been updated succesfully");
                return redirect('/dashboard-admin');
            }
        }
        else{
            if($r->old_password != null && md5($admin->password) == $r->old_password){
                if($r->new_password != $r->password_confirmation){
                    Session::flash('alert_warning',"Password confirmation doesn't match with new password");
                    return redirect('/admin-'.$r->id_user.'-edit');
                }
                $update = admin::where('id',$id)->update([
                    'nama' => $r->fullname,
                    'email' => $r->email,
                    'password' => md5($r->new_password),
                    'about_urself' => $r->about_urself,
                ]);
                Session::flash('alert_success',"Your data have been updated succesfully");
                return redirect('/dashboard-admin');
            }
            else{
                $update = admin::where('id',$id)->update([
                    'nama' => $r->fullname,
                    'email' => $r->email,
                    'about_urself' => $r->about_urself,
                ]);
                Session::flash('alert_success',"Your data have been updated succesfully");
                return redirect('/dashboard-admin');
            }
        }
    }
    public function makeclass(){
        $teacher = teacher::all();
        return view('admin.makeclass',compact('teacher'));
    }
    public function makeclassprocess(request $r){
        $validator = Validator::make($r->all(),[
            'nama_kelas' => 'required',
            
        ]);
        if($validator->fails()){
            Session::flash('alert_warning','Form uncompletely filled');
            return redirect('/make-class-admin');
        }
        //fungsi untuk membuat random code
        $jumlah = 0;
        $length = 6;
        $chara = array_merge(range('A','Z'),range('a','z'),range('0','9'));
        $max = count($chara)-1;
        $kode = "";
        for($i=0; $i < $length; $i++){
            $pos = mt_rand(0,$max);
            $kode .= $chara[$pos];
        }
        
        while(DB::table('classes')->where('class_code',$kode)->count() > 0){
            for($i=0; $i < $length; $i++){
                $pos = mt_rand(0,$max);
                $kode .= $chara($pos);
            }
            
        }
        //
        if($r->hasFile('picture')){
            $file = $r->file('picture');
            $storage = public_path('keperluan_web/sampul_kelas/id_guru_'.$r->kategori);
            if(!File::isDirectory($storage)){
            File::makeDirectory($storage, 077, true, true, true);
            }
            $imageName = $file->getClientOriginalName();
            $classes = classes::create([
                'nama_kelas' => $r->nama_kelas,
                'id_guru' => $r->kategori,
                'picture' => $r->picture->getClientOriginalName(),
                'class_code' => $kode,
                'jumlah_murid'=> $jumlah
            ]);
            $tujuan_upload = 'upload/sampul_kelas/';
            $file->move(public_path($tujuan_upload), $imageName);
            $classes->save();
            return redirect ('/home-admin');
        }
        else{
            $storage = './public/keperluan_web/sampul_kelas/id_guru_'.$r->kategori.'';
            if(!File::isDirectory($storage)){
                File::makeDirectory($storage, 077, true, true, true);
            }
            $classes = classes::create([
                'nama_kelas' => $r->nama_kelas,
                'id_guru' => $r->kategori,
                'class_code' => $kode,
                'jumlah_murid'=> $jumlah
                ]);
            $classes->save();
            return redirect ('/home-admin');
        }
    }
    public function editclass($id){
        $class = classes::where('id',$id)->first();
        $teacher = teacher::where('id',$class->id_guru)->first();
        return view('admin.editclass',compact('class','teacher'));
    }
    public function editclassprocess(request $r){
        if($r->hasFile('picture')){
            $path = '/upload/sampul_kelas';
            $file = $r->file('picture');
            $filename = $file->getClientOriginalName();
            $file->move(public_path($path),$filename);
            $update = classes::where('id',$r->id_kelas)->update([
                'nama_kelas' => $r->nama_kelas,
                'picture' => $filename
            ]);
            Session::flash('alert_success',"Class has been updated succesfully");
            return redirect('/home-admin');
        }
        else{
            $update = classes::where('id',$r->id_kelas)->update([
            'nama_kelas' => $r->nama_kelas
            ]);
            Session::flash('alert_success',"Class has been updated succesfully");
            return redirect('/home-admin');
        }
    }
    public function deleteclass($id){
        $counttopic = topics::where('id_kelas',$id)->count();
        $class = classes::where('id',$id)->first();
        if($counttopic < 2 && $counttopic == 1 && $counttopic > 0 ){
            File::delete('upload/sampul_kelas/'.$class->picture);
            $topic = topics::where('id_kelas',$id)->first();
            $delete = attachment_guru::where('id_topik',$topic->id)->delete();
            $delete2 = topics::where('id_kelas',$id)->delete();
            $delete3 = classes::where('id',$id)->delete();
            Session::flash('alert_success','Class has been deleted successfully');
            return redirect('/home-admin');
        }
        else if($counttopic > 1){
            File::delete('upload/sampul_kelas/'.$class->picture);
            $topic = topics::where('id_kelas',$id)->get();
            foreach($topic as $t){
            $delete = attachment_guru::where('id_topik',$t->id)->delete();
            }
            $delete2 = topics::where('id_kelas',$id)->delete();
            $delete3 = classes::where('id',$id)->delete();
            Session::flash('alert_success','Class has been deleted successfully');
            return redirect('/home-admin');
        }
        else{
            File::delete('upload/sampul_kelas/'.$class->picture);
            $delete3 = classes::where('id',$id)->delete();
            Session::flash('alert_success','Class has been deleted successfully');
            return redirect('/home-admin');
        }
    }
    public function viewtopic($id){
        $forcount = topics::where('id_kelas',$id)->count();
        $class = classes::where('id',$id)->first();
        $teacher = teacher::where('id',$class->id_guru)->first();
        if($forcount < 2 || $forcount == 1){
            $classes2 = topics::where('id_kelas',$id)->first(); 
        }
        else{
            $classes2 = topics::where('id_kelas',$id)->get(); 
        }
        return view('admin.topic',compact('forcount','classes2','class','teacher'));
    }
    public function maketopic($id){
        $class = classes::findOrFail($id);
        return view('admin.maketopic',compact('class'));
    }
    public function maketopicprocess(request $r){
        $validator = Validator::make($r->all(),[
            'topic_name' => 'required',
            'deskripsi' => 'required',
        ]);
        if($validator->fails()){
            Session::flash('alert_warning','Form uncompletely filled');
            return redirect('/class-'.$r->id_kelas.'-make-topic-admin');
        }
        $check=topics::where('nama_topik',$r->topic_name)->where('id_kelas',$r->id_kelas)->count();
        if($check > 0){
            Session::flash('alert_warning',$r->topic_name.' topic has already added, please use another name');
            return redirect('/class-'.$r->id_kelas.'-make-topic-admin');
        }
        else{
            if($r->hasFile('nama_file')){
                try{
                    $create = topics::create([
                        'id_kelas' => $r->id_kelas,
                        'nama_topik' => $r->topic_name,
                        'deskripsi' => $r->deskripsi,
                        'tgl_buat' => $r->tgl_buat,
                        'tgl_deadline' => $r->deadline,
                    ]);
                    $forlater = topics::where('id_kelas',$r->id_kelas)->where('nama_topik',$r->topic_name)->first();
                    $tujuan_upload = 'upload/attachment_guru/';
                    $files = $r->file('nama_file');
                    foreach($files as $file)
                    {
                        $name = $file->getClientOriginalName();
                        $file->move(public_path($tujuan_upload),$name);  
                        $data[] = $name;  
                    }
                    
                    $perulangan = count($data) - 1;
                    for($i=0;$i<=$perulangan;$i++){
                        $file= new attachment_guru();
                        $file->nama_file=$data[$i];
                        $file->id_topik=$forlater->id;
                        $file->tgl_submit=date("Y-m-d");
                        $file->save();
                    }
                    Session::flash('alert_success',$r->topic_name.'has been made succesfully');
                    return redirect('/class-'.$r->id_kelas.'-topics-admin');
                    }
                    catch(\exception $e){
                        $message = $e->getMessage();
                        Session::flash('alert_warning',$message);
                        return redirect('/class-'.$r->id_kelas.'-make-topic-admin');
                    }
            }
            else{
                try{
                $create = topics::create([
                    'id_kelas' => $r->id_kelas,
                    'nama_topik' => $r->topic_name,
                    'deskripsi' => $r->deskripsi,
                    'tgl_buat' => $r->tgl_buat,
                    'tgl_deadline' => $r->deadline,
                ]);
                Session::flash('alert_success',$r->topic_name.'has been made succesfully');
                return redirect('/class-'.$r->id_kelas.'-topics-admin');
                }
                catch(\exception $e){
                    $message = $e->getMessage();
                    Session::flash('alert_warning',$message);
                    return redirect('/class-'.$r->id_kelas.'-make-topic-admin');
                }
            }
        }
    }
    public function viewtopicdetail($id){
        $topic = topics::where('id',$id)->first();
        $class = classes::where('id',$topic->id_kelas)->first();
        $teacher = teacher::where('id',$class->id_guru)->first();
        $timestamp = strtotime($topic->tgl_deadline);
        $day = date('l', $timestamp);
        var_dump($day);
        $files2 = attachment_guru::where('id_topik',$id)->count();
        $files='';
        if($files2 < 2 && $files2 == 1){
            $files = attachment_guru::where('id_topik',$id)->first();
        }
        if($files2 > 1){
            $files = attachment_guru::where('id_topik',$id)->get();
        }
        $filesubmitcount = DB::table('attachment_murid')->join('data_topik','data_topik.id_topik','attachment_murid.id_topik')
                           ->join('students','students.id','=','attachment_murid.id_murid')
                           ->where('attachment_murid.id_topik','=',$topic->id,'and','data_topik.id_topik','=',$topic->id,'and','data_topik.status','=','turned in')
                           ->select(DB::raw("count(students.nama) as count"))
                           ->first();
        $filesubmitcount2 = DB::table('attachment_murid')->join('data_topik','data_topik.id_topik','attachment_murid.id_topik')
                            ->join('students','students.id','=','attachment_murid.id_murid')
                            ->where('attachment_murid.id_topik','=',$topic->id,'and','data_topik.id_topik','=',$topic->id,'and','data_topik.status','=','turned in')
                            ->select(DB::raw("count(attachment_murid.nama_file) as count"))
                            ->first();
        $filesubmit='';
        if($filesubmitcount->count < 2 && $filesubmitcount->count == 1 && $filesubmitcount->count != 0){
            $filesubmit = DB::table('attachment_murid')->join('data_topik','data_topik.id_topik','=','attachment_murid.id_topik')
                               ->join('students','students.id','=','attachment_murid.id_murid')
                               ->where('attachment_murid.id_topik','=',$topic->id,'and','data_topik.status','=','turned in')
                               ->select('attachment_murid.nama_file','students.nama')
                               ->first();
        }
        else{
            $filesubmit = DB::table('attachment_murid')->join('data_topik','data_topik.id_topik','attachment_murid.id_topik')
                               ->join('students','students.id','=','attachment_murid.id_murid')
                               ->where('attachment_murid.id_topik','=',$topic->id,'and','data_topik.status','=','turned in')
                               ->select('attachment_murid.nama_file','students.nama')
                               ->get();
        }
        $countdatatopikselesai = data_topik::where('id_topik',$id)->where('status','completed')->count();
        $countdatatopikbelum = data_topik::where('id_topik',$id)->where('status','uncompleted')->count();
        $datatopikselesai = '';
        $datatopikbelum='';
        if($countdatatopikselesai > 1){
            $datatopikselesai = db::table('data_topik')->join('students','data_topik.id_murid','=','students.id')
                                ->where('data_topik.id_topik','=',$id,'and','status','=','turned in')
                                ->select('data_topik.*','students.*')
                                ->get();
        }
        if($countdatatopikselesai < 2 && $countdatatopikselesai == 1){
            $datatopikselesai = DB::table('data_topik')->join('students','data_topik.id_murid','=','students.id')
                         ->where('data_topik.id_topik','=',$id,'and','status','=','turned in')
                         ->select('data_topik.*','students.*')
                         ->first();
        }
        if($countdatatopikbelum > 1){
            $datatopikbelum = db::table('data_topik')->join('students','data_topik.id_murid','=','students.id')
                                ->where('data_topik.id_topik','=',$id,'and','status','=',"uncompleted")
                                ->select('data_topik.*','students.*')
                                ->get();
        }
        if($countdatatopikbelum < 2 && $countdatatopikbelum == 1){
            $datatopikbelum = DB::table('data_topik')->join('students','data_topik.id_murid','=','students.id')
                                ->where('data_topik.id_topik','=',$id,'and','status','=',"uncompleted")
                                ->select('data_topik.*','students.*')
                                ->first();
        }
        $countstudent = DB::table('data_murid')
                        ->join('students','data_murid.id_murid','=','students.id')
                        ->join('classes','data_murid.id_kelas','=','classes.id')
                        ->where('data_murid.id_kelas','=',$topic->id_kelas)
                        ->select('data_murid.*','students.*','classes.*')
                        ->count();
            if($countstudent < 2 || $countstudent == 1){
                $student2 = DB::table('data_murid')
                   ->join('students','data_murid.id_murid','=','students.id')
                   ->join('classes','data_murid.id_kelas','=','classes.id')
                   ->where('data_murid.id_kelas','=',$topic->id_kelas)
                   ->select('data_murid.*','students.*','classes.*')
                   ->first();
            }
            if($countstudent > 1){
                $student2 = DB::table('data_murid')
                   ->join('students','data_murid.id_murid','=','students.id')
                   ->join('classes','data_murid.id_kelas','=','classes.id')
                   ->where('data_murid.id_kelas','=',$topic->id_kelas)
                   ->select('data_murid.*','students.*','classes.*')
                   ->get();
            }
        return view('admin.topicdetail',compact('topic','class','files','day','files2',
        'countstudent','student2','datatopikselesai','datatopikbelum','countdatatopikselesai','countdatatopikbelum','teacher',
        'filesubmit','filesubmitcount','filesubmitcount2'));
    }
    public function edittopic($id){
        $topic = topics::where('id',$id)->first();
        $attachmentcount = attachment_guru::where('id_topik',$id)->count();
        /*
        if($attachmentcount < 2 && $attachmentcount == 1){
            $attachment = attachment_guru::where('id_topik',$id)->first();
            File::delete('upload/attachment_guru/'.$attachment->nama_file);
        }
        if($attachmentcount > 1){
            $attachment = attachment_guru::where('id_topik',$id)->get();
            foreach($attachment as $a){
                File::delete('upload/attachment_guru/'.$a->nama_file);
            }
        }
        */
        return view('admin.edittopic',compact('topic'));
    }
    public function edittopicprocess(request $r){
        $attachmentcount = attachment_guru::where('id_topik',$r->id_topik)->count();
        if($r->hasFile('nama_file')){
            if($attachmentcount < 2 && $attachmentcount == 1){
                $attachment = attachment_guru::where('id_topik',$r->id_topik)->first();
                $delete = attachment_guru::where('id_topik',$r->id_topik)->delete();
                File::delete('upload/attachment_guru/'.$attachment->nama_file);
            }
            if($attachmentcount > 1){
                $attachment = attachment_guru::where('id_topik',$r->id_topik)->get();
                foreach($attachment as $a){
                    File::delete('upload/attachment_guru/'.$a->nama_file);
                    $delete = attachment_guru::where('id_topik',$r->id_topik)->delete();
                }
            }
            $update = topics::where('id',$r->id_topik)->update([
                'id_kelas' => $r->id_kelas,
                'nama_topik' => $r->topic_name,
                'deskripsi' => $r->deskripsi,
                'tgl_deadline' => $r->deadline,
                'tgl_edit_terakhir' => $r->tgl_edit
            ]);

            $tujuan_upload = 'upload/attachment_guru/';
            $files = $r->file('nama_file');
            $count = count($files);
            
                foreach($files as $file){
                    $name = $file->getClientOriginalName();
                    $file->move(public_path($tujuan_upload),$name);  
                    $data[] = $name;  
                }
            $perulangan = count($data) - 1;
                for($i=0;$i<=$perulangan;$i++){
                    $file= new attachment_guru();
                    $file->nama_file=$data[$i];
                    $file->id_topik=$r->id_topik;
                    $file->tgl_submit=date("Y-m-d");
                    $file->save();
                }
            
            
            Session::flash('alert_success','Topic has been updated succesfully');
            return redirect('/topic-'.$r->id_topik.'-detail-admin');
        }
        else{
            $update = topics::where('id',$r->id_topik)->update([
                'id_kelas' => $r->id_kelas,
                'nama_topik' => $r->topic_name,
                'deskripsi' => $r->deskripsi,
                'tgl_deadline' => $r->deadline,
                'tgl_edit_terakhir' => $r->tgl_edit
            ]);
            Session::flash('alert_success','Topic has been updated succesfully');
            return redirect('/topic-'.$r->id_topik.'-detail-admin');
        }
    }
    public function deletetopic($id){
        $class = topics::where('id',$id)->first();
        $attachmentcount = attachment_guru::where('id_topik',$id)->count();
        if($attachmentcount > 0){
            if($attachmentcount < 2 && $attachmentcount == 1){
                $attachment = attachment_guru::where('id_topik',$id)->first();
                $delete = attachment_guru::where('id_topik',$id)->delete();
                File::delete('upload/attachment_guru/'.$attachment->nama_file);
            }
            if($attachmentcount > 1){
                $attachment = attachment_guru::where('id_topik',$id)->get();
                foreach($attachment as $a){
                    File::delete('upload/attachment_guru/'.$a->nama_file);
                    $delete = attachment_guru::where('id_topik',$id)->delete();
                }
            }
            $delete = topics::where('id',$id)->delete();
            if($delete){
                Session::flash('alert_success','Topic has been deleted successfully');
                return redirect('/class-'.$class->id_kelas.'-topics-admin');
            }
            else{
                Session::flash('alert_warning','Failed to delete the topic, please try again');
                return redirect('/class-'.$class->id_kelas.'-topics-admin');
            }
        }
        else{
            $delete = topics::where('id',$id)->delete();
            if($delete){
                Session::flash('alert_success','Topic has been deleted successfully');
                return redirect('/class-'.$class->id_kelas.'-topics-admin');
            }
            else{
                Session::flash('alert_warning','Failed to delete the topic, please try again');
                return redirect('/class-'.$class->id_kelas.'-topics-admin');
            }
        }
    }
    public function teacher(){
        $teacher = teacher::all();
        return view('admin.teacher',compact('teacher'));
    }
    public function teacherclass($id){
        $teacher = teacher::where('id',$id)->first();
        $countclasses = classes::where('id_guru',$id)->count();
        $classes='';
        $count=array();
        $forcount='';
        if($countclasses > 1){
            $classes = classes::where('id_guru',$id)->get();
        }
        if($countclasses < 2 && $countclasses == 1){
            $classes = classes::where('id_guru',$id)->first();
            $count = data_murid::where('id_kelas',$classes->id)->count();
        }
        return view('admin.course',compact('countclasses','classes','teacher','count'));
    }
    public function teacherprofile($id){
        $teacher = teacher::where('id',$id)->first();
        $countclasses = classes::where('id_guru',$id)->count();
        return view('admin.teacherprofile',compact('countclasses','teacher'));
    }
    public function teacheredit($id){
        $teacher = teacher::where('id',$id)->first();
        $countclass = classes::where('id_guru',$teacher->id)->count();
        return view('admin.teacheredit',compact('teacher','countclass'));
    }
    public function teachereditprocess(request $r,$id){
        $teacher = teacher::where('id',$id)->first();
        $path = '/upload/profile_picture/teacher';
        if($r->hasFile('picture')){
            if($r->old_password != null && $teacher->password == md5($r->old_password)){
                if($r->new_password != $r->password_confirmation){
                    Session::flash('alert_warning',"Password confirmation doesn't match with new password");
                    return redirect('/teacher-'.$id.'-edit-admin');
                }
                $file = $r->file('picture');
                $filename = $file->getClientOriginalName();
                $file->move(public_path($path),$filename);
                $update = teacher::where('id',$id)->update([
                    'nama' => $r->fullname,
                    'email' => $r->email,
                    'password' => md5($r->new_password),
                    'about_urself' => $r->about_urself,
                    'picture' => $filename
                ]);
                Session::flash('alert_success',"data have been updated succesfully");
                return redirect('/teacher-'.$id.'-profile');
            }
            else{
                $file = $r->file('picture');
                $filename = $file->getClientOriginalName();
                $file->move(public_path($path),$filename);
                $update = teacher::where('id',$id)->update([
                    'nama' => $r->fullname,
                    'email' => $r->email,
                    'about_urself' => $r->about_urself,
                    'picture' => $filename
                ]);
                Session::flash('alert_success',"data have been updated succesfully");
                return redirect('/teacher-'.$id.'-profile');
            }
        }
        else{
            if($r->old_password != null && md5($teacher->password) == $r->old_password){
                if($r->new_password != $r->password_confirmation){
                    Session::flash('alert_warning',"Password confirmation doesn't match with new password");
                    return redirect('/teacher-'.$id.'-edit-admin');
                }
                $update = teacher::where('id',$id)->update([
                    'nama' => $r->fullname,
                    'email' => $r->email,
                    'password' => md5($r->new_password),
                    'about_urself' => $r->about_urself,
                ]);
                Session::flash('alert_success',"data have been updated succesfully");
                return redirect('/teacher-'.$id.'-profile');
            }
            else{
                $update = teacher::where('id',$id)->update([
                    'nama' => $r->fullname,
                    'email' => $r->email,
                    'about_urself' => $r->about_urself,
                ]);
                Session::flash('alert_success',"data have been updated succesfully");
                return redirect('/teacher-'.$id.'-profile');
            }
        }
    }
    public function addaccount(){
        return view('admin.accountadd');
    }
    public function addaccountprocess(request $r){
        $validator = Validator::make($r->all(),[
            'fullname' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        if($validator->fails()){
            Session::flash('alert_warning','Form uncompletely filled');
            return redirect('/add-account');
        }
        else if($r->password != $r->confirm_password){
            Session::flash('alert_warning','Password confirmation does not match');
            return redirect('/add-account');
        }
        else{
            if($r->kategori == "teacher"){
                $email = DB::table('teachers')->where('email','like','%'.$r->email.'%')->count();
                if($email > 0){
                    Session::flash('alert_warning','Email has been registered, please use another email');
                    return redirect('/add-account');
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
                return redirect('/teacher');
                }
                catch(\Exception $e){
                    $message = $e->getMessage();
                    Session::flash('alert_warning',$message);
                    return redirect('/add-account');
                }
            }
        }
            else{
                $email = DB::table('students')->where('email','like','%'.$r->email.'%')->count();
                if($email > 0){
                    Session::flash('alert_warning','Email has been registered, please use another email');
                    return redirect('/add-account');
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
                return redirect('/student');
                }
                catch(\Exception $e){
                    $message = $e->getMessage();
                    Session::flash('alert_warning',$message);
                    return redirect('/add-account');
                }
                }
            }
        }
    }
    public function student(){
        $student = student::all();
        return view('admin.student',compact('student'));
    }
    public function studentprofile($id){
        $student = student::where('id',$id)->first();
        $classcount = data_murid::where('id_murid',$id)->count();
        $topikcount = data_topik::where('id_murid',$id)->where('status',"completed")->count();
        return view('admin.studentprofile',compact('classcount','student','topikcount'));
    }
    public function studentedit($id){
        $profile = student::where('id',$id)->first();
        $topikcount = data_topik::where('id_murid',$profile->id)->count();
        $classcount = data_murid::where('id_murid',$profile->id)->count();
        return view('admin.studentedit',compact('profile','classcount','topikcount'));
    }
    public function studenteditprocess(request $r,$id){
        $student = student::where('id',$id)->first();
        $path = '/upload/profile_picture/student';
        if($r->hasFile('picture')){
            if($r->old_password != null && $student->password == md5($r->old_password)){
                if($r->new_password != $r->password_confirmation){
                    Session::flash('alert_warning',"Password confirmation doesn't match with new password");
                    return redirect('/student-'.$id.'-edit-admin');
                }
                $file = $r->file('picture');
                $filename = $file->getClientOriginalName();
                $file->move(public_path($path),$filename);
                $update = student::where('id',$id)->update([
                    'nama' => $r->fullname,
                    'email' => $r->email,
                    'password' => md5($r->new_password),
                    'about_urself' => $r->about_urself,
                    'picture' => $filename
                ]);
                Session::flash('alert_success',"data have been updated succesfully");
                return redirect('/student-'.$id.'-profile');
            }
            else{
                $file = $r->file('picture');
                $filename = $file->getClientOriginalName();
                $file->move(public_path($path),$filename);
                $update = student::where('id',$id)->update([
                    'nama' => $r->fullname,
                    'email' => $r->email,
                    'about_urself' => $r->about_urself,
                    'picture' => $filename
                ]);
                Session::flash('alert_success',"data have been updated succesfully");
                return redirect('/student-'.$id.'-profile');
            }
        }
        else{
            if($r->old_password != null && md5($student->password) == $r->old_password){
                if($r->new_password != $r->password_confirmation){
                    Session::flash('alert_warning',"Password confirmation doesn't match with new password");
                    return redirect('/student-'.$id.'-edit-admin');
                }
                $update = student::where('id',$id)->update([
                    'nama' => $r->fullname,
                    'email' => $r->email,
                    'password' => md5($r->new_password),
                    'about_urself' => $r->about_urself,
                ]);
                Session::flash('alert_success',"data have been updated succesfully");
                return redirect('/student-'.$id.'-profile');
            }
            else{
                $update = student::where('id',$id)->update([
                    'nama' => $r->fullname,
                    'email' => $r->email,
                    'about_urself' => $r->about_urself,
                ]);
                Session::flash('alert_success',"data have been updated succesfully");
                return redirect('/student-'.$id.'-profile');
            }
        }
    }
    public function deleteteacher($id){
        $delete = teacher::where('id',$id)->delete();
        $delete2 = classes::where('id_guru',$id)->delete();
        Session::flash('alert_success','Delete account Success');
        return redirect('/teacher');
    }
    public function deletestudent($id){
        $delete = student::where('id',$id)->delete();
        $delete2 = data_murid::where('id_murid',$id)->delete();
        $delete3 = attachment_murid::where('id_murid',$id)->delete();
        Session::flash('alert_success','Delete account Success');
        return redirect('/student');
    }
    public function deleteadmin($id){
        $delete = admin::where('id',$id)->delete();
        Session::flush();
        return redirect('/home');
    }
}
