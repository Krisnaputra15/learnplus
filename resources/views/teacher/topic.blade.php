@extends('template.teacher')

@section('content')
<section class="grey page-title">
<div class="container">
<div class="row">
<div class="col-md-6 text-left">
<h1>{{$class->nama_kelas}} Topic(s)</h1>
</div>
<div class="col-md-6 text-right">
<div class="bread">
<ol class="breadcrumb">
<li><a href="{{url('home-teacher')}}">Home</a></li>
<li><a href="{{url('class-'.$class->id.'-topics')}}">{{$class->nama_kelas}}</a></li>
<li class="active">{{$class->nama_kelas}} Course Topic(s) List</li>
</ol>
</div>
</div>
</div>
</div>
</section>
<section class="white section">
<div class="container">
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
<!-- Accordion Widget -->
<div class="accordion-widget">
<div class="accordion-toggle-2">
<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<div class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseFour">
<h3>Click this panel to show your class join code <i class="indicator fa fa-plus"></i></h3>
</a>
</div>
</div>
<div id="collapseFour" class="panel-collapse collapse">
<div class="panel-body">
<p>{{$class->nama_kelas}} class join code : <b>{{$class->class_code}}</b></p>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- end of accordion widget -->
@if($forcount > 0)
@if($forcount < 2 || $forcount == 1)
<div class="row course-list">
<div class="col-md-4 col-sm-4 col-xs-12">
<div class="shop-item-list entry">
<div class="">
<img src="upload/sampul_kelas/{{$class->picture}}" alt="{{$class->nama_kelas}} image">
<div class="magnifier">
</div>
</div>
</div>
</div>
<div class="col-md-8 col-md-8">
<div class="shop-list-desc">
<h4><a href="{{url('topic-'.$classes2->id.'-detail')}}">{{$classes2->nama_topik}}</a></h4>
<div class="shopmeta">
<span class="pull-left"><strong>Course Teacher : </strong> {{Session::get('fullname_user')}} </span>
<div class="rating pull-right">
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
</div>
</div>
<hr class="invis clearfix">
<p>{{$classes2->deskripsi}}</p></pre>
<a href="{{url('topic-'.$classes2->id.'-detail')}}" class="btn btn-default">Select</a>
</div>
</div>
</div>
@else
@foreach($classes2 as $classes2)
<div class="row course-list">
<div class="col-md-4 col-sm-4 col-xs-12">
<div class="shop-item-list entry">
<div class="">
<img src="upload/sampul_kelas/{{$class->picture}}" alt="{{$class->nama_kelas}} image">
<div class="magnifier">
</div>
</div>
</div>
</div>
<div class="col-md-8 col-md-8">
<div class="shop-list-desc">
<h4><a href="{{url('topic-'.$classes2->id.'-detail')}}">{{$classes2->nama_topik}}</a></h4>
<div class="shopmeta">
<span class="pull-left"><strong>Course Teacher : </strong> {{Session::get('fullname_user')}} </span>
<div class="rating pull-right">
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
</div>
</div>
<hr class="invis clearfix">
<p>{{$classes2->deskripsi}}</p>
<a href="{{url('topic-'.$classes2->id.'-detail')}}" class="btn btn-default">Select</a>
</div>
</div>
</div>
@endforeach
@endif
<center>
<a class="btn btn-default btn-lg" href="{{url('class-'.$class->id.'-make-topic')}}">Add a topic</a>
<a class="btn btn-danger btn-lg" href="{{url('class-'.$class->id.'-delete')}}">delete class</a>
</center>
@else
<div class="text-center">
<h2><i>Oops!<br> Look like your haven't posted any topic yet.<br> post a topic by clicking </i><a href="{{url('class-'.$class->id.'-make-topic')}}"><i><b>this link</b></i></a><br></i></h2>
</div>
<center>
<a class="btn btn-default btn-lg" href="{{url('class-'.$class->id.'-make-topic')}}">Add a topic</a>
<a class="btn btn-danger btn-lg" href="{{url('class-'.$class->id.'-delete')}}">delete class</a>
</center>
@endif
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

