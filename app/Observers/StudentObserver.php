<?php

namespace App\Observers;

use App\Enums\QrCodeType;
use App\Models\QrCode;
use App\Models\Staff;
use App\Models\Student;
use App\Models\User;
use App\Services\HashIdService;
use App\Services\QrCodeService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class StudentObserver
{
    public function creating(Student $row): void
    {
        $user = User::query()->firstOrCreate([
            'email' => $row->email
        ], [
            'name' => $row->first_name . ' ' . $row->last_name,
            'email' => $row->email,
            'password' => bcrypt($row->password ?? Str::random()),
        ]);
        $row->user_id = $user->id;
    }

    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        $key = Str::uuid();
        QrCode::query()->create([
            'type' => QrCodeType::STUDENT_ATTENDANCE,
            'student_id' => $student->id,
            'uuid' => $key,
            'qr_code' => QrCodeService::generateQrCode($key, storagePath: 'qr-codes/students'),
            'expires_at' => null,
        ]);
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updated(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
        //
    }
}
