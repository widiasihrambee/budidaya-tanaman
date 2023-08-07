<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Budidaya;
use Illuminate\Http\Request;

class BudidayaController extends Controller
{
    public function all(Request $request){
        $id = $request->input('id');
        $limit = $request->input('limit');
        $title = $request->input('title');
        $deskription = $request->input('deskription');
        $full_text = $request->input('full_text');
        $jenis = $request->input('jenis');

         if ($id) 
         {
            $budidaya = Budidaya::with(['galleries'])->find($id);

            if ($budidaya) {
                return ResponseFormatter::success(
                    $budidaya,
                    'Data berhasil diambil'
                );
            }
            else {
                return ResponseFormatter::error(
                    null,
                    'Data tidak ada',
                    404
                );
            }

         }

         $budidaya = Budidaya::with(['galleries']);

         if ($title) {
            $budidaya->where('title', 'like', '%' . $title . '%');
         }
         if ($deskription) {
            $budidaya->where('deskription', 'like', '%' . $deskription . '%');
         }
         if ($jenis) {
            $budidaya->where('jenis',$jenis);
         }
         return ResponseFormatter::success(
            $budidaya->paginate($limit),
            'Data list budidaya berhasil diambil'
        );
    }
}
