<div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
            
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="dropdown-item has-icon"> <i class="fa fa-user"></i></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello {{ Str::limit(Auth::user()->name) }}</div>
              <a href="/viewprofile" class="dropdown-item has-icon"> <i class="fas fa-id-card"></i>
                Edit Profile
              </a>
              <div class="dropdown-divider"></div>
              <Form action="{{ route('logout') }}" method="POST" id="logout">
                @csrf
                <a href="javascript:void(0)" class="dropdown-item has-icon text-danger" onclick="document,getElementById('logout').submit();"><i class="fas fa-sign-out-alt"></i>
                  Logout
                </a>
              </Form>
            </div>
          </li>
        </ul>
      </nav>