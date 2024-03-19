<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $data)
 */
class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'size', 'width', 'height', 'mime'];
}
