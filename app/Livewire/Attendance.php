<?php

namespace App\Livewire;

use App\Enums\QrCodeType;
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
    public function qrCodeScanned($qrMessage)
    {
        /*try{*/
        $details = explode('-', $qrMessage);
        if (count($details) !== 3) {
            throw new RuntimeException('Invalid QR Code');
        }
        $qrCodeType = HashIdService::decode($details[0]);
        $userId = HashIdService::decode($details[1]);
        $modelId = HashIdService::decode($details[2]);
        if ($qrCodeType == QrCodeType::STAFF_ATTENDANCE) {
            $staff = Staff::query()->where('id', $modelId)->first();
            if (!$staff) {
                throw new RuntimeException('Invalid Staff detected');
            }
            $staff->attendances()->create([
                'staff_id' => $staff->id,
                'user_id' => $staff->user_id,
                'qr_code_id' => $staff->qrCode->id,
                'qr_code' => $qrMessage,
            ]);
        } elseif ($qrCodeType == QrCodeType::STUDENT_ATTENDANCE) {
            $student = Student::query()->where('id', $modelId)->first();
            if (!$student) {
                throw new RuntimeException('Invalid Student detected');
            }
            $student->attendances()->create([
                'student_id' => $student->id,
                'user_id' => $student->user_id,
                'qr_code_id' => $student->qrCode->id,
                'qr_code' => $qrMessage,
            ]);
        } else {
            throw new RuntimeException('Invalid QR Code Type');
        }

        dd($qrMessage);
        /*}catch (\Exception $e){
            dd($e->getMessage());
        }*/
    }

    public function punchIn(){
        // Only one time should be accepted for the day
        // If the user punch in after config('school.start_time') then it should be considered as late
        // If the user punch in before config('school.start_time') then it should be considered as on time
        // If the user punch in after config('school.end_time') then it should be considered as absent
    }
}
