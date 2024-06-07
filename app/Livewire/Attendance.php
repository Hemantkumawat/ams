<?php

namespace App\Livewire;

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
dd('bmmm',$qrMessage);
        /*try{*/
        $details = explode('::', $qrCode);
        if (count($details) !== 2) {
            throw new RuntimeException('Invalid QR Code');
        }
        $user_id = $details[0];

        dd($qrCode);
        /*}catch (\Exception $e){
            dd($e->getMessage());
        }*/
    }
}
