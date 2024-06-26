<div class="page-header" style="background-color: #AB764E;">
  <div class="header-wrapper row m-0">
    <div class="header-logo-wrapper col-auto p-0">
      <div class="logo-wrapper">
        <a href="">
          <img class="img-fluid" src="/assets/images/logo/logo.png" alt="">
        </a>
      </div>
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
    </div>
    <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
    </div>
    <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
      <ul class="nav-menus">
      @if (auth()->user()->role->name == "reseller")
      <a href="{{ route('keranjang') }}" class="mt-1" style="margin-right: 10px;" >
        <svg class="fill-icon" style="width: 20px; height: 20px; fill:white;">
          <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ecommerce') }}"></use>
        </svg>
      </a>
      <button class="badge {{ auth()->user()->reseller->status ? 'bg-success' : 'btn-danger' }}" disabled>{{ auth()->user()->reseller->status ? 'Aktif' : 'Nonaktif' }}</button>
      @endif
        <li class="profile-nav onhover-dropdown pe-0 py-0">
          <div class="media profile-media" style="align-items: center;">
            {{-- <img class="b-r-10" src="/assets/images/dashboard/profile.png" alt=""> --}}
            <div class="media-body" style="color: white; margin-left: 10px;"><span>{{ auth()->user()->name }}</span>
              <p class="mb-0 font-roboto" style="color: white;">{{ auth()->user()->role->name }} <i class="middle fa fa-angle-down"></i></p>
            </div>
          </div>
          <ul class="profile-dropdown onhover-show-div">
            @if (auth()->user()->role->name == "reseller")
            <li><a href="{{ route('profile') }}"><i data-feather="user"></i><span>Akun</span></a></li>
            @endif
            {{-- <li><a href="#"><i data-feather="settings"></i><span>Pengaturan</span></a></li> --}}
            <li>
              <form action="/signout" method="post" id="signoutForm">
                @csrf
                <a onclick="document.getElementById('signoutForm').submit(); return false;"><i data-feather="log-in">
                  </i><span>Keluar</span></a>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <script class="result-template" type="text/x-handlebars-template">
      <div class="ProfileCard u-cf">                        
      <div class="ProfileCard-avatar">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0">
          <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
          <polygon points="12 15 17 21 7 21 12 15"></polygon>
        </svg>
      </div>
      <div class="ProfileCard-details">
      {{-- <div class="ProfileCard-realName">{{name}}</div> --}}
      </div>
      </div>
    </script>
    <script class="empty-template" type="text/x-handlebars-template">
      <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div>
    </script>
  </div>
</div>
