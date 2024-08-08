<!DOCTYPE html>
<html lang="fr">
<head>
    <title>{{ __('Ministère de la Transition Numérique et de la Réforme de l\'Administration') }}</title>
    
    <link rel="icon" type="image/png" href="{{ asset('images/logo.svg') }}">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    
    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    
    <!-- jQuery -->
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    
    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    
    @yield('liens')

    @yield('style')
</head>
<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="{{ url('home') }}" class="brand">
            <img src="{{ asset('images/logoMinistere1.png') }}" class="navbar-brand-img mt-5" alt="main_logo" width="100" height="100">
        </a>
        <ul id="main-menu" class="side-menu top" style="padding-left: 0px;">
            <li class="active">
                <a href="{{ url('home') }}">
                    <i class='bx bxs-home' ></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            @can('voir division')
                <li>
                    <a href="{{ url('divisions') }}">
                        <i class='bx bxs-category'></i>
                        <span class="text">Divisions</span>
                    </a>
                </li>
            @endcan

            @can('voir service')
                <li>
                    <a href="{{ url('services') }}">
                        <i class='bx bxs-briefcase-alt'></i>
                        <span class="text">Services</span>
                    </a>
                </li>
            @endcan

            @can('voir projet')
                <li>
                    <a href="{{ url('projets') }}">
                        <i class='bx bxs-folder'></i>
                        <span class="text">Projets</span>
                    </a>
                </li>
            @endcan

            @can('voir document')
                <li>
                    <a href="{{ url('documents') }}">
                        <i class='bx bxs-file' ></i>
                        <span class="text">Documents</span>
                    </a>
                </li>
            @endcan

            @can('voir partenaire')
                <li>
                    <a href="{{ url('partenaires') }}">
                        <i class='bx bxs-network-chart'></i>
                        <span class="text">Partenaires</span>
                    </a>
                </li>
            @endcan

            @can('voir role')
                <li>
                    <a href="{{ url('roles') }}">
                        {{-- <i class='bx bxs-user-detail'></i> --}}
                        <i class='bx bxs-select-multiple'></i>
                        <span class="text">Roles</span>
                    </a>
                </li>
            @endcan

            @can('voir permission')
                <li>
                    <a href="{{ url('permissions') }}">
                        <i class='bx bxs-lock-open' ></i>
                        <span class="text">Permissions</span>
                    </a>
                </li>
            @endcan

            @can('voir utilisateur')
                <li>
                    <a href="{{ url('users') }}">
                        <i class='bx bxs-user-rectangle'></i>
                        <span class="text">Utilisateurs</span>
                    </a>
                </li>                
            @endcan

        </ul>
        <ul class="side-menu" style="padding-left: 0px;">
            <li>
                <a href="#">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="text-danger" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class='bx bxs-log-out-circle'></i>
                        <span class="text">Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <a href="{{ url('search') }}" class="nav-link">Recherche<i class='bx bx-search'></i></a>
            <form action="#">
                <div class="form-input">
                    <input type="hidden" name="forDesign"  style="border: none" >
                </div>
            </form>
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  {{Auth::user()->name}}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a 
                                class="dropdown-item text-danger" 
                                href="{{ route('logout') }}" 
                                onclick="event.preventDefault(); 
                                this.closest('form').submit();"
                            >
                                Logout
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>@yield('head-title')</h1>
                    <ul class="breadcrumb">
                        @yield('listeNav')
                    </ul>
                </div>
            </div>

            <div class="py-4">
                <div class="card border-0">
                    <div class="card-body px-0">
                        <div class="card border-0 shadow-none" style="overflow: hidden;">
                            <div class="card-body pt-0">
                                <div class="row">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="{{ asset('js/script.js') }}"></script>

    @yield('scripts')

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                "language": {
                    "sProcessing": "Traitement en cours...",
                    "sSearch": "Rechercher&nbsp;:",
                    "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments par page",
                    "sInfo": "",
                    "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                    "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    "sLoadingRecords": "Chargement en cours...",
                    "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
                    "oPaginate": {
                        "sFirst": "Premier",
                        "sPrevious": "Pr&eacute;c&eacute;dent",
                        "sNext": "Suivant",
                        "sLast": "Dernier"
                    },
                    "oAria": {
                        "sSortAscending": ": activer pour trier la colonne par ordre croissant",
                        "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                    },
                    "select": {
                        "rows": {
                            "_": "%d lignes s&eacute;lectionn&eacute;es",
                            "0": "Aucune ligne s&eacute;lectionn&eacute;e",
                            "1": "1 ligne s&eacute;lectionn&eacute;e"
                        }
                    }
                },
                "lengthMenu": [5, 10, 15, 20]
            });
        });
    </script>

</body>
</html>
