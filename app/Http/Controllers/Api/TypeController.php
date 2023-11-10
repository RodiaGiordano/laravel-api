<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
  
  

    public function show($id)
    {
        $type = Type::select('id', 'color', 'label')->where('id', $id)->first();
        if(!$type) abort(404, "type not found");

        return response()->json($type);
    }

}