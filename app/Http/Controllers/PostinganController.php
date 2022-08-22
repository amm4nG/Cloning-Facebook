<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostinganController extends Controller
{
    // public function index()
    // {
    //     $postingan = Postingan::all();
    //     return view('home', compact(['postingan']));
    // }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:255',
                'image' => 'mimes:jpg,png,jpeg'
            ],
            [
                'title.required' => 'Masukkan apa yang Anda pikirkan?',
            ]
        );
        //jika ada gambar yang diupload maka nama file nya akan di has/enscription
        if ($request->hasFile('image')) {
            //filenya akan diupload pada folder storage dan akan membuat folder upload secara otomatis
            $path = $request->file('image')->store('upload');
        } else {
            //jika tidak ada maka buat variabel path/jalurnya kosong
            $path = '';
        }
        $postingan = new Postingan();
        $postingan->title = $request->title;
        $postingan->email_user = Auth::user()->email;
        $postingan->image = $path;
        $postingan->description = $request->description;
        $postingan->date = $request->date;
        $postingan->save();
        $request->session()->flash('postingan', 'Postingan berhasil di upload');
        return redirect('/');
    }

    public function destroy($id, Request $request)
    {
        $postingan = Postingan::find($id);
        if (
            $postingan->image != null ||
            $postingan->image != ''
        ) {
            Storage::delete($postingan->image);
        }
        $postingan->delete();
        $request->session()->flash('delete', 'Postingan berhasil dihapus');
        return redirect('/');
    }
}