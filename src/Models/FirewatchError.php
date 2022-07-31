<?php

namespace KkSmiles\Firewatch\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FirewatchError extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'firewatch_errors';
    protected $guarded = ['id'];
}
