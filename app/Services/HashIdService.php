<?php

namespace App\Services;

use Hashids\Hashids;

class HashIdService
{
    private static ?HashIdService $instance = null;

    public Hashids $hashIds;

    private function __construct()
    {
        $this->hashIds = new Hashids('Laravel Hashids Example', 10);
    }

    public static function getInstance(): HashIdService
    {
        if (self::$instance === null) {
            self::$instance = new HashIdService();
        }
        return self::$instance;
    }

    public static function encode($id): string
    {
        $imageService = self::getInstance();
        return $imageService->hashIds->encode($id);
    }

    public static function decode($hashId)
    {
        $imageService = self::getInstance();
        if (is_int($hashId)) {
            return $hashId;
        }
        return $imageService->hashIds->decode($hashId)[0];
    }
}
