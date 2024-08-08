@extends('layouts.sidebar')

@php
    use Illuminate\Support\Str;
@endphp

@section('head-title')
    {{ $division->nomD }}
@endsection

@section('listeNav')
    <li>
        <a href="#">Dashboard</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a href="#">Divisions</a>
    </li>
    <li><i class='bx bx-chevron-right'></i></li>
    <li>
        <a class="active" href="#">Services</a>
    </li>
@endsection

@section('content')

    <div class="d-flex justify-content-end align-items-center mb-3">
        <a href="{{ url('divisions') }}" class="btn btn-primary">Retour</a>
    </div>

    @foreach ($services as $service)
        <div class="card border-secondary mx-4 my-2" style="width: 18rem; overflow: hidden;">
            <div class="card-body text-secondary">
                <h5 class="card-title">{{ $service->nomS }}</h5>
                <p class="card-text">
                    {{ Str::limit($service->descriptionS, 50) }}
                    <span id="dots-{{ $service->idS }}"></span>
                    <span id="more-{{ $service->idS }}" style="display:none;">{{ substr($service->descriptionS, 50) }}</span>
                </p>
                @if (strlen($service->descriptionS) > 50)
                    <button onclick="toggleReadMore({{ $service->idS }})" id="myBtn-{{ $service->idS }}" class="btn btn-link p-0 text-primary">Read more</button>
                @endif
            </div>
        </div>
    @endforeach

    {{-- <div class="d-flex justify-content-center mt-3">
        <table id="example" class="table table-bordered table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Nom Service</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->nomS }}</td>
                        <td>{{ $service->descriptionS }}</td>
                        <td>
                            <a href="{{ url('services/'.$service->id.'/edit') }}" class="btn btn-outline-success">Modifier</a>
                            <a href="{{ url('services/'.$service->id.'/delete') }}" class="btn btn-outline-danger">Supprimer</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}

    @section('scripts')
        <script>
            function toggleReadMore(id) {
                var dots = document.getElementById("dots-" + id);
                var moreText = document.getElementById("more-" + id);
                var btnText = document.getElementById("myBtn-" + id);
            
                if (dots.style.display === "none") {
                    dots.style.display = "inline";
                    btnText.innerHTML = "Read more";
                    moreText.style.display = "none";
                } else {
                    dots.style.display = "none";
                    btnText.innerHTML = "Read less";
                    moreText.style.display = "inline";
                }
            }
        </script>
    @endsection

@endsection
