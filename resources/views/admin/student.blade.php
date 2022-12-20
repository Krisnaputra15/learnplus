@extends('template.admin')

@section('content')
<section class="white section">
<div class="container">
<div class="col-md-12">
<div class="section-title text-center">
<h4>All Student</h4>
<p>Listed Below The Student Registered in This Class, Admin {{Session::get('fullname_user')}}</p>
</div>
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
@if(count($student) > 0)
@foreach($student as $student)
<div class="row course-list teacher-list">
<div class="col-md-3 col-sm-4 col-xs-12">
<div class="shop-item-list entry">
<div class="">
<img src="upload/profile_picture/student/{{$student->picture}}"  alt="">
<div class="magnifier">
</div>
</div>
</div>
</div>
<div class="col-md-8 col-md-8">
<div class="shop-list-desc">
<h4><a >{{$student->nama}}</a></h4>
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
<hr class="invis clearfix">
@if($student->about_urself != null)
<p>{{$student->about_urself}}</p>
@else
<p>{{$student->nama}}'s profile description hasn't been written yet</p>
@endif
<a href="{{url('student-'.$student->id.'-profile')}}" class="btn btn-primary"><i class="fa fa-search"></i> &nbsp; View My Profile</a>
</div>
</div>

</div>
</div>
@endforeach
@else
<div class="section-title text-center">
<h2><i>Oops!<br>No teacher registered in this application</i></h2>
</div>
@endif
<center>
<a href="{{url('add-account')}}" class="btn btn-success btn-lg">Add New Account</a>
</center>
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