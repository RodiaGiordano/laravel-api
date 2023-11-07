@extends('layouts.app')



@section('content')
<section class="container mt-5">
    <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-outline-success">Torna al dettaglio</a>


    @if($errors->any())
    <div class="bg-danger border border-dark-subtle rounded-3 p-2 mt-2">

        <h3>Correggi i seguenti errori:</h3>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-success">Torna alla lista</a>
    <h1 class="my-3">Modifica progetto</h1>
    <form action="{{ route('admin.projects.update', $project) }}" method="POST" ecntype="multipart/form-data" class="row">
        @method("PATCH")
        @csrf 
        <div class="col-12">
            <label for="title" class="from-label">Titolo</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title') ?? $project->title}}">
            @error('title')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
        </div>

        <div class="col-12">
            
                <div class="row">
                    <div class="col-8">

                        <label for="cover_image" class="from-label">Cover</label>
                        <input type="file" name="cover_image" id="cover_image" value="{{old('cover_image') ?? ''}}" class="form-control @error('cover_image') is-invalid @enderror">
                        @error('cover_image')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="col-4 mt-2">
                        <img src="{{asset('/storage/' . $project->cover_image)}}" class='img-fluid' id="cover_image_preview" alt="">
                    </div>
                        
                </div>
        </div>
                    
        @foreach($technologies as $technology)
            <div class="col-12">
                <input type="checkbox" name="technologies[]" id="technology-{{$technology->id}}" value="{{$technology->id}}" class="form-check-control" @if (in_array($technology->id, old('technologies', $technology_ids))) checked @endif>
                
                <label for="technology-{{$technology->id}}" class="from-label">{{$technology->name}}</label>
            </div>
        @endforeach

        <div class="col-12 my-3">
            <label for="description" class="from-label">Descrizione</label>
            <textarea name ="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{old('description', $project->description)}}</textarea>
            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
        </div>

        <div class="col-12">
            <label for="url" class="from-label">Link</label>
            <input type="url" name ="url" id="url" class="form-control @error('url') is-invalid @enderror" value="{{old('url', $project->url)}}">
            @error('url')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
        </div>

        <div class="col-12 mt-4">
            <button class="btn btn-success">Salva</button>
        </div>
    </form>
</section>      

@endsection

@section('script')
<script type="text/javascript">

    const inputFileEl = document.getElementById('cover_image');
    const coverImagePreview = document.getElementById('cover_image_preview');

    inputFileEl.addEventListener('change', function(){
        console.log('ciao')
        const [file] = this.files;
        coverImagePreview.src = URL.createObjectURL(file);
        

    })

</script>

@endsection