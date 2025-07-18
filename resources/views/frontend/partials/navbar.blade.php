<body>
    <!-- ======= Site Wrap =======-->
    <div class="site-wrap">
      <!-- ======= Header =======-->
      <header
        class="fbs__net-navbar navbar navbar-expand-lg dark"
        aria-label="PT Ghaleb Navbar"
      >
        <div
          class="container d-flex align-items-center justify-content-between"
        >
          <!-- Logo di Kiri -->
          <a class="navbar-brand" href="index.html">
            <img
              class="logo dark img-fluid"
              src="assets/images/logo-dark.svg"
              alt="Logo Ghaleb"
            />
            <img
              class="logo light img-fluid"
              src="assets/images/logo-light.svg"
              alt="Logo Ghaleb Light"
            />
          </a>

          <!-- Toggle Button untuk Mobile -->
          <button
            class="fbs__net-navbar-toggler justify-content-center align-items-center ms-auto"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#navbarOffcanvas"
            aria-controls="navbarOffcanvas"
            aria-label="Toggle navigation"
          >
            <svg
              class="fbs__net-icon-menu"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewbox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <line x1="21" x2="3" y1="6" y2="6"></line>
              <line x1="15" x2="3" y1="12" y2="12"></line>
              <line x1="17" x2="3" y1="18" y2="18"></line>
            </svg>
            <svg
              class="fbs__net-icon-close"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewbox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path d="M18 6 6 18"></path>
              <path d="m6 6 12 12"></path>
            </svg>
          </button>

          <!-- Menu Navbar -->
          <div
            class="offcanvas offcanvas-end"
            tabindex="-1"
            id="navbarOffcanvas"
            aria-labelledby="navbarOffcanvasLabel"
          >
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="navbarOffcanvasLabel">Menu</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
              ></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link scroll-link active" href="#home">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link scroll-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link scroll-link" href="#how-it-works"
                    >How It Works</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link scroll-link" href="#services">Services</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link scroll-link" href="#track"
                    >Track Document</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link scroll-link" href="#contact">Contact</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </header>