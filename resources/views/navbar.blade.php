
<nav class="navbar navbar-dark bg-dark b-block bt-5 justify-content-between shadow" style="width:100vw; position:fixed; top: 0px; z-index:1001">
  <a class="navbar-brand" href="{{ route('profile') }}">Home</a>
  <div class="right mr-2">
    @if ( Auth::check() && auth()->user()->role == "admin" && request()->route()->getName() != "dashboard" )
    <a href="{{ route("dashboard") }}" class="btn btn-secondary btn-sm text-white ">
        Dashboard
    </a>
    @endif
    @if( request()->route()->getName() == "profile" || request()->route()->getName() == "dashboard" )
    <a href="{{ route('logout') }}" class="btn btn-danger btn-sm text-white mx-2">logout</a>
    @endif
  </div>
</nav>

<div class="padding py-5"></div>
