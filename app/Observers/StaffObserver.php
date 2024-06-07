<?php

namespace App\Observers;

use App\Enums\QrCodeType;
use App\Models\QrCode;
use App\Models\Staff;
use App\Models\User;
use App\Services\HashIdService;
use App\Services\QrCodeService;
use Endroid\QrCode\Exception\ValidationException;
use Illuminate\Support\Str;
use JsonException;

class StaffObserver
{

    /**
     * @throws JsonException
     */
    public function creating(Staff $staff): void
    {
        $user = User::query()->firstOrCreate([
            'email' => $staff->email
        ], [
            'name' => $staff->first_name . ' ' . $staff->last_name,
            'email' => $staff->email,
            'password' => bcrypt($staff->password ?? Str::random()),
        ]);
        $staff->user_id = $user->id;

    }

    /**
     * Handle the Staff "created" event.
     */
    public function created(Staff $staff): void
    {
        $key = HashIdService::encode(QrCodeType::STAFF_ATTENDANCE->value) . '::' . $staff->user->hash_id . '::' . $staff->hash_id;
        QrCode::query()->create([
            'staff_id' => $staff->id,
            'qr_code' => QrCodeService::generateQrCode($key, storagePath: 'qr-codes/staff'),
            'expires_at' => null,
        ]);
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
