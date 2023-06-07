<nav class="navbar navbar-expand-lg bg-white fixed-top scrolling-navbar navbar-fix">
<div class="container">
<div class="navbar-header">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
<span class="lni-menu"></span>
<span class="lni-menu"></span>
<span class="lni-menu"></span>
</button>
<a href="{{ route('index')}}" class="navbar-brand logo-margin"><img src="{{ asset('front/assets/img/logo.svg')}}"  alt="logo"  ></a>
</div>
<div class="collapse navbar-collapse" id="main-navbar">
<ul class="navbar-nav mr-auto w-100 justify-content">
<!-- <li class="nav-item ">
<a class="nav-link " href="#">About Us
</a>
</li> -->
<li class="nav-item ">
<a class="nav-link " href="#">How <span class="lowercase">it works</span>
</a>
</li>
 
<li class="nav-item">
<a class="nav-link " href="{{ route('explore')}}"> Find <span class="lowercase">a Tutor</span>
</a>
</li>

<li class="nav-item">
<a class="nav-link " href="{{ route('teachers-sign-up')}}">Become <span class="lowercase">a Tutor</span> 
</a>
</li>
<li class="nav-item">
<a class="nav-link " href="#">Resources
</a>
</li>
@if (Session::get('authentication') == false)
<li class="nav-item">
<a class="nav-link " href="{{ route('sign-in')}}">Login
</a>
</li>
@endif
@if (Session::get('authentication') == true)
<li class="dropdown">
<a href="#" data-toggle="dropdown"class="nav-link dropdown-toggle nav-link-lg nav-link-user">
@if ($personal_infos->profile_photo == null)
<img alt="image" src="{{ asset('back/assets/img/user.svg')}}" height="30" width="30" class="rounded">  
@else
<img alt="image" src="{{ asset(Session::get('photo'))}}" height="30" width="30" class="user-img-radious-style link-radius">
@endif  
 <span class="d-sm-none d-lg-inline-block" style="color:black;"> {{Session::get('first_name')}} <i class="ml-2 lni-chevron-down font-12"></i></span>  
</a>
<div class="dropdown-menu dropdown-menu-right pullDown">
<div class="dropdown-title"></div>
@if(Session::get('privilege') == 2)
<a href="{{ route('teachers-dashboard')}}" class="dropdown-item has-icon"> <i class="far fa-user"></i> Dasboard</a>
<a href="{{ route('teachers-profile-setting')}}" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
Settings
</a>
@elseif (Session::get('privilege') == 3) 
<a href="{{ route('parents-dashboard')}}" class="dropdown-item has-icon"> <i class="far fa-user"></i> Dasboard</a>
 <a href="{{ route('parentssettings.create')}}" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
Settings
</a>
@endif

<div class="dropdown-divider"></div>
<a href="{{ route('app-logout')}}" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
Logout
</a>
</div>
</li>
@endif
 </ul>
@if (Session::get('authentication') == false)
<div class="post-btn">
<a class="btn btn-common" href="{{ route('choose-profile')}}"> Sign up for free</a>
</div>
@endif
</div>
</div>
<ul class="mobile-menu">
<li class="mt-3"><a href="#">About us</a></li>

@if (Session::get('authentication') == true)

@if(Session::get('privilege') == 2)
<li class=""><a href="{{ route('teachers-dashboard')}}">Dashboard</a></li> 
@elseif(Session::get('privilege') == 3)
<li class=""><a href="{{ route('parents-dashboard')}}">Dashboard</a></li>
@endif

@else
<li class=""><a href="{{ route('sign-in')}}">Login</a></li> 
@endif
<li>
<a href="#">Pages</a>
<ul class="dropdown">
<li>
<a class="nav-lin" href="{{ route('explore')}}"> Find <span class="lowercase">a Tutor</span></a>
</li>
<li><a href="{{ route('teachers-sign-up')}}">Become a tutor</a></li>
<li><a href="#">Resources </a></li> 
</ul>
</li>
</ul>
</nav>

 
 
 