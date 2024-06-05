<?php

namespace App\Observers;

use App\Models\Staff;
use App\Models\User;
use App\Services\QrCodeService;
use Endroid\QrCode\Exception\ValidationException;
use Illuminate\Support\Str;

class StaffObserver
{
    /**
     * Handle the Staff "created" event.
     * @throws ValidationException
     * @throws \JsonException
     */
    public function created(Staff $staff): void
    {
        $user = User::query()->create([
            'name' => $staff->name,
            'email' => $staff->email,
            'password' => bcrypt($staff->password ?? Str::random()),
        ]);
       $res =  QrCodeService::getInstance()->generateQrCode(json_encode($user->toArray(), JSON_THROW_ON_ERROR), 'Staff Details');
        $staff->user()->associate($user);
    }

    /**
     * Handle the Staff "updated" event.
     */
    public function updated(Staff $staff): void
    {
        //
    }

    /**
     * Handle the Staff "deleted" event.
     */
    public function deleted(Staff $staff): void
    {
        //
    }

    /**
     * Handle the Staff "restored" event.
     */
    public function restored(Staff $staff): void
    {
        //
    }

    /**
     * Handle the Staff "force deleted" event.
     */
    public function forceDeleted(Staff $staff): void
    {
        //
    }
}
