<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
USE Illuminate\support\Str;
use Illuminate\support\Arr;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Projectt;
use App\Models\Technology;
use App\Models\Type;



class ProjecttController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     ** @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $projects = Projectt::all();
        
        return view("admin.projects.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     *
     ** @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technologies = Technology::all();
        
        $types = Type::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     ** @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {

        
        $data = $request->validated();
        

        $project = new Projectt;

        $project->title = $data['title'];
        $project->description = $data['description'];
        $project->url = $data['url'];
        $project->slug = Str::slug($project->title);

 
        if(Arr::exists($data, 'cover_image')){

            $cover_image_path = Storage::put("uploads/projects/cover_image", $data['cover_image']);
            $project->cover_image = $cover_image_path;
        }
            
        $project->save();


        if(Arr::exists($data, "technologies")){

            $project->technologies()->attach($data['technologies']);
        }
        

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projectt  $projectt
     * @return \Illuminate\Http\Response
     */
    public function show(Projectt $project)
    {
        // dd($project);
        return view("admin.projects.show", compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Projectt  $projectt
     * @return \Illuminate\Http\Response
     */
    public function edit(Projectt $project)
    {
        $technologies = Technology::all();
        $technology_ids = $project->technologies->pluck('id')->toArray();
        return view("admin.projects.edit", compact('project', 'technologies', "technology_ids"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Projectt  $projectt
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Projectt $project)
    {
        $data = $request->validated();

        $project->title = $data['title'];
        $project->description = $data['description'];
        $project->url = $data['url'];
        $project->slug = Str::slug($project->title);

        if($request->hasFile('cover_image')){
            if($project->cover_image){
                Storage::delete($project->cover_image);
            }
            $cover_image_path = Storage::put("uploads/projects/cover_image", $data['cover_image']);

            $project->cover_image = $cover_image_path;
        }
        $project->save();

        if(Arr::exists($data, "technologies")){

            $project->technologies()->sync($data['technologies']);
        }

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projectt  $projectt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projectt $project)
    {
        $project->technologies()->detach();
        
        if($project->cover_image){
            Storage::delete($project->cover_image);
        }
        
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}