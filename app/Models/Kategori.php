<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use SoftDeletes;

    protected $table = 'tb_kategori';
    protected $primaryKey = 'id_kategori';
    protected $guarded = ['id_kategori'];
}
