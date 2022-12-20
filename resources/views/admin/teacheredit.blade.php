@extends('template.admin')

@section('content')
<section class="white section">
<div class="container">
<div class="row">
@if(Session::has('alert_success'))
        <div class="alert alert-success">
            <center>{{Session('alert_success')}}<center>
        </div>
    @endif
    @if(Session::has('alert_warning'))
        <div class="alert alert-danger">
            <center>{{Session('alert_warning')}}<center>
        </div>
    @endif
<div id="course-left-sidebar" class="col-md-3">
<div class="course-image-widget">
<img src='upload/profile_picture/teacher/{{$teacher ->picture}}' alt="" class="img-responsive">
</div>
<div class="course-meta">
<p>{{$teacher->nama}}</p>
<hr>
<p>My Profile </p>
<hr>
<p>My Class <small class="label label-primary">{{$countclass}}</small></p>
<hr>
<p>Achievements <small class="label label-primary"><a href="course-achievements.html">5</a></small></p>
</div>
</div>
<div id="course-content" class="col-md-9">
<div class="course-description">
<h3 class="course-title">Edit Profile</h3>
<p>Edit this profile in this page please, Admin {{Session('fullname_user')}}. And remember just fill the form which you want to update.</p>
<div class="edit-profile">
<form role="form" method="post" action="{{url('/teacher-edit-profile-'.$teacher->id.'-process-admin')}}" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="form-group">
<input type="hidden" name="id_user" id="id_user" class="form-control" placeholder="" value="$teacher->id">
</div>
<div class="form-group">
<label>Full Name</label>
<input type="text" name="fullname" id="fullname" class="form-control" placeholder="{{$teacher->nama}}" value="{{$teacher->nama}}">
</div>
<div class="form-group">
<label>Email Address</label>
<input type="email" name="email" id="email" class="form-control" placeholder="{{$teacher->email}}" value="{{$teacher->email}}">
</div>
<div class="form-group">
<label>Old Password</label>
<input type="password" name="old_password" id="old_password" class="form-control" placeholder="************" value="">
</div>
<p style="color:grey;"><i>*Fill this if you want to edit the password</i></p>
<div class="form-group">
<label>New Password</label>
<input type="password" name="new_password" id="new_password" class="form-control" placeholder="************" value="">
</div>
<p style="color:grey;"><i>*Fill this if you want to edit the password</i></p>
<div class="form-group">
<label>Re-Enter New Password</label>
<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="************" value="">
</div>
<p style="color:grey;"><i>*Fill this if you want to edit the password</i></p>
<div class="form-group">
<label>About Your Self</label>
<textarea type="text" name="about_urself" id="about_urself" class="form-control" placeholder="" value="">{{$teacher->about_urself}}</textarea>
</div>
<div class="form-group">
<label>Upload Avatar</label>
<input type="file" name="picture" id="picture" class=" form-control">
</div>
<button type="submit" class="btn btn-primary">Submit Changes</button>
</form>
</div>
</div>
</div>
</div>
</section>
@stop

@section('js')
<script src="js/jquery.min.js.pagespeed.jm.iDyG3vc4gw.js"></script>
<script src="js/bootstrap.min.js%2bretina.js%2bwow.js.pagespeed.jc.pMrMbVAe_E.js"></script><script>eval(mod_pagespeed_gFRwwUbyVc);</script>
<script>eval(mod_pagespeed_rQwXk4AOUN);</script>
<script>eval(mod_pagespeed_U0OPgGhapl);</script>
<script src="js/carousel.js%2bcustom.js.pagespeed.jc.nVhk-UfDsv.js"></script><script>eval(mod_pagespeed_6Ja02QZq$f);</script>
<script>eval(mod_pagespeed_KxQMf5X6rF);</script>
@stop