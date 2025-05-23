<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'voornaam',
        'achternaam',
        'straat',
        'huisnummer',
        'postcode',
        'woonplaats',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('quantity', 'size')->withTimestamps();
    }
}
