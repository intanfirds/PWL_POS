<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'm_level'; // Define the table name used by this model
    protected $primaryKey = 'level_id'; // Define the primary key used by this model

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['level_name'];
}

?>
