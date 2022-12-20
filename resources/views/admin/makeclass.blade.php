@extends('template.admin')

@section('content')
<section class="white section">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="section-title text-center">
<h4>Make a Class</h4>
<p>Fill the form to make a class please, {{Session('fullname_user')}}</p>
</div>
</div>
<!-- form-->

<form method="post" action="{{url('/make-class-process-admin')}}" enctype="multipart/form-data">
{{ csrf_field() }}
<label for="class_name">Class Name</label>
<div class="form-group">
<input type="text" name="nama_kelas" id="nama_kelas" class="form-control" placeholder="Your Class Name" value="" required="">
</div>
<label for="kategori">Teacher Name</label>
<div class="form-group">
<select class="form-control" name="kategori">
@foreach($teacher as $teacher)
<option value="{{$teacher->id}}">{{$teacher->nama}}</option>
@endforeach
</select>
</div>
<label for="exampleFormControlTextArea">Picture</label>
<div class="form-group">
<input type="file" name="picture" id="picture" class="form-control" placeholder="Your Class Name" value="" required="">
</div>
<center>
<button type="submit" class="btn btn-default btn-lg" >Add Class</button>
</center>
</form>

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
@stop