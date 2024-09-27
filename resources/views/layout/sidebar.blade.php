<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex align-items-center" href="/">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="">
            <span class="ms-1 font-weight-bold">Compress Video</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-70 h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-duotone fa-gauge {{ Request::is('dashboard') ? '' : 'text-dark' }} fs-6 "></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/history*') ? 'active' : '' }}" href="/dashboard/history">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i
                            class="fa-regular fa-rectangle-history {{ Request::is('dashboard/history*') ? '' : 'text-dark' }} fs-6 "></i>
                    </div>
                    <span class="nav-link-text ms-1">History Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/user') ? 'active' : '' }}" href="/dashboard/user">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-user {{ Request::is('dashboard/user') ? '' : 'text-dark' }} fs-6 "></i>
                    </div>
                    <span class="nav-link-text ms-1">Users</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
        <form action="/logout" method="post">
            @csrf
            <button type="submit" class="btn bg-gradient-primary mt-4 w-100" type="button">Logout</button>
        </form>
    </div>
</aside>
