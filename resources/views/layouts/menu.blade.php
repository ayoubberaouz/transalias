<style>
    [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active,
    [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:focus,
    [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:hover {
        background-color: #007bff !important;
        color: #fff !important;
    }
</style>

@php
    $urlAdmin = config('fast.admin_prefix');
@endphp

@can('dashboard')
    @php
        $isDashboardActive = Request::is($urlAdmin);
    @endphp
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link {{ $isDashboardActive ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Tableau de bord</p>
        </a>
    </li>
@endcan

{{-- @can('generator_builder.index')
    @php
        $isUserActive = Request::is($urlAdmin . '*generator_builder*');
    @endphp
    <li class="nav-item">
        <a href="{{ route('generator_builder.index') }}" class="nav-link {{ $isUserActive ? 'active' : '' }}">
            <i class="nav-icon fas fa-coins"></i>
            <p>@lang('menu.generator_builder.title')</p>
        </a>
    </li>
@endcan --}}

@canany(['users.index', 'roles.index'])
    @php
        $isUserActive = Request::is($urlAdmin . '*users*');
        $isRoleActive = Request::is($urlAdmin . '*roles*');
    @endphp
    <li class="nav-item {{ $isUserActive || $isRoleActive ? 'menu-open' : '' }} ">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-shield-virus"></i>
            <p>
                Sécurité
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('users.index')
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ $isUserActive ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users ml-2"></i>
                        <p>
                            Utilisateurs
                        </p>
                    </a>
                </li>
            @endcan
            @can('roles.index')
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link {{ $isRoleActive ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-shield ml-2"></i>
                        <p>
                            @lang('menu.user.roles')
                        </p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcan

{{-- <li class="nav-item">
    <a href="{{ route('historiques.index') }}"
       class="nav-link {{ Request::is('historiques*') ? 'active' : '' }}">
        <p>@lang('models/historiques.plural')</p>
    </a>
</li> --}}

@can('historiques.index')
    @php
        $isHistoriqueActive = Request::is($urlAdmin . '*historiques*');
    @endphp
    <li class="nav-item">
        <a href="{{ route('historiques.index') }}" class="nav-link {{ $isHistoriqueActive ? 'active' : '' }}">
            <i class="nav-icon fas fa-clock"></i>
            <p>@lang('models/historiques.plural')</p>
        </a>
    </li>
@endcan

@canany(['dossiers.index', 'index-cloture', 'index-valide', 'show-valide'])
    @php
        $isDossierActive = Request::is($urlAdmin . '*dossiers*');
        $isDossierClotureActive = Request::is($urlAdmin . '*index-cloture*');
        $isDossierValideActive = Request::is($urlAdmin . '*index-valide*');
        $isDossierShowValideActive = Request::is($urlAdmin . '*show-valide*');
    @endphp
    <li class="nav-item {{ $isDossierActive || $isDossierClotureActive || $isDossierValideActive || $isDossierShowValideActive ? 'menu-open' : '' }} ">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-folder"></i>
            <p>
                Dossiers Transport
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('dossiers.index')
                <li class="nav-item">
                    <a href="{{ route('dossiers.index') }}" class="nav-link {{ $isDossierActive ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder-open ml-2"></i>
                        <p>@lang('models/dossiers.plural')</p>
                    </a>
                </li>
            @endcan
            @can('index-cloture')
                <li class="nav-item">
                    <a href="{{ route('index-cloture') }}" class="nav-link {{ $isDossierClotureActive ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder-open ml-2"></i>
                        <p>@lang('models/dossiers.plural') Clôturés</p>
                    </a>
                </li>
            @endcan
            @canany(['index-valide', 'show-valide'])
                <li class="nav-item">
                    <a href="{{ route('index-valide') }}" class="nav-link {{ $isDossierValideActive || $isDossierShowValideActive ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder-open ml-2"></i>
                        <p>Dossiers Validés</p>
                    </a>
                </li>
            @endcanany
        </ul>
    </li>
@endcanany

@can('clients.index')
    @php
        $isClientActive = Request::is($urlAdmin . '*clients*');
    @endphp
    <li class="nav-item">
        <a href="{{ route('clients.index') }}" class="nav-link {{ $isClientActive ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            <p>@lang('models/clients.plural')</p>
        </a>
    </li>
@endcan

@can('transporteurs.index')
    @php
        $isTransporteursActive = Request::is($urlAdmin . '*transporteurs*');
    @endphp
    <li class="nav-item">
        <a href="{{ route('transporteurs.index') }}" class="nav-link {{ $isTransporteursActive ? 'active' : '' }}">
            <i class="nav-icon fas fa-truck"></i>
            <p>@lang('models/transporteurs.plural')</p>
        </a>
    </li>
@endcan

@can('transitaireAlgs.index')
    @php
        $isTransitaireAlgsActive = Request::is($urlAdmin . '*transitaireAlgs*');
    @endphp
    <li class="nav-item">
        <a href="{{ route('transitaireAlgs.index') }}" class="nav-link {{ $isTransitaireAlgsActive ? 'active' : '' }}">
            <i class="nav-icon fas fa-truck"></i>
            <p>Transitaires Alg</p>
        </a>
    </li>
@endcan

@can('transitaireTangers.index')
    @php
        $isTransitaireTangersActive = Request::is($urlAdmin . '*transitaireTangers*');
    @endphp
    <li class="nav-item">
        <a href="{{ route('transitaireTangers.index') }}"
            class="nav-link {{ $isTransitaireTangersActive ? 'active' : '' }}">
            <i class="nav-icon fas fa-truck"></i>
            <p>Transitaires Tanger</p>
        </a>
    </li>
@endcan

@canany(['facturesDossiers.index', 'index-non-facturer'])
    @php
        $isFacturesDossiersActive = Request::is($urlAdmin . '*facturesDossiers*');
        $isNonFacturesDossiersActive = Request::is($urlAdmin . '*index-non-facturer*');
    @endphp
    <li class="nav-item {{ $isFacturesDossiersActive || $isNonFacturesDossiersActive ? 'menu-open' : '' }} ">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
                Gestion Facturation
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('index-non-facturer')
                <li class="nav-item">
                    <a href="{{ route('index-non-facturer') }}"
                        class="nav-link {{ $isNonFacturesDossiersActive ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt ml-2"></i>
                        <p>A Facturer</p>
                    </a>
                </li>
            @endcan
            @can('facturesDossiers.index')
                <li class="nav-item">
                    <a href="{{ route('facturesDossiers.index') }}"
                        class="nav-link {{ $isFacturesDossiersActive ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt ml-2"></i>
                        <p>Factures</p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcan

@canany(['noteDebitDossiers.index', 'index-non-debiter'])
    @php
        $isNoteDebitDossiersActive = Request::is($urlAdmin . '*noteDebitDossiers*');
        $isNonDebiterDossiersActive = Request::is($urlAdmin . '*index-non-debiter*');
    @endphp
    <li class="nav-item {{ $isNoteDebitDossiersActive || $isNonDebiterDossiersActive ? 'menu-open' : '' }} ">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
                Gestion Notes Débit
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('index-non-debiter')
                <li class="nav-item">
                    <a href="{{ route('index-non-debiter') }}"
                        class="nav-link {{ $isNonDebiterDossiersActive ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt ml-2"></i>
                        <p>A Noter Débit</p>
                    </a>
                </li>
            @endcan
            @can('noteDebitDossiers.index')
                <li class="nav-item">
                    <a href="{{ route('noteDebitDossiers.index') }}"
                        class="nav-link {{ $isNoteDebitDossiersActive ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt ml-2"></i>
                        <p>Notes de Débit</p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcan
