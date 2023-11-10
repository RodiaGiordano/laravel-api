<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projectt;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Projectt::select("id","title", "description", "slug", "url", "type_id")->with('type', 'technologies')->paginate(6);    
            return response()->json($projects);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     ** @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $project = Projectt::select("id","title", "description", "slug", "url", "type_id")
            ->where('slug', $slug)
            ->with('type', 'technologies')
            ->first();
        return response()->json($project);
    }
}

   