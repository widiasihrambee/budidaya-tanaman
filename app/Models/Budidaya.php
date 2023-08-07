<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budidaya extends Model
{
    use HasFactory, SoftDeletes;
    
    
    /**
     * 
     * @var array
     */
    protected $fillable = [
         'title',
         'deskription',
         'full_text',
         'jenis',
         'url_image'
    ];


    public function galleries()
    {
        return $this->hasMany(BudidayaGallery::class, 'budidaya_id', 'id');
    }

}
