<footer>
<section class="footer-Content">
<div class="container">
<div class="row">
<div class="col-lg-4 col-md-4 col-xs-6 col-mb-12">
<div class="widget">
<div class="footer-logo"><img src="{{ asset('front/assets/img/logo.svg')}}" alt=""></div>
<div class="textwidget">
<p> Olukotide is a learning exchange platform providing access to limitless resources, teaching and learning across the world. It is your one stop shop for ease and empowerment to our target audience.</p>
</div>
</div>
</div>
<div class="col-lg-2 col-md-2 col-xs-6 col-mb-12">
<div class="widget widget_margin">
<h3 class="block-title ml-3">Categories</h3>
<ul class="about-footer">
@foreach ($categories as $category)
<li><a href="{{ route('fliter-page',['model'=>'cat','search'=>$category->id])}}" class="btn btn-icon icon-left">{{$category->title}}</a></li>  
@endforeach
</ul>
</div>
</div>
<div class="col-lg-2 col-md-2 col-xs-6 col-mb-12">
<div class="widget">
<h3 class="block-title ml-3">About</h3>
<ul class="about-footer">
<li><a href="#" class="btn">About Us</a></li>
<li><a href="#"class="btn">Become a Tutor</a></li>
<li><a href="#"class="btn">FAqs</a></li>
<li><a href="#"class="btn">Careers</a></li>
<li><a href="#"class="btn">Contact Us</a></li>
</ul>
 </div>
</div>

<div class="col-lg-2 col-md-2 col-xs-6 col-mb-12">
<div class="widget">
<h3 class="block-title ml-3">Support</h3>
<ul class="about-footer">
<li><a href="#" class="btn">Help & Support</a></li>
<li><a href="{{ route('policy')}}" class="btn">Privacy Policy</a></li>
<li><a href="{{ route('terms')}}" class="btn">Terms of service</a></li>
<li><a href="#" class="btn">Cookie Settings</a></li>
 </ul>
 </div>
</div>

<div class="col-lg-2 col-md-2 col-xs-6 col-mb-12 ">
<div class="widget">
<h3 class="block-title ml-3">Follow Us</h3>
<ul class="mt-3 footer-social">
<li><a class="facebook mt-1" href="#"><i class="lni-facebook-filled"></i></a></li>
<li><a class="facebook mt-1" href="#"><i class="lni-twitter-filled"></i></a></li>
<li><a class="linkedin mt-1" href="#"><i class="lni-linkedin-fill"></i></a></li>
<li><a class="instagram mt-1" href="#"><i class="lni-instagram"></i></a></li>
</ul>
</div>
</div>

</div>
</div>
</section>


<div id="copyright">
<div class="container">
<div class="row">
<div class="col-md-12 text-black">
<div class="site-info text-center">
<p><a target="_blank" >{{date('Y')}}   &copy; Olukotide. All rights reserved.</i></a></p>
</div>
</div>
</div>
</div>
</div>
</footer>
