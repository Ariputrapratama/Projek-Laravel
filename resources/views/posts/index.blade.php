@extends('dashboard')

@section('content')
<div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4 text-white">Latihan CRUD Laravel 11</h3>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('posts.create') }}" class="btn btn-md btn-success mb-3">Tambah Mahasiswa</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Nama Mahasiswa</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{asset('storage/public/posts/'. $post->foto_mahasiswa) }}" class="rounded-circle" style="width: 150px; height: 155px;">
                                        </td>
                                        <td>{{ $post->nim }}</td>
                                        <td>{{ $post->nama_mahasiswa }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?')" action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Mahasiswa belum tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection