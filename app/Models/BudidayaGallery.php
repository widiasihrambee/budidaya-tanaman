<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\support\Facades\Storage;

class BudidayaGallery extends Model
{
    use HasFactory, SoftDeletes;

     /**
     * 
     * @var array
     */
    protected $fillable = [
        'budidaya_id',
        'url'
   ];

   public function  getUrlAttribute($url){
    return config('app.url') . Storage::url($url);
   }
}
