<aside class="main-sidebar elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link d-flex justify-content-center p-0" style="background-color: #fff">
        <span class="brand-text"><img src="{{ url('images/transalias_logo.png') }}" width="120px"
                style="border-radius: 30%"></span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pill nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>
</aside>
