<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link @if (!request()->routeIs('admin.dashboard')) {{ 'collapsed' }} @endif" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        
        <li class="nav-item">
            <a class="nav-link @if (!request()->routeIs('admin.recipes.index')) {{ 'collapsed' }} @endif" href="{{ route('admin.recipes.index') }}">
                <i class="fa fa-utensils"></i>
                <span>Recipes</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (!request()->routeIs('admin.ingredients.index')) {{ 'collapsed' }} @endif" href="{{ route('admin.ingredients.index') }}">
                <i class="fa fa-lemon"></i>
                <span>Ingredients</span>
            </a>
        </li>
    </ul>

</aside><!-- End Sidebar-->