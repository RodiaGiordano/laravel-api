@extends('layouts.app')



@section('content')
<section class="container mt-5">
    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-success">Torna alla lista</a>

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
    <h1 class="my-3">Crea progetto</h1>
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="row gap-1">
        @csrf
        <div class="col-12">
            <label for="title" class="from-label">Titolo</label>
            <input type="text" name="title" id="title" value="{{old('title') ?? ''}}" class="form-control @error('title') is-invalid @enderror">
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
                    <img src="" class='img-fluid' id="cover_image_preview" alt="">
                </div>
                    
            </div>
    </div>

       
        
        
        @foreach($technologies as $technology)
           
            <div class="col-12">
                <input type="checkbox" name="technologies[]" id="technology-{{$technology->id}}" value="{{$technology->id}}" @if(in_array($technology->id, old('technologies', []))) checked  @endif class="form-check-control">
                <label for="technology-{{$technology->id}}" class="from-label">{{$technology->name}}</label>
            </div>
        @endforeach
        <div class="col-12">
            <label for="type_id" class="from-label">Categoria</label>
            <select name="type_id" id="type_id" class="form-select">
                <option value="">Non categorizzato</option>
                @foreach ($types as $type)
                    <option value="{{$type->id}}">{{$type->label}}</option>
                    
                @endforeach
                
            </select>
        </div>

        <div class="col-12 my-3">
            <label for="description" class="from-label">Descrizione</label>
            <textarea name ="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{old('description') ?? ''}}</textarea>
        @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror    
        </div>

        <div class="col-12">
            <label for="url" class="from-label">Link</label>
            <input type="url" name ="url" id="url" value="{{old('url') ?? ''}}" class="form-control @error('url') is-invalid @enderror">
            
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