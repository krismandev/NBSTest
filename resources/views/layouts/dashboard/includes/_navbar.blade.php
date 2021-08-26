<?php
  $user = auth()->user();
 ?>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="brand">
    <!-- <a href="index.html"><img src="{{asset('assets/img/cl1.png')}}" alt="Klorofil Logo" class="img-responsive logo" style="width:100px; height:50px;"></a> -->
  </div>
  <div class="container-fluid">
    <div class="navbar-btn">
      <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
    </div>

    <div id="navbar-menu">
      <ul class="nav navbar-nav navbar-right">


        <li class="dropdown">
          <a href="#" class="dropdown-toggle active" data-toggle="dropdown"><img src="" class="img-circle"> <span>{{auth()->user()->name}}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
          <ul class="dropdown-menu">
            {{-- <li><a href=""><i class="lnr lnr-user"></i> <span>Profile</span></a></li> --}}
            <li><a href="{{route('logout')}}"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
          </ul>
        </li>

      </ul>
    </div>
  </div>
</nav>
