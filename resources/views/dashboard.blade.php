<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mx-auto">
                   
<div class="relative overflow-x-auto p-2">
    <button type="button" class="btn btn-success bg-success mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Data</button>
    @if (session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('status')}}</strong>
            <button type="button button-ligth" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <table class="table" id="table">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Gambar</th>
            <th scope="col">Jenis</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($budidaya as $bd)
                <tr>
                    <td>{{$bd->title}}</td>
                    <td>{{$bd->full_text}}</td>
                    <td><img src="{{ url($bd->galleries[0]->url)}}" alt="" width="50"></td>
                    <td><?php
                        if ($bd->jenis == 1) {
                            echo 'Budidaya';
                        }elseif ($bd->jenis == 2) {
                            echo 'Rekomendasi';
                        }else {
                            echo 'Artikel';
                        }

                    ?></td>
                    <td><a href="{{ route('ubah', ['id' => $bd->id] )}}">Edit</a> | <a href="{{ route('delete', ['id' => $bd->id] )}}">Hapus</a></td>
                </tr>
            @endforeach
        </tbody>
      </table>
                </div>
            </div>
        </div>
    </div>
   

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form  action="{{ route('tambah')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Title</label>
                <input type="text" class="form-control" name="title" id="recipient-name">
            </div>
            <div class="mb-3">
                <label for="formFileMultiple" class="form-label">foto</label>
                <input class="form-control" type="file" name="foto[]" id="formFileMultiple" multiple>
              </div>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Deskripsi</label>
                <textarea class="form-control" name="full_text" id="message-text"></textarea>
            </div>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">jenis</label>
                <select class="form-select" name="jenis" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">Budidaya</option>
                    <option value="2">Rekomendasi</option>
                    <option value="3">Artikel</option>
                  </select>
            </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
            <button type="button" class="btn btn-outline-warning rounded-pill" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-success rounded-pill">Save</button>
        </div>
        </div>
    </form>

    </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script> 
<script src="{{ asset('main.js')}}"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
