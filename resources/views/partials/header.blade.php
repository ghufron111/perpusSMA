<header class="navbar sticky-top bg-dark">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">
        @if (Auth::check())
            {{ Auth::user()->username }}
        @else
            ADMIN
        @endif
    </a>
    <form id="logoutForm" action="/logout" method="post" class="d-flex" style="margin-right: 1.5rem;">
        @csrf
        <button class="btn btn-dark" type="submit" style="border-color: #b81414;">
            <span class="text-white">LOGOUT</span>
        </button>
    </form>
</header>

<style>
    .btn-dark:hover {
        background-color: #b81414;
        border-color: #b81414;
    }
</style>