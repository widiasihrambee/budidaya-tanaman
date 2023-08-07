<?php

namespace App\Http\Controllers;

use App\Models\Budidaya;
use App\Models\BudidayaGallery;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BudidayaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'full_text' => ['required', 'string'],
            'jenis' => ['required'],
        ]);
        $files = $request->file('foto');
        $file_locations = '';
        if ($request->hasFile('foto')) {
            foreach ($files as $file) {
                $path = $file->store('public/gallery');
                Budidaya::create([
                    'title' => $request->title,
                    'full_text' => $request->full_text,
                    'jenis' => $request->jenis,
                    'url_image' => $path,
                    'deskription' => '-',
                ]);
                $file_locations = $path;
            }
        }
        $budidayas = DB::table('budidayas')->latest()->first();
        // dd($file_locations);
        // $budidaya = Budidaya::
        BudidayaGallery::create([
            'budidaya_id' => $budidayas->id,
            'url' => $file_locations
        ]);

        $data['budidaya'] = Budidaya::with('galleries')->get();
        // $request->session()->flash('status', 'Task was successful!');
        return to_route('dashboard', $data)->with('status', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['budidaya'] = Budidaya::find($id);

        return view('edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $budidaya = Budidaya::find($id);
        //validate form
        $request->validate([
            'title'     => 'required',
            'full_text'   => 'required',
            'jenis'   => 'required'
        ]);
        $file = $request->file('foto');
        //check if image is uploaded
        if ($request->hasFile('foto')) {

            $path = $file->store('public/gallery');
            $budidaya->update([
                'title' => $request->title,
                'full_text' => $request->full_text,
                'jenis' => $request->jenis,
                'url_image' => $path,
                'deskription' => '-',
            ]);

            $galery = BudidayaGallery::where('budidaya_id', $id)->first();
            // dd($galery);
            $galery->update([
                'budidaya_id' => $id,
                'url' => $path 
            ]);
        } else {

            $budidaya->update([
                'title' => $request->title,
                'full_text' => $request->full_text,
                'jenis' => $request->jenis,
                'deskription' => '-',
            ]);
        }

        //redirect to index
        return to_route('dashboard')->with(['status' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $budidaya = Budidaya::find($id);
        // dd($budidaya)
        if ($budidaya) {
            $budidaya->delete();
            // $request->session()->flash('status', 'Task was successful!');
            $data['budidaya'] = Budidaya::with('galleries')->get();
            return to_route('dashboard', $data)->with('status', 'Data berhasil dihapus.');
        }
        $data['budidaya'] = Budidaya::with('galleries')->get();
        return to_route('dashboard', $data)->with('status', 'Data gagal dihapus.');
        //
    }
}
