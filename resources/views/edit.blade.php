<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ubah Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mx-auto">
                   
<div class="relative overflow-x-auto p-2">
   
            <form  action="{{ route('update', ['id' => $budidaya->id])}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Title</label>
                <input type="text" class="form-control" value="{{ $budidaya->title }}" name="title" id="recipient-name">
            </div>
            <div class="mb-3">
                <label for="formFileMultiple" class="form-label">foto</label>
                <input class="form-control" type="file" name="foto" id="formFileMultiple" >
              </div>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Deskripsi</label>
                <textarea class="form-control" name="full_text" value="{{ $budidaya->full_text }}" id="message-text">{{ $budidaya->full_text }}</textarea>
            </div>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">jenis</label>
                <select class="form-select" name="jenis" aria-label="Default select example">
                    <option value="1" {{ $budidaya->jenis == 1 ? "selected" : '' }}>Budidaya</option>
                    <option value="2" {{ $budidaya->jenis == 2 ? "selected" : '' }}>Rekomendasi</option>
                    <option value="3" {{ $budidaya->jenis == 3 ? "selected" : '' }}>Artikel</option>
                  </select>
            </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
            <button type="button" class="btn btn-outline-warning rounded-pill" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-success rounded-pill">Save</button>
        </div>
        </div>
    </form>

</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script> 
<script src="{{ asset('main.js')}}"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
