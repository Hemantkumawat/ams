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
        $key = HashIdService::encode(QrCodeType::STUDENT_ATTENDANCE->value) . '-' . $student->user->hash_id . '-' . $student->hash_id;
        Log::info('Student Detail for QR Code',['key'=>$key,'type'=>QrCodeType::STAFF_ATTENDANCE->value]);
        QrCode::query()->create([
            'student_id' => $student->id,
            'qr_code' => QrCodeService::generateQrCode($key, storagePath: 'qr-codes/students'),
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
