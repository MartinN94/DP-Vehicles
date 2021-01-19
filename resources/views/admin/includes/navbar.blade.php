<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <a class="navbar-brand" href="/"><i class="material-icons align-top">dashboard</i>   Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
      <span class="navbar-toggler-icon"></span>
  </button>
  <div id="navbarNavDropdown" class="navbar-collapse collapse">
      <ul class="navbar-nav ml-auto">
          <li class="dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
                <i class="material-icons align-top">account_circle</i>  
                @auth
                {{ Auth::user()->name }}
                @endauth
              </a>
              <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                   <i class="material-icons align-top">arrow_back</i>{{ __('Logout') }}
               </a>

               <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                   @csrf
               </form>
              </div>
          </li>
      </ul>
  </div>
</nav>