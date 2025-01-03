<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\User;
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
            'dirVid' => 'required|string',
            'dirGraf' => 'required|string',
            // Include any other validations as needed
        ]);

        $user = User::find(Auth::user()->id);  // Menemukan user berdasarkan ID yang sedang login

        if ($user) {
            // Mengupdate count
            $user->count = $user->count + 1;
            $user->save();  // Menyimpan perubahan
        }

        $video = new Video();
        $video->fill([
            'name' => $request->name,
            'ori' => $request->ori,
            'comp' => $request->comp,
            'dirVid' => $request->dirVid,  // Di sini mutator akan berjalan
            'dirGraf' => $request->dirGraf,  // Di sini mutator akan berjalan
            'id_user' => Auth::user()->id,
        ]);
        $video->save();

        return response()->json(['success' => true]);
    }
}
