<?php

namespace App\Settings;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{

    public $attendance_method = 'qr_code';
    public $punch_in_time_start = '08:00';
    public $punch_in_time_end = '09:00';
    public $lunch_break_enabled = false;
    public $lunch_break_start = '12:00';
    public $lunch_break_end = '13:00';
    public $late_arrival_tolerance_enabled = true;
    public $late_arrival_tolerance_minutes = 0;
    public $early_departure_tolerance_enabled = true;
    public $early_departure_tolerance_minutes = 0;
    public $overtime_calculation_enabled = false;
    public $overtime_calculation_threshold = 0;
    public $shifts = [
        [
            'name' => 'Morning Shift',
            'start' => '08:00',
            'end' => '16:00',
        ],
        [
            'name' => 'Evening Shift',
            'start' => '16:00',
            'end' => '00:00',
        ],
    ];

    public static function group(): string
    {
        return 'general';
    }
}
