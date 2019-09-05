<!-- Topbar -->

<link href="{{ asset('css/modifid.css') }}" rel="stylesheet" type="text/css">

<nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow">

  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <!-- Topbar Search -->
           
                 <div class="container">
                 <div class="row container-width"> 
                  <div class="col-xl-2 mainLogo">
                       <img src="/image/logo_amz.png" alt="">
                   </div>

                  <div class="col-xl-10 container-principal-menu">
                  <div class="col-xl-6 inputBar">
                  {!! Form::open(array('url' => 'testing','method' => 'GET')) !!}
                    <div class ="row">
                      <div class ="col-xl-6">
                        <select id="selectSellers" name="seller">
                        @foreach($taken2 as $profile)
                                <option value="{{ $profile->seller_id }}">{{$profile->name}}</option>
                        @endforeach   
                        </select>
                      </div>
                      <div class ="col-xl-3">
                        <button type="button" class="btn btn-outline-warning margin-button-dropdown">Reset</button>
                      </div>
                      <div class ="col-xl-3">
                        {!! Form::submit('Apply',['class'=>'btn btn-outline-warning']) !!}
                      </div>
                    </div>
                    <div role="separator" class="dropdown-divider"></div>
                    <div class="row">
                      <div class ="col-xl-12">
                        <div class = "row">
                          <label name="typeAccount" class="dropdown-item col-xl-4" href="#"><input type="checkbox" class="radio"  name="amazon" value="US" >Amazon.com (Default)</label> 
                          <label name="typeAccount" class="dropdown-item col-xl-4" href="#" ><input type="checkbox" class="radio" name="amazon" value="CA" >Amazon.ca </label>   
                          <label name="typeAccount" class="dropdown-item col-xl-4" href="#" ><input type="checkbox" class="radio" name="amzon" value="MX" >Amazon.mx</label> 
                        </div>
                      </div>
                    </div>
                  {!! Form::close() !!}  
                  </div>                    
                  <div class="col-xl-2 buttonLi">
                      <button type="button" class="btn btn-outline-warning">Account Manager</button>
                  </div>
                  <div class="col-xl-2 buttonLi">
                      <button type="button" class="btn btn-outline-warning">Automated Rules</button>
                  </div>
                  <div class="col-xl-2 buttonLi">
                      <button type="button" class="btn btn-outline-warning">Reports</button>
                  </div>
              </div>
            </div>
                  

              <!-- Topbar Navbar -->
              <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                  <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                  </a>
                  <!-- Dropdown - Messages -->
                  <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                      <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                          <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </li>

                          

               {{--  <div class="topbar-divider d-none d-sm-block"></div> --}}

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">

                  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                    <img class="img-profile rounded-circle" src="https://source.unsplash.com/iFgRcqHznqg">
                  </a>
                  
                  <!-- Dropdown - User Information -->
                  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">
                      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                      Profile
                    </a>
                    <a class="dropdown-item" href="#">
                      <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                      Settings
                    </a>
                    {{-- <a class="dropdown-item" href="#">
                      <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                      Activity Log
                    </a> --}}
                    <div class="dropdown-divider"></div>
 {{--  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
      Logout
    </a> --}}

    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
    Logout
  </a>

  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
  </form>

</div>
</li>

</ul>
 
</div>
</nav>
<!-- End of Topbar -->