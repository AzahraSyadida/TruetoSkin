<nav 
    class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" 
    data-aos="fade-down" 
> 
    <div class="container"> 
        <a href="{{ route('home') }}" class="navbar-brand"> 
            <img src="{{ asset('images/logo2.svg') }}" alt="Logo" /> 
        </a> 
        <button 
            class="navbar-toggler" 
            type="button" 
            data-toggle="collapse" 
            data-target="#navbarResponsive" 
        > 
            <span class="navbar-toggler-icon"></span> 
        </button> 
        <div class="collapse navbar-collapse" id="navbarResponsive"> 
            <ul class="navbar-nav ml-auto"> 
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}"> 
                    <a href="{{ route('home') }}" class="nav-link">Home</a> 
                </li> 
                <li class="nav-item {{ request()->is('categories') ? 'active' : '' }}"> 
                    <a href="{{ route('categories') }}" class="nav-link">Categories</a> 
                </li> 
                <li class="nav-item {{ request()->is('rewards') ? 'active' : '' }}"> 
                    <a href="{{ route('about') }}" class="nav-link">About Us</a> 
                </li> 
            </ul> 
        </div> 
    </div> 
</nav>