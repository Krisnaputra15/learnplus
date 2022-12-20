<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Hash;
use DB;
use Validator;
use Illuminate\Support\Facades\File;
use App\student;
use App\teacher;
use App\classes;
use App\topics;
use App\data_murid;
use App\data_topik;
use App\attachment_guru;
use App\attachment_murid;


class studentController extends Controller
{
    public function dashboard(){
        $profile = student::where('id',Session::get('id_user'))->first();
        $topikcount = data_topik::where('id_murid',$profile->id)->count();
        $classcount = data_murid::where('id_murid',$profile->id)->count();
        return view('student.dashboard',compact('profile','classcount','topikcount'));
    }
    public function editprofile($id){
        $profile = student::where('id',$id)->first();
        $topikcount = data_topik::where('id_murid',$profile->id)->count();
        $classcount = data_murid::where('id_murid',$profile->id)->count();
        return view('student.editprofile',compact('profile','classcount','topikcount'));
    }
    public function editprofileprocess(request $r,$id){
        $student = student::where('id',$id)->first();
        $path = '/upload/profile_picture/student';
        if($r->hasFile('picture')){
            if($r->old_password != null && $student->password == md5($r->old_password)){
                if($r->new_password != $r->password_confirmation){
                    Session::flash('alert_warning',"Password confirmation doesn't match with new password");
                    return redirect('/student-'.$r->id_user.'-edit');
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
                Session::flash('alert_success',"Your data have been updated succesfully");
                return redirect('/dashboard-student');
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
                Session::flash('alert_success',"Your data have been updated succesfully");
                return redirect('/dashboard-student');
            }
        }
        else{
            if($r->old_password != null && md5($student->password) == $r->old_password){
                if($r->new_password != $r->password_confirmation){
                    Session::flash('alert_warning',"Password confirmation doesn't match with new password");
                    return redirect('/student-'.$r->id_user.'-edit');
                }
                $update = student::where('id',$id)->update([
                    'nama' => $r->fullname,
                    'email' => $r->email,
                    'password' => md5($r->new_password),
                    'about_urself' => $r->about_urself,
                ]);
                Session::flash('alert_success',"Your data have been updated succesfully");
                return redirect('/dashboard-student');
            }
            else{
                $update = student::where('id',$id)->update([
                    'nama' => $r->fullname,
                    'email' => $r->email,
                    'about_urself' => $r->about_urself,
                ]);
                Session::flash('alert_success',"Your data have been updated succesfully");
                return redirect('/dashboard-student');
            }
        }
    }
    public function home(){
        $classes = DB::table('classes');
        $countclass = data_murid::where('id_murid',Session::get('id_user'))->count();
        $classes2 ='';
        $kelas =array();
        $data[] = '';
        $dataid='';
        $count = '';
        
        if($countclass < 2 && $countclass == 1){
            $datastudent = data_murid::where('id_murid',Session::get('id_user'))->first();
            $classes2 = classes::where('id',$datastudent->id_kelas)->first();
            return view('student.home',compact('countclass','datastudent','classes2'));
        }
        else{
            $datastudent = data_murid::where('id_murid',Session::get('id_user'))->get();
            foreach($datastudent as $datastudent){
            $dataid = $datastudent->id_kelas;
            $data[] = $dataid; 
            $count = count($data)-1;
            for($i = 1;$i <= $count;$i++){
            $classes2 = classes::where('id',$data[$i])->first(); 
            $kelas[$i] = $classes2;
            }
            }
            
            return view('student.home',compact('countclass','datastudent','classes2','data','classes','kelas','count'));
        }
    }
    public function joinclass(){
        return view('student.joinclass');
    }
    public function joinclassprocess(request $r){
        $validator = Validator::make($r->all(),[
            'class_code' => 'required|min:6|max:6'
        ]);
        if($validator->fails()){
            Session::flash('alert_warning',"Wrong class join code or you haven't fill the class join code");
            return redirect('/join-class');   
        }
        try{
        $class = classes::where('class_code',$r->class_code)->first();
        $jumlahmurid = $class->jumlah_murid;
        $student = data_murid::where('id_murid',$r->id_murid)->where('id_kelas',$class->id)->count(); 
        if($r->class_code == $class->class_code){
            if($student > 0){
                Session::flash('alert_warning',"You have joined this class before");
                return redirect('/join-class');   
            }
            else{
                $insert = data_murid::create([
                    'id_kelas' => $class->id,
                    'id_murid' => $r->id_murid 
                ]);
                $update = classes::where('class_code',$r->class_code)->update([
                    'jumlah_murid' => $jumlahmurid + 1
                ]);
                Session::flash('alert_success',"Join class Success");
                return redirect('/home-student');   

            }
        }
        }
        catch(\Exception $e){
            Session::flash('alert_warning',"wrong class code");
            return redirect('/join-class');   
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
        return view('student.topic',compact('forcount','classes2','class','teacher'));
    }
    public function viewtopicdetail($id){
        $topic = topics::where('id',$id)->first();
        $class = classes::where('id',$topic->id_kelas)->first();
        $teacher = teacher::where('id',$class->id_guru)->first();
        $student = student::where('id',Session::get('id_user'))->first();
        $cek = data_topik::where('id_topik',$id)->where('id_murid',$student->id)->count();
        if($cek == 0){
            $insert = data_topik::create([
                'id_topik' => $topic->id,
                'id_murid' => $student->id,
                'status' => "uncompleted"
            ]);
        }
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
        $datatopik = data_topik::where('id_topik',$id)->where('id_murid',$student->id)->first();
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
        $filemuridcount = attachment_murid::where('id_topik',$id)->where('id_murid',$student->id)->count();
        $filemurid='';
        if($filemuridcount > 1){
            $filemurid = attachment_murid::where('id_topik',$id)->where('id_murid',$student->id)->get();
        }
        if($filemuridcount < 2 && $filemuridcount == 1){
            $filemurid = attachment_murid::where('id_topik',$id)->where('id_murid',$student->id)->first();
        }
        return view('student.topicdetail',compact('topic','class','files','day','files2','countstudent','student2','teacher','datatopik','student','filemurid','filemuridcount'));
    }
    public function submitfiles($id){
        $topic = topics::where('id',$id)->first();
        return view('student.submit',compact('topic'));
    }
    public function submitfilesprocess(request $r){
        $tujuan_upload = 'upload/attachment_murid/';
        $files = $r->file('nama_file');
        $count = count($files);
        foreach($files as $file){
            $name = $file->getClientOriginalName();
            $file->move(public_path($tujuan_upload),$name);  
            $data[] = $name;  
        }
        $perulangan = count($data) - 1;
        for($i=0;$i<=$perulangan;$i++){
            $file= new attachment_murid();
            $file->nama_file=$data[$i];
            $file->id_topik=$r->id_topik;
            $file->id_murid=$r->id_murid;
            $file->tgl_submit=date("Y-m-d");
            $file->save();
        }
        Session::flash('alert_success','Add files success');
        return redirect('/student-topic-'.$r->id_topik.'-detail');
    }
    public function deletefile($id){
        $attachment = attachment_murid::where('id',$id)->first();
        $delete = attachment_murid::where('id_topik',$attachment->id_topik)->where('id',$id)->delete();
        File::delete('upload/attachment_murid/'.$attachment->nama_file);
        Session::flash('alert_success','Delete files success');
        return redirect('/student-topic-'.$attachment->id_topik.'-detail');
    }
    public function turnassignment($id){
        $datatopik = data_topik::where('id_topik',$id)->where('id_murid',Session::get('id_user'))->update([
            'status' => "turned in",
            'turn_in_date' => date('Y-m-d h:i:s')
        ]);
        $topic = topics::where('id',$id)->first();
        $datatopik2 = data_topik::where('id_topik',$id)->where('id_murid',Session::get('id_user'))->first();
        if($topic->tgl_deadline != null){
            if($datatopik2->turn_in_date > $topic->tgl_deadline){
                $datatopik = data_topik::where('id_topik',$id)->where('id_murid',Session::get('id_user'))->update([
                    'late_or_on_time'=> 'late'
                ]);
            }
            else{
                $datatopik = data_topik::where('id_topik',$id)->where('id_murid',Session::get('id_user'))->update([
                    'late_or_on_time'=> 'on time'
                ]);
            }
        }
        else{
            $datatopik = data_topik::where('id_topik',$id)->where('id_murid',Session::get('id_user'))->update([
                'late_or_on_time'=> 'on time'
            ]);
        }
        Session::flash('alert_success','Turn in topic success');
        return redirect('/student-topic-'.$id.'-detail');
    }
    public function cancelassignment($id){
        $datatopik = data_topik::where('id_topik',$id)->where('id_murid',Session::get('id_user'))->update([
            'status' => "uncompleted",
            'turn_in_date' => null,
            'late_or_on_time' => null
        ]);
        Session::flash('alert_success','Cancel topic turn in success');
        return redirect('/student-topic-'.$id.'-detail');
    } 
}
