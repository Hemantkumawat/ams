<?php

namespace App\Traits;

use App\Services\HashIdService;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HashIdTrait
{
    public function getCasts()
    {
        return array_merge(parent::getCasts(), ['hash_id' => 'string']);
    }

    /*public function getHashIdAttribute()
    {
        return HashIdService::encode($this->id);
    }*/

    public function hashId(): Attribute
    {
        return Attribute::make(get: fn() => HashIdService::encode($this->attributes['id']));
    }
}
