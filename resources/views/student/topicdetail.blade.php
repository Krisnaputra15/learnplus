@extends('template.student')

@section('content')
<section class="grey page-title">
<div class="container">
<div class="row">
<div class="col-md-6 text-left">
<h1>{{$topic->nama_topik}} Topic Page</h1>
</div>
<div class="col-md-6 text-right">
<div class="bread">
<ol class="breadcrumb">
<li><a href="{{url('/home-teacher')}}">Home</a></li>
<li><a href="{{url('class-'.$class->id.'-topics')}}">{{$class->nama_kelas}} Class</a></li>
<li><a href="{{url('topic-'.$topic->id.'-detail')}}">{{$topic->nama_topik}} Topic</a></li>
<li class="active">Detail</li>
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
<div id="course-left-sidebar" class="col-md-4">
<div class="course-image-widget">
<img src="upload/xcourse_01.png.pagespeed.ic.XTOvCuUmZu.png" alt="" class="img-responsive">
</div>
<div class="course-meta">
<p class="course-category">Class : <a href="{{url('class-'.$class->id.'-topics')}}">{{$class->nama_kelas}}</a></p>
<hr>
<p class="course-student">Students : {{$countstudent}} Student(s) </p>
<hr>
<p class="course-prize">Prize : <i class="fa fa-trophy"></i> <i class="fa fa-certificate"></i> <i class="fa fa-shield"></i></p>
<hr>
<p class="course-instructors">Instructor : <a title=""><img src="upload/profile_picture/teacher/{{$teacher->picture}}" class="img-circle" alt=""> {{$teacher->nama}}</a></p>
<hr>
<p class="course-forum">Course Forum : <a href="{{url('student-class-'.$class->id.'-topics')}}" title="">{{$class->nama_kelas}}</a></p>
</div>
<div class="course-button">
@if($datatopik->status == 'turned in')
<a href="{{url('/cancel-topic-'.$topic->id)}}" class="btn btn-danger" style="width:100%;">Cancel turn in</a>
@else
<a href="{{url('/turn-in-topic-'.$topic->id)}}" class="btn btn-success" style="width:100%;">Turn Assignment</a>
@endif
</div>
</div>
<div id="course-content" class="col-md-8">
<div class="course-description">
@if($datatopik->status == 'uncompleted' && date("Y-m-d h:i:s") < $topic->tgl_deadline)
<small>Course Status: <span style="color:green;">Opened</span> </small>
@elseif($datatopik->status == 'uncompleted' && $topic->tgl_deadline == null)
<small>Course Status: <span style="color:green;">Opened</span> </small>
@elseif($datatopik->status == 'turned in' && $topic->tgl_deadline != null && $datatopik->turn_in_date < $topic->tgl_deadline)
<small>Course Status: <span style="color:green;">Turned in on time</span> </small>
@elseif($datatopik->status == 'turned in' && $topic->tgl_deadline == null)
<small>Course Status: <span style="color:green;">Turned in</span> </small>
@elseif($datatopik->status == 'turned in' && $topic->tgl_deadline != null && $datatopik->turn_in_date > $topic->tgl_deadline)
<small>Course Status: <span style="color:red;">Turned in late</span> </small>
@else
<small>Course Status: <span style="color:green;">Closed</span> </small>
@endif
@if($topic->tgl_deadline == null)
<small>Course Deadline: <span>This topic doesn't have a deadline</span> </small>
@else
<small>Course Deadline: <span>{{$day}}, {{$topic->tgl_deadline}}</span> </small>
@endif
<h3 class="course-title">{{$topic->nama_topik}}</h3>
<div class="col-md-12">
<div class="content-widget">
<div class="tabbed-widget">
<ul class="nav nav-tabs">
<li class="active"><a data-toggle="tab" href="#home">Description</a></li>
<li><a data-toggle="tab" href="#menu1">Topic Attachment</a></li>
<li><a data-toggle="tab" href="#menu2">Topic participant</a></li>
<li><a data-toggle="tab" href="#menu3">Your Attachment</a></li>
</ul>
<div class="tab-content">
<div id="home" class="tab-pane fade in active">
<pre style="border:transparent;background:transparent; color:grey; font-family: Arial, Helvetica, sans-serif; font-size:16px; width:110%;">{{$topic->deskripsi}}</pre>
</div>
<div id="menu1" class="tab-pane fade">
@if($files2 > 0 && $files2 > 1)
<p>These are the file(s) uploaded in this topic</p>
<div class="course-table">
<table class="table">
<thead>
<tr>
<th>File Name</th>
<th>Download Link</th>
</tr>
</thead>
<tbody>
@foreach($files as $files)
<tr>
<td>{{$files->nama_file}}</td>
<td><a href="upload/attachment_guru/{{$files->nama_file}}" class="btn btn-default btn-block" download>download</a></td>
</tr>
@endforeach
</tbody>
</table>
</div>
@elseif($files2 < 2 && $files2 == 1)
<p>These are the file(s) uploaded in this topic</p>
<div class="course-table">
<table class="table">
<thead>
<tr>
<th>File Name</th>
<th>Download Link</th>
</tr>
</thead>
<tbody>
<tr>
<td>{{$files->nama_file}}</td>
<td><a href="upload/attachment_guru/{{$files->nama_file}}" class="btn btn-default btn-block" download>download</a></td>
</tr>
</tbody>
</table>
</div>
@else
<p>No file attached in this topic</p>
@endif
</div>
<div id="menu2" class="tab-pane fade">
@if($countstudent < 2 && $countstudent == 1)
<div class="course-table">
<table class="table">
<thead>
<tr>
<th>Student's name</th>
<th>Email</th>
</tr>
</thead>
<tbody>
<tr>
<td>{{$student2->nama}}</td>
<td>{{$student2->email}}</td>
</tr>
</tbody>
</table>
</div>
@elseif($countstudent > 1)
<div class="course-table">
<table class="table">
<thead>
<tr>
<th>Student's name</th>
<th>Email</th>
</tr>
</thead>
<tbody>
@foreach($student2 as $student2)
<tr>
<td>{{$student2->nama}}</td>
<td>{{$student2->email}}</td>
</tr>
@endforeach
</tbody>
</table>
</div>
@else
<p>No student joined {{$class->nama_kelas}} yet</p>
@endif
</div>
<div id="menu3" class="tab-pane fade">
@if($filemuridcount > 1)
<div class="course-table">
<table class="table">
<thead>
<tr>
<th>File Name</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@foreach($filemurid as $filemurid)
<tr>
<td>{{$filemurid->nama_file}}</td>
@if($datatopik->status == 'turned in')
<td><a class="btn btn-primary">Cancel Task to delete file</a></td>
@else
<td><a href="{{url('student-file-'.$filemurid->id.'-delete')}}" class="btn btn-danger">Delete</a></td>
@endif
</tr>
@endforeach
</tbody>
</table>
</div>
@elseif($filemuridcount < 2 && $filemuridcount == 1)
<div class="course-table">
<table class="table">
<thead>
<tr>
<th>File Name</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<tr>
<td>{{$filemurid->nama_file}}</td>
<td><a href="{{url('student-file-'.$filemurid->id.'-delete')}}" class="btn btn-danger">Delete</a></td>
</tr>
</tbody>
</table>
</div>
@else
<p>You haven't add a files in this topic</p>
@endif
@if($datatopik->status == 'turned in')
<center><a class="btn btn-danger">Cannot add file</a></center>
@else
<center><a href="{{url('submit-files-'.$topic->id)}}" class="btn btn-success">Add file</a></center>
@endif
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!--<div class="course-table">
<table class="table">
<thead>
<tr>
<th>Type</th>
<th>Lesson Title</th>
<th>Time</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<tr>
<td><i class="fa fa-play-circle"></i></td>
<td><a href="#">Introduction</a></td>
<td>12 Min</td>
<td><i class="fa fa-check"></i></td>
</tr>
<tr>
<td><i class="fa fa-play-circle"></i></td>
<td>Lesson One - What is Photoshop</td>
<td>20 Min</td>
<td><i class="fa fa-close"></i></td>
</tr>
<tr>
<td><i class="fa fa-play-circle"></i></td>
<td>Lesson Two - How to Use Tools</td>
<td>41 Min</td>
<td><i class="fa fa-close"></i></td>
</tr>
<tr>
<td><i class="fa fa-play-circle"></i></td>
<td>Lesson Three - Creating First Homepage</td>
<td>15 Min</td>
<td><i class="fa fa-close"></i></td>
</tr>
<tr>
<td><i class="fa fa-play-circle"></i></td>
<td>Lesson Four - Understanding Colors</td>
<td>29 Min</td>
<td><i class="fa fa-close"></i></td>
</tr>
<tr>
<td><i class="fa fa-play-circle"></i></td>
<td>Lesson Five - International Sizes</td>
<td>31 Min</td>
<td><i class="fa fa-close"></i></td>
</tr>
<tr>
<td><i class="fa fa-question-circle"></i></td>
<td><a href="course-quiz.html">Quiz Time - Your First Quiz</a></td>
<td>31 Min</td>
<td><i class="fa fa-close"></i></td>
</tr>
</tbody>
</table>
</div>
<hr class="invis">
<div id="reviews" class="feedbacks">
<p>
<a class="btn btn-default btn-block" role="button"  href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
What our customers said? (3 Feedbacks)
</a>
</p>
<div class="collapse" id="collapseExample">
<div class="well">
<div class="media">
<div class="media-left">
<a href="#">
<img class="media-object" src="upload/xstudent_01.png.pagespeed.ic.756JwMcqdq.png" alt="Generic placeholder image">
</a>
</div>
<div class="media-body">
<h4 class="media-heading">John DOE</h4>
<div class="rating">
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star-o"></i>
</div>
<p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
</div>
</div>
<div class="media">
<div class="media-left">
<a href="#">
<img class="media-object" src="upload/xstudent_02.png.pagespeed.ic.y-PM-y4pVj.png" alt="Generic placeholder image">
</a>
</div>
<div class="media-body">
<h4 class="media-heading">Amanda FOXOE</h4>
<div class="rating">
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star-o"></i>
</div>
<p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
</div>
</div>
<div class="media">
<div class="media-left">
<a href="#">
<img class="media-object" src="upload/xstudent_03.png.pagespeed.ic.uCQY3WNMCJ.png" alt="Generic placeholder image">
</a>
</div>
<div class="media-body">
<h4 class="media-heading">Mark BOBS</h4>
<div class="rating">
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
</div>
<p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
-->


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