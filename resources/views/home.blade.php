@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (Auth::user()->level == 'admin')
                    {{-- Halaman admin --}}

                    {{-- pesan error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- end pesan error --}}

                    {{-- alert ada postingan --}}
                    @if (session('postingan'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('postingan') }}
                            <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                        </div>
                    @elseif (session('delete'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('delete') }}
                            <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                        </div>
                    @endif
                    {{-- end alert ada postingan --}}

                    {{-- form upload postingan --}}
                    <form action="{{ route('postingan.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input id="" name="date" type="hidden" value="{{ date('d/m/Y') }}">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-square"></i></span>
                            <input class="form-control" name="title" type="text" value="{{ old('title') }}"
                                placeholder="Apa yang Anda pikirkan?">
                            <h4 class="image_upload mt-2 ms-2">
                                <label class="text-primary" for="userImage"><i class="bi bi-images"></i>
                                </label>
                                <input class="" id="userImage" name="image" type="file">
                            </h4>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control mb-2" id="floatingTextarea2" name="description" style="height: 100px"
                                placeholder="Leave a comment here"></textarea>
                            <label for="floatingTextarea2">Description</label>
                        </div>
                        <button class="btn btn-primary form-control" type="submit">Posting</button>
                    </form>
                    {{-- end form upload postingan --}}

                    {{-- daftar postingan --}}
                    <div class="card mt-3">
                        <div class="card-header">{{ __('Daftar Postingan') }}</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-light table-bordered table-sm table-striped">
                                    <tr align="center">
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Detail</th>
                                        <th>Action</th>
                                    </tr>
                                    @forelse ($post as $p)
                                        <tr>
                                            <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                            <td class="align-middle text-center">{{ $p['title'] }}</td>
                                            <td class="align-middle text-center">
                                                <a class="btn btn-primary btn-sm mb-1" href=""><i
                                                        class="bi bi-info-circle"></i></a>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a class="btn btn-warning btn-sm mb-1" href=""><i
                                                        class="bi bi-pencil-square"></i></a>
                                                <a class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal"
                                                    data-bs-target="#delete{{ $p['id'] }}" href=""><i
                                                        class="bi bi-trash3"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td></td>
                                            <td class="align-middle text-center" colspan="2">Tidak Ada Postingan</td>
                                            <td></td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- end daftar postingan --}}

                    <!-- modal delete -->
                    @foreach ($post as $p)
                        <div class="modal fade" id="delete{{ $p['id'] }}" aria-labelledby="exampleModalLabel"
                            aria-hidden="true" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('postingan.destroy', $p['id']) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Delete</h5>
                                            <button class="btn-close" data-bs-dismiss="modal" type="button"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Yakin akan menghapus postingan ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal"
                                                type="button">Batal</button>
                                            <button class="btn btn-danger" type="submit">Ya</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- end modal delete --}}


                    {{-- end halaman admin --}}
                @else
                    {{-- {{ Halaman user }} --}}

                    {{-- {{ alert upload error }} --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- end alert upload error --}}

                    {{-- {{ alert postingan baru }} --}}
                    @if (session('postingan'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('postingan') }}
                            <button class="btn-close" data-bs-dismiss="alert" type="button"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    {{-- {{ end alert postingan baru }} --}}

                    {{-- {{ form upload postingan }} --}}
                    <form action="{{ route('upload.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input name="email_user" type="hidden" value="{{ Auth::user()->email }}">
                        <input id="" name="date" type="hidden" value="{{ date('d/m/Y') }}">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-dark text-primary" id="basic-addon1"><i
                                    class="bi bi-bell"></i>
                                <p class="badge rounded-pill bg-danger navbar-badge" id="badge">
                                    {{ $notif }}</p>
                            </span>
                            <input class="form-control" name="title" type="text" value="{{ old('title') }}"
                                placeholder="Apa yang Anda pikirkan?">
                            <h4 class="image_upload mt-2 ms-2">
                                <label class="text-primary" for="userImage"><i class="bi bi-images"></i>
                                </label>
                                <input class="" id="userImage" name="image" type="file">
                            </h4>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control mb-2" id="floatingTextarea2" name="description" style="height: 100px"
                                placeholder="Leave a comment here"></textarea>
                            <label for="floatingTextarea2">Description</label>
                        </div>
                        <button class="btn btn-primary form-control" type="submit">Posting</button>
                    </form>
                    {{-- {{ end form upload postingan }} --}}

                    {{-- {{ postingan public }} --}}
                    @foreach ($post as $p)
                        <div class="card mt-3">
                            <div class="card-body p-5">
                                <p class="fs-6 text-secondary"><i class="bi bi-person-square"></i>
                                    @if ($p['email_user'] == Auth::user()->email)
                                        {{ $p['email_user'] }} (Anda)
                                </p>
                            @else
                                {{ $p['email_user'] }}
                    @endif
                    <p class="fw-bold fs-5">{{ $p['title'] }}</p>
                    <p>{{ $p['description'] }}</p>
                    <img class="img-fluid" src="{{ asset('storage/' . $p['image']) }}" alt=""
                        style="display:block; margin:auto;">
            </div>
            <div class="card-footer">
                <div class="list-group list-group-horizontal mt-3 mb-4">
                    {{-- form like --}}
                    <form class="mx-auto" id="form-like">
                        @if ($p['like'] == 'ya')
                            <input id="id_post-{{ $p['id'] }}" type="hidden" value="{{ $p['id'] }}">
                            <button class="btn btn-default btn-sm mx-auto" id="like-{{ $p['id'] }}"><i
                                    class="bi bi-heart-fill text-danger"></i>
                                {{ $p['liked'] }} Like
                            </button>
                        @else
                            <input id="id_post-{{ $p['id'] }}" type="hidden" value="{{ $p['id'] }}">
                            <button class="btn btn-default btn-sm mx-auto" id="like-{{ $p['id'] }}"><i
                                    class="bi bi-heart"></i>
                                {{ $p['liked'] }} Like
                            </button>
                        @endif
                    </form>
                    {{-- end form like --}}

                    {{-- komentar --}}
                    <button class="btn btn-default btn-sm mx-auto"><i class="bi bi-chat-square-dots"></i>
                        20 Komentar
                    </button>
                    {{-- end komentar --}}

                    {{-- share --}}
                    <button class="btn btn-default btn-sm mx-auto"><i class="bi bi-share-fill"></i> Share
                    </button>
                    {{-- end share --}}

                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    </div>
    </div>
