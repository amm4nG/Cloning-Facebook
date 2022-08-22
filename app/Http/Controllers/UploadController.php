<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:100',
                'image' => 'mimes:jpg,png,jpeg'
            ],
            [
                'title.required' => 'Masukkan apa yang Anda pikirkan!'
            ]
        );

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('upload');
        } else {
            $path = '';
        }

        $upload = new Postingan();
        $upload->email_user = $request->email_user;
        $upload->title = $request->title;
        $upload->description = $request->description;
        $upload->image = $path;
        $upload->date = $request->date;
        $upload->save();
        $request->session()->flash('postingan', 'Postingan baru berhasil di upload');
        return redirect('/');
    }
}