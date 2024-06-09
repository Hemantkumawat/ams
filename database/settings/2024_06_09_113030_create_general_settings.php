<?php

use Illuminate\Support\Facades\Schema;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('general.attendance_method', 'qr_code');
        $this->migrator->add('general.punch_in_time_start', '08:00');
        $this->migrator->add('general.punch_in_time_end', '09:00');
        $this->migrator->add('general.lunch_break_enabled', false);
        $this->migrator->add('general.lunch_break_start', '12:00');
        $this->migrator->add('general.lunch_break_end', '13:00');
        $this->migrator->add('general.late_arrival_tolerance_enabled', false);
        $this->migrator->add('general.late_arrival_tolerance_minutes', 0);
        $this->migrator->add('general.early_departure_tolerance_enabled', false);
        $this->migrator->add('general.early_departure_tolerance_minutes', 0);
        $this->migrator->add('general.overtime_calculation_enabled', false);
        $this->migrator->add('general.overtime_calculation_threshold', 0);
        $this->migrator->add('general.shifts', [
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
        ]);
        $this->migrator->add('general.holiday_attendance_enabled', false);
        $this->migrator->add('general.weekend_attendance_enabled', false);
        $this->migrator->add('general.leave_management_integration_enabled', false);
    }
};