@endsection
@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @foreach ($post as $p)
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#like-" + "{{ $p['id'] }}").on('click', function(e) {
                e.preventDefault();
                // alert(like)
                let id_post = $("#id_post-" + "{{ $p['id'] }}").val()
                $.ajax({
                    url: "/",
                    type: "POST",
                    data: {
                        id_post: id_post,
                    },
                    success: function(response) {
                        if (response.status == 'unlike') {
                            $("#like-" + "{{ $p['id'] }}").html(
                                "<i class='bi bi-heart'></i> " + response.liked + " Like");
                        } else if (response.status == 'like') {
                            $("#like-" + "{{ $p['id'] }}").html(
                                "<i class='bi bi-heart-fill text-danger'></i> " + response.liked +
                                " Like");
                        }
                        $("#like-" + "{{ $p['id'] }}").reset();
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });
            });
        </script>
    @endforeach
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('5d5e05d6c4970c04d09b', {
            cluster: 'ap1'
        });
        var channel = pusher.subscribe('channel-like');
        channel.bind('channel-like', function(data) {
            $.ajax({
                url: "/",
                success: function() {
                    if ("{{ Auth::user()->email }}" == data.message.email_post) {
                        $("#badge").html({{ $notif }} + 1)
                    }
                }
            })
        });
    </script>
@endsection
