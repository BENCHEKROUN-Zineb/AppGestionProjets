@extends('layouts.sidebar')

@php
    use Carbon\Carbon;
@endphp

@section('head-title')
    Details Projets
@endsection 

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a href="#">Projets</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a class="active" href="#">Details Projets</a>
    </li>
@endsection

@section('content')
    <div class="d-flex justify-content-end align-items-center mb-3">
        <a href="{{ url('projets') }}" class="btn btn-primary">Retour</a>
    </div>
    <div class="container">
        <div class="row">
            {{-- partie 1 --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Information Projet
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $projet->nomP }}</h5>
                        <p style="font-size: 16px">{{ $projet->descriptionP }}</p>
                        <!-- Add more project details here as needed -->
                        @foreach ($projet->partenaires as $partenaire)
                            <span class="badge text-bg-secondary mx-1 mb-3">{{ $partenaire->nomPa }}</span>
                        @endforeach
                        <p class="card-text" style="font-size: 12px">Dernière Modification: {{ Carbon::parse($projet->updated_at)->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            {{-- partie 2 --}}
            <div class="col-md-6">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Documents</button>
                        @can('ajouter document')
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Importer</button>
                        @endcan
                        {{-- <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Chercher</button> --}}
                    </div>
                </nav>
                <div class="tab-content mt-3" id="nav-tabContent">
                    @can('voir document')
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th scope="col">Nom Document</th>
                                    <th scope="col">Type</th>
                                    @can('téléchargez document')
                                        <th scope="col">Télécharger</th>
                                    @endcan
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($documents as $document)
                                        <tr>
                                            <td>{{ $document->nomD }}</td>
                                            <td>{{ $document->typeD }}</td>
                                            @can('téléchargez document')
                                                <td>
                                                    <a href="{{ route('documents.download', $document->idD) }}" class="btn btn-outline-info">Télécharger</a>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endcan
                    @can('ajouter document')
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                            <form action="{{ route('documents.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="redirectTo" value="projets.show">
                                <input type="hidden" name="idP" value="{{ $projet->idP }}">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nom du Document :</label>
                                    <input type="text" name="nomD" class="form-control" id="exampleFormControlInput1" placeholder="nom Document">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Type du Document :</label>
                                    <input type="text" name="typeD" class="form-control" id="exampleFormControlInput1" value="Excel">
                                </div>

                                <div class="mb-3">
                                    <input type="hidden" name="idP" class="form-control" id="exampleFormControlInput1" value="{{ $projet->idP }}">
                                </div>

                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Importer un Document :</label>
                                    <div class="d-flex align-items-center">
                                        <input class="form-control me-2" name="excel_file" type="file" id="formFile">
                                        <button type="submit" class="btn btn-outline-primary">Importer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endcan

                        {{-- <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">...</div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection