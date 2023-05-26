<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="{{ asset('media/img/alfari/icon.png') }}" alt="Alfari Studio" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Alfari Studio</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image mt-2">
          <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Aliffathur Risqi Hidayat</a>
          <small class="d-block text-white">Admin</small>
        </div>      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item {{ request()->is('example/*') ? 'menu-open' : '' }}">
              <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                <i class="nav-icon bi bi-pie-chart"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
            </li>
            <li class="nav-item {{ request()->is('product/*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-box2"></i>
                  <p>
                    Produk
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item">
                        <a href="{{ route('product-index') }}" class="nav-link {{ request()->is('product/master') ? 'active' : '' }}">
                          <p class="ml-3">Produk</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('product-category') }}" class="nav-link {{ request()->is('product/categories') ? 'active' : '' }}">
                        <p class="ml-3">Kategori</p>
                        </a>
                    </li>
                </ul>
              </li>

              <li class="nav-item {{ request()->is('transaction/*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-cash-coin"></i>
                  <p>
                    Transaksi
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item">
                        <a href="{{ route('product-index') }}" class="nav-link {{ request()->is('product/master') ? 'active' : '' }}">
                          <p class="ml-3">Sales</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('transaction-purchasing') }}" class="nav-link {{ request()->is('transaction/purchasing') ? 'active' : '' }}">
                        <p class="ml-3">Stock In</p>
                        </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('product-category') }}" class="nav-link {{ request()->is('product/categories') ? 'active' : '' }}">
                      <p class="ml-3">Stock Out</p>
                      </a>
                  </li>
                </ul>
              </li>

            {{-- <li class="nav-item">
              <a href="#" class="nav-link {{ request()->is('widgets/') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Widgets
                  <span class="right badge badge-danger">New</span>
                </p>
              </a>
            </li>
            <li class="nav-item {{ request()->is('tables/*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Tables
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('tables-simple') }}" class="nav-link {{ request()->is('tables/simple') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-ellipsis-h"></i>
                    <p>Simple Tables</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('tables-datatable') }}" class="nav-link {{ request()->is('tables/datatable') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>DataTables</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/tables/jsgrid.html" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>jsGrid</p>
                  </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <p>Menu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <p class="ml-3">Other Menu</p>
                    </a>
                </li>
              </ul>
            </li>
            <li class="nav-header">HEADER</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Example
                  <span class="badge badge-info right">2</span>
                </p>
              </a>
            </li> --}}

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
