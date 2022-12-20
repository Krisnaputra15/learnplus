@extends('template.teacher')

@section('content')

<section class="white section">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="section-title text-center">
<h4>Your Class</h4>
<p>Listed Below The Class Lectured by {{Session::get('fullname_user')}}</p>
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
</div>
</div>
<div class="row course-list">
@if($forcount > 0)
@if($forcount < 2 || $forcount == 1)
<div class="col-md-3 col-sm-6 col-xs-12">
<div class="shop-item-list entry">
<div class="">
<img src="{{asset('upload/sampul_kelas/'.$classes2->picture)}}" alt="">
<div class="magnifier">
</div>
</div>
<div class="shop-item-title clearfix">
<h4><a href="{{url('class-'.$classes2->id.'-topics')}}">{{$classes2->nama_kelas}}</a></h4>
<div class="shopmeta">
@if($classes2->jumlah_murid != null)
<span class="pull-left">{{$classes2->jumlah_murid}} student(s)</span>
@else
<span class="pull-left">No student yet</span>
@endif
<div class="rating pull-right">
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
</div>
</div>
</div>
<div class="visible-buttons">
<a title="Edit Class" href="{{url('/class-'.$classes2->id.'-edit')}}"><span class="fa fa-gear"></span></a>
<a title="Delete Class" href="{{url('/class-'.$classes2->id.'-delete')}}"><span class="fa fa-trash-o"></span></a>
</div>
</div>
</div>


@else
@foreach($classes2 as $classes2)
<div class="col-md-3 col-sm-6 col-xs-12">
<div class="shop-item-list entry">
<div class="">
<img src="{{asset('upload/sampul_kelas/'.$classes2->picture)}}" alt="">
<div class="magnifier">
</div>
</div>
<div class="shop-item-title clearfix">
<h4><a href="{{url('class-'.$classes2->id.'-topics')}}">{{$classes2->nama_kelas}}</a></h4>
<div class="shopmeta">
@if($classes2->jumlah_murid != null)
<span class="pull-left">{{$classes2->jumlah_murid}} student(s)</span>
@else
<span class="pull-left">No student yet</span>
@endif
<div class="rating pull-right">
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
</div>
</div>
</div>
<div class="visible-buttons">
<a title="Edit Class" href="{{url('/class-'.$classes2->id.'-edit')}}"><span class="fa fa-gear"></span></a>
<a title="Delete Class" href="{{url('/class-'.$classes2->id.'-delete')}}"><span class="fa fa-trash-o"></span></a>
</div>
</div>
</div>

@endforeach
@endif
@else
<div class="section-title text-center">
<h2><i>Oops!<br> Look like you haven't made any class yet.<br> make a class by clicking </i><a href="{{url('make-class')}}"><i>this link</i></a><br></i></h2>
</div>
@endif

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