<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class General extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GeneralSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Attendance Setting')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('attendance_method')
                            ->options([
                                'qr_code' => 'QR Code',
                                'biometric' => 'Biometric',
                                'rfid' => 'RFID',
                                'manual_entry' => 'Manual Entry',
                            ])
                            ->label('Attendance Method')
                            ->required()
                            ->helperText('Select the method for attendance tracking.'),

                        Forms\Components\TimePicker::make('punch_in_time_start')
                            ->label('Punch-In Start Time')
                            ->required()
                            ->helperText('Specify the start time for employees to punch in.'),

                        Forms\Components\TimePicker::make('punch_in_time_end')
                            ->label('Punch-In End Time')
                            ->required()
                            ->helperText('Specify the end time for employees to punch in.'),

                        Forms\Components\Checkbox::make('lunch_break_enabled')
                            ->label('Enable Lunch Break')
                            ->helperText('Check this box to enable a lunch break for employees.'),

                        Forms\Components\TimePicker::make('lunch_break_start')
                            ->label('Lunch Start Time')
                            ->required()
                            ->helperText('Specify the start time for lunch break.'),

                        Forms\Components\TimePicker::make('lunch_break_end')
                            ->label('Lunch End Time')
                            ->required()
                            ->helperText('Specify the end time for lunch break.'),

                        Forms\Components\Checkbox::make('late_arrival_tolerance_enabled')
                            ->label('Enable Late Arrival Tolerance')
                            ->helperText('Check this box to enable tolerance for late arrivals.'),

                        TextInput::make('late_arrival_tolerance_minutes')
                            ->integer()
                            ->label('Tolerance Minutes')
                            ->required()
                            ->helperText('Specify the tolerance time in minutes for late arrivals.'),

                        Forms\Components\Checkbox::make('early_departure_tolerance_enabled')
                            ->label('Enable Early Departure Tolerance')
                            ->helperText('Check this box to enable tolerance for early departures.'),

                        TextInput::make('early_departure_tolerance.minutes')
                            ->integer()
                            ->label('Tolerance Minutes')
                            ->required()
                            ->helperText('Specify the tolerance time in minutes for early departures.'),

                        Forms\Components\Checkbox::make('overtime_calculation_enabled')
                            ->label('Enable Overtime Calculation')
                            ->helperText('Check this box to enable overtime calculation.'),

                        TextInput::make('overtime_calculation_threshold')
                            ->integer()
                            ->label('Overtime Threshold (Minutes)')
                            ->required()
                            ->helperText('Specify the threshold for overtime calculation in minutes.'),

                        Forms\Components\Select::make('shifts')
                            ->options([
                                'single' => 'Single Shift',
                                'multiple' => 'Multiple Shifts',
                            ])
                            ->label('Shifts')
                            ->required()
                            ->helperText('Select the type of shifts (single or multiple).'),

                        Forms\Components\Checkbox::make('holiday_attendance_enabled')
                            ->label('Enable Holiday Attendance')
                            ->helperText('Check this box to enable attendance tracking on holidays.'),

                        Forms\Components\Checkbox::make('weekend_attendance_enabled')
                            ->label('Enable Weekend Attendance')
                            ->helperText('Check this box to enable attendance tracking on weekends.'),

                        Forms\Components\Checkbox::make('leave_management_integration_enabled')
                            ->label('Enable Leave Management Integration')
                            ->helperText('Check this box to integrate with leave management system.'),
                    ])
            ])
            ->columns(1);
    }
}
