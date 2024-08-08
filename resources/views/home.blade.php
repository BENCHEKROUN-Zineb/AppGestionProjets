{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.sidebar')

@section('content')
<div class="container my-5" style="border: none;">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="jumbotron bg-light p-4 d-flex justify-content-center align-items-center">
                        <img src="{{ asset('images/logoMinistere1.png') }}" class="navbar-brand-img ml-4" alt="main_logo" width="100" height="100">

                        <div class="ml-4">
                            <h4 class="display-5">Bienvenue !</h4>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5>Direction de l’Inclusion Numérique et Développement des Talents Digitaux</h5>
                        <p class="text-justify">La Direction de l’Inclusion Numérique et Développement des Talents Digitaux est une division clé du Ministère de la Transition Numérique et de la Réforme Administrative. Son rôle principal est de promouvoir l'inclusion numérique et de développer les compétences digitales nécessaires pour faire face aux défis et aux opportunités de l'ère numérique.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection






