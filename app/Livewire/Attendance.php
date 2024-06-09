<?php

namespace App\Livewire;

use App\Enums\AttendanceStatus;
use App\Enums\QrCodeType;
use App\Models\QrCode;
use App\Models\Staff;
use App\Models\Student;
use App\Services\HashIdService;
use Exception;
use Livewire\Component;
use RuntimeException;

class Attendance extends Component
{
    public $listeners = ['qrCodeScanned' => 'qrCodeScanned'];

    public function render()
    {
        return view('livewire.attendance');
    }

    /**
     * @throws Exception
     */
    public function qrCodeScanned($qrMessage): void
    {
        try {
            $this->punchIn($qrMessage);
            $this->dispatch('alert', type: 'success', message: 'Attendance Recorded Successfully!', data: []);
        } catch (Exception $e) {
            $this->dispatch('alert', type: 'error', message: $e->getMessage());
        }
    }

    public function punchIn($qrCodeUuid): void
    {
        $qrCodeDetail = QrCode::query()->where('uuid', $qrCodeUuid)->first();
        if (!$qrCodeDetail) {
            throw new RuntimeException('Invalid QR Code detected');
        }
        $data = [];
        $data['checked_in_at'] = now();
        $data['status'] = getSetting('punch_in_time_start') <= now()->format('H:i:s') ? AttendanceStatus::Present : AttendanceStatus::Late;
        $data['checked_in_ip'] = request()->ip();
        $data['qr_code_id'] = $qrCodeDetail->id;
        if ($qrCodeDetail->type->is(QrCodeType::STAFF_ATTENDANCE)) {
            $staff = $qrCodeDetail->staff;
            if (!$staff) {
                throw new RuntimeException('Invalid Staff detected');
            }
            // Check if the staff is already checked in today
            $attendance = \App\Models\Attendance::query()->where('staff_id', $staff->id)->whereDay('checked_in_at', now()->subDays(4))->first();
            if ($attendance) {
                throw new RuntimeException('Staff already checked in today');
            }
            $data['staff_id'] = $staff->id;
            $data['student_id'] = null;
            $data['class_detail_id'] = null;
            // $data['user_id'] = $staff->user_id;
        } elseif ($qrCodeDetail->type->is(QrCodeType::STUDENT_ATTENDANCE)) {
            $student = $qrCodeDetail->student;
            if (!$student) {
                throw new RuntimeException('Invalid Student detected');
            }
            // Check if the student is already checked in today
            $attendance = \App\Models\Attendance::query()->where('student_id', $student->id)->whereDay('checked_in_at', now())->first();
            if ($attendance) {
                throw new RuntimeException('Student already checked in today');
            }
            $data['student_id'] = $student->id;
            $data['staff_id'] = null;
            $data['class_detail_id'] = null;
            // $data['user_id'] = $student->user_id;
        } else {
            throw new RuntimeException('Invalid QR Code Type detected');
        }
        if (isset($data) && count($data) > 0) {
            \App\Models\Attendance::query()->create($data);
        }
    }
}
