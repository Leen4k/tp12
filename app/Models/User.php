<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function authors()
    {
        return $this->hasMany(Author::class);
    }

    public function audiences()
    {
        return $this->hasMany(Audience::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}