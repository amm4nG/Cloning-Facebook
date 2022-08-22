<?php

namespace App\Http\Controllers;

use App\Events\LikeEvent;
use App\Models\Like;
use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $cek_like = Like::where('id_user', Auth::user()->id)->where('id_post', $request->id_post)->first();
        if ($cek_like) {
            $cek_like->delete();
            $liked = Like::where('id_post', $request->id_post)->count();
            return response()->json([
                'status' => 'unlike',
                'liked' => $liked
            ]);
            // return response()->json($liked);
        } else {
            $postingan = Postingan::find($request->id_post);
            $like = new Like();
            $like->id_post = $request->id_post;
            $like->id_user = Auth::user()->id;
            $like->email_post = $postingan->email_user;
            $like->save();
            $liked = Like::where('id_post', $request->id_post)->count();
            LikeEvent::dispatch([
                'email_post' => $postingan->email_user,
                'email_pengirim' => Auth::user()->email,
                'msg' => Auth::user()->email . " Menyukai postingan anda"
            ]);
            return response()->json([
                'status' => 'like',
                'liked' => $liked
            ]);
        }
    }
}