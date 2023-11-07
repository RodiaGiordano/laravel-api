@extends('layouts.app')

@section('content')

<div class="container my-5">
    <a class="btn btn-outline-success" href="{{route('admin.projects.create')}}">Crea progetto</a>
    <table class="table">
        <thead>
            <tr>
                
                <th scope="col">Id</th>
                <th scope="col">Titolo</th>
                <th scope="col">Tecnologia</th>
                <th scope="col">Descrizione</th>
                <th scope="col">Url</th>
                <th scope="col">Slug</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            
            @forelse ($projects as $project)
            <tr>
                <th scope="row">{{$project->id}}</th>
                <td><strong>Tipo:</strong><br>{!! $project->getTypeBadge() !!}
                </td>

                <td>{!! $project->getTechnologyBadges() !!}</td>
                              
                <td>{{$project->title}}</td>
                <td>{{$project->description}}</td>
                <td>{{$project->url}}</td>
                <td>{{$project->slug}}</td>
                <td>
            <a class="btn btn-outline-success" href="{{route('admin.projects.edit', $project)}}">Modifica progetto</a>
            <a href="{{route("admin.projects.show", $project)}}">Show</a>

                <a class="btn btn-outline-success" href="#" data-bs-toggle="modal" data-bs-target="#delete-project-modal-{{$project->id}}">Elimina</a>
            </form>

        </td>
    </tr>
    
    @empty
    <tr>
        <td coldspan="6">Non ci sono risultati</td>
    </tr>
        
    @endforelse
    
</tbody>
</table>
</div>
@endsection

@section('modals')
@foreach($projects as $project)
<div class="modal fade" id="delete-project-modal-{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="delete-project-modal-{{$project->id}}">Vuoi confermare l'eliminazione?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            Vuoi davvero eliminare il progetto <br><strong>{{$project->title}}</strong> ?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
            <form action="{{route("admin.projects.destroy", $project)}}" method="POST">
                @method('DELETE')
                @csrf

            <button class="btn btn-primary">Elimina</button>
            </form>
            </div>
        </div>
        </div>
    </div>
    @endforeach
@endsection