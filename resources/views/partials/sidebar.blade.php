<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">

          @if(auth()->user()->role_id == '2')

          <li class="nav-item">
            <a class="nav-link {{ Request::is('siswa') ? 'active' : '' }}" aria-current="page" href="/siswa">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('pinjambuku') ? 'active' : '' }}" href="/pinjambuku">
              <span data-feather="file"></span>
              Peminjaman Buku
            </a>
          </li>

          @else

          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('pinjam') ? 'active' : '' }}" href="/pinjam">
              <span data-feather="file"></span>
              Peminjaman Buku
            </a>
          </li>

          @endif

          @if(auth()->user()->role_id == '2')

          <li class="nav-item">
              <a class="nav-link dropdown-btn {{ Request::is('buku/novel') || Request::is('buku/majalah') || Request::is('buku/paket') ? 'active' : '' }}" style="cursor: pointer;"><span data-feather="shopping-cart"></span>
                  Katalog Buku</a>
              <ul class="nav-item dropdown-container">
                  <a class="nav-link dropdown-item {{ Request::is('buku/novel') ? 'active' : '' }}" href="/buku/novel">Buku Novel</a>
                  <a class="nav-link dropdown-item {{ Request::is('buku/majalah') ? 'active' : '' }}" href="/buku/majalah">Buku Majalah</a>
                  <a class="nav-link dropdown-item {{ Request::is('buku/paket') ? 'active' : '' }}" href="/buku/paket">Buku Paket</a>
              </ul>
          </li>



          @else

          <li class="nav-item">
            <a class="nav-link {{ Request::is('buku') ? 'active' : '' }}" href="/buku">
              <span data-feather="shopping-cart"></span>
              Katalog Buku
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('anggota') ? 'active' : '' }}" href="/anggota">
              <span data-feather="users"></span>
              Keanggotaan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('laporan') ? 'active' : '' }}" href="/laporan">
              <span data-feather="bar-chart-2"></span>
              Pelaporan
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>
        </ul>    

        @endif

      </div>
    </nav>
    

 <style>
  
    .nav-link:hover{
      background-color: #55595c;
      color: #ffffff;
    }

    .dropdown-container {
      display: none;
    }

    .dropdown-btn.active .dropdown-container {
        display: block;
    }

 </style>

 <<script>
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block" && !this.classList.contains('active')) {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
}

window.onload = function() {
    var path = window.location.pathname;
    if (path.includes('/buku/novel') || path.includes('/buku/majalah') || path.includes('/buku/paket')) {
        for (var i = 0; i < dropdown.length; i++) {
            dropdown[i].classList.add("active");
            var dropdownContent = dropdown[i].nextElementSibling;
            dropdownContent.style.display = "block";
        }
    }
}


 </script>