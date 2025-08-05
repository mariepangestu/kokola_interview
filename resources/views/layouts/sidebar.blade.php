<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex " href="index.html">
        <div class="sidebar-brand-text mx-3">KOKOLA</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('plant_product.index') }}">
            <i class="fas fa-clock"></i>
            <span>PLANT PRODUCT(A)</span></a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('string_search.index') }}">
            <i class="fas fa-clock"></i>
            <span>STRING SEARCH(B)</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
