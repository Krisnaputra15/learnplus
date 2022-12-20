@extends('template.student')

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
<div class="col-md-12">
<div class="section-title text-center">
<h4>Join a Class</h4>
<p>Fill the form to make a class please, {{Session('fullname_user')}}</p>
</div>
</div>
<!-- form-->

<form method="post" action="{{url('/join-class-process')}}">
{{ csrf_field() }}
<label for="class_name">Class Join Code</label>
<div class="form-group">
<input type="text" name="class_code" id="class_code" class="form-control" placeholder="Class Join Code" value="" required="">
</div>
<div class="form-group">
<input type="hidden" name="id_murid" id="id_murid" class="form-control" placeholder="{{Session('id_user')}}" value="{{Session('id_user')}}"> 
</div>
<p style="color:grey;"><i>*Class join code are formed from 6 words and number
</i></p>
<p style="color:grey;"><i>*You cannot join the class which you have joined before</i></p>
<center>
<button type="submit" class="btn btn-default btn-lg" >Join Class</button>
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