<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index() //funtion file HomeController
    {
        $postingan = Postingan::all();
        $post = [];
        foreach ($postingan as $p) {
            $liked = Like::where('id_post', $p->id)->count();
            $cek_like = Like::where('id_user', Auth::user()->id)->where('id_post', $p->id)->first();
            if ($cek_like) {
                $like = "ya";
            } else {
                $like = "tidak";
            }
            array_push($post, [
                'id' => $p->id,
                'email_user' => $p->email_user,
                'title' => $p->title,
                'description' => $p->description,
                'image' => $p->image,
                'liked' => $liked,
                'like' => $like
            ]);
        }
        $notif = Like::where('email_post', Auth::user()->email)->count();
        return view('home', compact(['post', 'notif']));
    }
}