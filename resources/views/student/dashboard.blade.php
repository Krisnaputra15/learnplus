@extends('template.student')

@section('content')
<section class="grey page-title">
<div class="container">
<div class="row">
<div class="col-md-6 text-left">
<h1>Profile Page</h1>
</div>
<div class="col-md-6 text-right">
<div class="bread">
<ol class="breadcrumb">
<li><a href="{{url('/home-student')}}">Home</a></li>
<li class="active">{{Session('fullname_user')}} Profile Page</li>
</ol>
</div>
</div>
</div>
</div>
</section>
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
<img src='upload/profile_picture/student/{{$profile->picture}}' alt="Your Picture" class="img-responsive">
</div>
<div class="course-meta">
<p>{{Session('fullname_user')}}</p>
<hr>
<p>My Profile <small><a href="course-account.html">Edit</a></small></p>
<hr>
<p>Class Joined <small class="label label-primary">{{$classcount}}</small></p>
<hr>
<p>Task Done <small class="label label-primary">{{$topikcount}}</small></p>
<hr>
<p>Achievements <small class="label label-primary"><a href="course-achievements.html">5</a></small></p>
</div>
</div>
<div id="course-content">
<div class="course-description">
<div class="col-md-8 col-md-8">
<div class="shop-list-desc">
<h2>{{$profile->nama}}</h2>
<div class="shopmeta">
<span class="pull-left"><strong>Profession :</strong> Student </span>
<div class="rating pull-right">
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
</div>
</div>
<hr class="invis">
<hr class="invis">
<h4 class="section-title">About You</h4>
<br>
<div class="well" style="background-color:transparent;">
<div class="media" style="background-color:transparent;">
@if($profile->about_urself != null)
<pre><p>{{$profile->about_urself}}</p></pre>
@else
<p>You haven't write anything about yourself yet.</p>
<p>please write it as soon as possible.</p>
@endif
</div>
</div>
</div>
<h4><b>My Contact</b></h4>
<div>
<p>{{$profile->email}}</p>
</div>
<a href="{{url('/home-student')}}" class="btn btn-default" style="width:24.5%;"><i class="fa fa-search"></i> &nbsp; View Your Class</a> <a href="{{url('student-'.$profile->id.'-edit')}}" class="btn btn-primary" ><i class="fa fa-cogs"></i> &nbsp; Edit Your Profile Information</a> <a href="{{url('/logout')}}" class="btn btn-warning" style="width:20%;"><i class="fa fa-sign-out"></i> &nbsp; Logout</a> 

</div>

</div>
</div>
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