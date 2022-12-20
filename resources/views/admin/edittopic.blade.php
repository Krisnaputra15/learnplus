@extends('template.admin')

@section('content')
<section class="white section">
<div class="container">
<div class="row">
<div class="col-lg-12">
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
<div class="col-md-12">
<div class="section-title text-center">
<h4>Make a Topic</h4>
<p>Fill the form to edit this topic please, {{Session('fullname_user')}}</p>
</div>
</div>
<!-- form-->

<form method="post" action="{{url('/edit-topic-process-admin')}}" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="form-group">
<input type="hidden" name="id_topik" id="id_topik" class="form-control" placeholder="Your Class Name" value="{{$topic->id}}" required="">
</div>
<div class="form-group">
<input type="hidden" name="id_kelas" id="id_kelas" class="form-control" placeholder="Your Class Name" value="{{$topic->id_kelas}}" required="">
</div>
<label for="topic_name">Topic Name</label>
<div class="form-group">
<input type="text" name="topic_name" id="topic_name" class="form-control" placeholder="The Topic Name" value="{{$topic->nama_topik}}" required="">
</div>
<label for="deskripsi">Description</label>
<div class="form-group">
<textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Add a description/instruction for your topic" value="{{$topic->deskripsi}}">{{$topic->deskripsi}}</textarea>
</div>
<label for="class_name">Deadline Date (Fill this if you set the deadline for the topic before)</label>
<div class="form-group">
<input type="datetime-local" name="deadline" id="deadline" class="form-control" placeholder="" value="{{$topic->tgl_deadline}}"> 
</div>
<div class="form-group">
<input type="hidden" name="tgl_edit" id="tgl_edit" class="form-control" placeholder="{{date('Y-m-d h:i:sa')}}" value="{{date('Y-m-d h:i:sa')}}" required="">
</div>
<label for="exampleFormControlTextArea">New Attachment</label>
<div class="input-group hdtuto control-group lst increment" >
      <input type="file" name="nama_file[]" class="myfrm form-control">
      <div class="input-group-btn"> 
        <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
      </div>
    </div>
    <div class="clone hide">
      <div class="hdtuto control-group lst input-group" style="margin-top:10px">
        <input type="file" name="nama_file[]" class="myfrm form-control">
        <div class="input-group-btn"> 
          <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
        </div>
      </div>
    </div>
    <p style="color:grey;"><i>*Fill this if you want to edit the attachment in this topic</i></p>
<center>
<button type="submit" class="btn btn-default btn-lg" style="width:50%; border-radius: 0px;">Edit Topic</button><a href="{{url('topic-'.$topic->id.'-detail-admin')}}" class="btn btn-primary btn-lg" style="width:50%; border-radius: 0px;">Back to topic detail</a>
</center>
</form>
<span> </span>
<center>

</center>
</div>
</div>
</section>
@stop

@section('js')
<script src="js/jquery.min.js.pagespeed.jm.iDyG3vc4gw.js"></script>
<script src="js/bootstrap.min.js%2bretina.js%2bwow.js.pagespeed.jc.pMrMbVAe_E.js"></script><script>eval(mod_pagespeed_gFRwwUbyVc);</script>
<script>eval(mod_pagespeed_rQwXk4AOUN);</script>
<script>eval(mod_pagespeed_U0OPgGhapl);</script>
<script src="js/carousel.js%2bparallax.min.js%2bcustom.js.pagespeed.jc.lVSvRd9-tY.js"></script><script>eval(mod_pagespeed_6Ja02QZq$f);</script>
<script>eval(mod_pagespeed_AZ_gON44eP);</script>
<script>eval(mod_pagespeed_KxQMf5X6rF);</script>
<script src="rs-plugin/js/jquery.themepunch.tools.min.js.pagespeed.jm.0PLSBOOLZa.js"></script>
<script src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script>jQuery(document).ready(function(){jQuery('.tp-banner').show().revolution({dottedOverlay:"none",delay:16000,startwidth:1170,startheight:620,hideThumbs:200,thumbWidth:100,thumbHeight:50,thumbAmount:5,navigationType:"none",navigationArrows:"solo",navigationStyle:"preview3",touchenabled:"on",onHoverStop:"on",swipe_velocity:0.7,swipe_min_touches:1,swipe_max_touches:1,drag_block_vertical:false,parallax:"mouse",parallaxBgFreeze:"on",parallaxLevels:[10,7,4,3,2,5,4,3,2,1],parallaxDisableOnMobile:"off",keyboardNavigation:"off",navigationHAlign:"center",navigationVAlign:"bottom",navigationHOffset:0,navigationVOffset:20,soloArrowLeftHalign:"left",soloArrowLeftValign:"center",soloArrowLeftHOffset:20,soloArrowLeftVOffset:0,soloArrowRightHalign:"right",soloArrowRightValign:"center",soloArrowRightHOffset:20,soloArrowRightVOffset:0,shadow:0,fullWidth:"on",fullScreen:"off",spinner:"spinner4",stopLoop:"off",stopAfterLoops:-1,stopAtSlide:-1,shuffle:"off",autoHeight:"off",forceFullWidth:"off",hideThumbsOnMobile:"off",hideNavDelayOnMobile:1500,hideBulletsOnMobile:"off",hideArrowsOnMobile:"off",hideThumbsUnderResolution:0,hideSliderAtLimit:0,hideCaptionAtLimit:0,hideAllCaptionAtLilmit:0,startWithSlide:0,fullScreenOffsetContainer:""});});</script>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="js/contact.js%2bmap.js.pagespeed.jc.F-5JFqN28v.js"></script><script>eval(mod_pagespeed_CCCJJdU9$y);</script>
<script>eval(mod_pagespeed_WcwWTYPZDc);</script>
<script type="text/javascript">
    $(document).ready(function() {
      $(".btn-success").click(function(){ 
          var lsthmtl = $(".clone").html();
          $(".increment").after(lsthmtl);
      });
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".hdtuto control-group lst").remove();
      });
    });
</script>
@stop