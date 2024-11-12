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

        $video = new Video();
        $video->fill([
            'name' => $request->name,
            'ori' => $request->ori,
            'comp' => $request->comp,
            'dir' => $request->dir,  // Di sini mutator akan berjalan
            'id_user' => Auth::user()->id,
        ]);
        $video->save();

        return response()->json(['success' => true]);
    }
}
