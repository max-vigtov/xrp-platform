<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Inicio</div>
            <a class="nav-link" href="{{ route('panel') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Panel
            </a>
            {{-- <div class="sb-sidenav-menu-heading">Interface</div>
             <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Layouts
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                Pages
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                        Authentication
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="login.html">Login</a>
                            <a class="nav-link" href="register.html">Register</a>
                            <a class="nav-link" href="password.html">Forgot Password</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                        Error
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="401.html">401 Page</a>
                            <a class="nav-link" href="404.html">404 Page</a>
                            <a class="nav-link" href="500.html">500 Page</a>
                        </nav>
                    </div>
                </nav>
            </div> --}}
            <div class="sb-sidenav-menu-heading">Módulos</div>

            @can('ver-compra')
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePurchases" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-store"></i></div>
                Compras
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>

            <div class="collapse" id="collapsePurchases" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('purchase.index') }}">Ver</a>
                    @can('crear-compra')
                    <a class="nav-link" href="{{ route('purchase.create') }}">Crear</a>
                    @endcan
                </nav>
            </div>
            @endcan

            @can('ver-venta')
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSales" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                Ventas
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseSales" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('sale.index') }}">Ver</a>
                    <a class="nav-link" href="{{ route('sale.create') }}">Crear</a>
                </nav>
            </div>
            @endcan

            @can('ver-producto')
            <a class="nav-link" href="{{ route('product.index') }}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-mobile-screen"></i></div>
                Productos
            </a>
            @endcan

            @can('ver-cliente')
            <a class="nav-link" href="{{ route('client.index') }}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-people-group"></i></div>
                Clientes
            </a>
            @endcan

            @can('ver-proveedor')
            <a class="nav-link" href="{{ route('provider.index') }}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-box-open"></i></div>
                Proveedores
            </a>
            @endcan

            @can('ver-marca')
            <a class="nav-link" href="{{ route('brand.index') }}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-tag"></i></div>
                Marcas
            </a>
            @endcan

            @can('ver-categoría')
            <a class="nav-link" href="{{ route('category.index') }}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                Categorias
            </a>
            @endcan

            @can('ver-user')
            <a class="nav-link" href="{{ route('user.index') }}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                Usuarios
            </a>
            @endcan

            @can('ver-rol')
            <a class="nav-link" href="{{ route('role.index') }}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-sitemap"></i></div>
                Roles
            </a>
            @endcan
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Bienvenido:</div>
        {{ auth()->user()->name }}
    </div>
</nav>
