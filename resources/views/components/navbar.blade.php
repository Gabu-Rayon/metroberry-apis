<nav class="navbar-custom-menu navbar navbar-expand-lg m-0 border-bottom shadow-none">

    <div class="sidebar-toggle-icon" id="sidebarCollapse">
        sidebar toggle<span></span>
    </div>
    <!--/.sidebar toggle icon-->
    <div class="navbar-icon d-flex">
        <ul class="navbar-nav flex-row align-items-center ">
            <li class="nav-item dropdown language-menu notification  me-3">
                <a class="language-menu_item border rounded-circle d-flex justify-content-center align-items-center overflow-hidden"
                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                    <img src="">
                </a>
                <div class="dropdown-menu language_dropdown">
                    <a href="lang/en" class="language_item d-flex align-items-center gap-3">
                        <img src="">
                        <span>
                            English
                        </span>
                    </a>
                    <a href="lang/bn" class="language_item d-flex align-items-center gap-3">
                        <img src="">
                        <span>
                            Swahili
                        </span>
                    </a>
                    <a href="lang/ar" class="language_item d-flex align-items-center gap-3">
                        <img src="">
                        <span>
                            French
                        </span>
                    </a>
                </div>
                <!--/.dropdown-menu -->
            </li>
            <!--/.dropdown-->
            <li class="nav-item dropdown user_profile me-2">
                <a class="dropdown-toggle user_profile_item border rounded-circle  d-flex justify-content-center align-items-center overflow-hidden"
                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class='img-fluid' src="{{ url('storage/' . \Auth::user()->avatar) }}" alt="Avatar">
                </a>
                <div class="dropdown-menu">
                    <div class="d-flex align-items-center gap-3 border-bottom pb-3">
                        <div class="user_img">
                            <img src="{{ url('storage/' . \Auth::user()->avatar) }}" alt="Avatar">
                        </div>
                        <div>
                            <p class="mb-0 fw-bold fs-16">
                                {{ Auth::user()->name }}
                                <span class="badge bg-primary">{{ \Auth::user()->role }}</span>
                            </p>
                        </div>
                    </div>

                    <ul class="list-unstyled mt-3  dropdown_menu_inner">
                        <li class="">
                            <a class="d-block" href="{{ route('profile.edit') }}">My profile</a>
                        </li>
                        <li class="">
                            <a class="d-block" href="user/profile-setting">Account settings</a>
                        </li>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            @METHOD('POST')
                            <button type="submit" id="logout-btn" class="btn_sign_out text-black w-auto">
                                Sign out
                            </button>
                        </form>
                        <link href="{{ asset('admin-assets/css/logout.css?v=1') }}" rel="stylesheet">

                    </ul>


                </div>
                <!--/.dropdown-menu -->
            </li>
        </ul>
        <!--/.navbar nav-->

    </div>
</nav>
