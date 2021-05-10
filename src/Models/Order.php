<?php

namespace Mariojgt\Firetakeaway\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    public function lines()
    {
        return $this->hasMany(Orderline::class);
    }
    // User model Relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Status model Relation
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
