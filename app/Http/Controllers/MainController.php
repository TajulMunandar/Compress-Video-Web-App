<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MainController extends Controller
{
    public function index()
    {
        $historys = Video::where('id_user', Auth::user()->id)->get();
        return view('welcome')->with(compact('historys'));
    }

    public function compressVideo(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'ori' => 'required|numeric',
            'comp' => 'required|numeric',
            'dir' => 'required|string',
            // Include any other validations as needed
        ]);

        // Save the video data to the database
        Video::create([
            'name' => $request->name,
            'ori' => $request->ori,
            'comp' => $request->comp,
            'dir' => $request->dir,
            'id_user' => Auth::user()->id,
        ]);

        return response()->json(['success' => true]);
    }
}
