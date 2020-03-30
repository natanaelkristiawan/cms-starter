<ul class="nav metismenu" id="side-menu">
	<li class="nav-header">
	  <div class="dropdown profile-element">
      <img alt="image" class="rounded-circle" src="{{ asset('template/admin') }}/img/profile_small.jpg"/>
      <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <span class="block m-t-xs font-bold">{{ ucwords(Auth::guard('admin')->user()->name) }}</span>
        <span class="text-muted text-xs block">Administrator <b class="caret"></b></span>
      </a>
      <ul class="dropdown-menu animated fadeInRight m-t-xs">
        <li><a class="dropdown-item" href="profile.html">Profile</a></li>
        <li class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
      </ul>
	  </div>
	  <div class="logo-element">
	      ET+
	  </div>
	</li>
  @foreach($groups as $group)
    {!! $group !!}
  @endforeach
</ul>
