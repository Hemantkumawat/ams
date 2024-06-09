<?php

namespace Database\Seeders;

use App\Models\ClassDetail;
use App\Models\Course;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default roles
        $roles = ['Admin', 'Teacher', 'Student'];
        foreach ($roles as $role) {
            Role::query()->create(['name' => $role]);
        }

        // Default permissions
        $permissions = ['Create', 'Read', 'Update', 'Delete'];
        foreach ($permissions as $permission) {
            Permission::query()->create(['name' => $permission]);
        }

        // Default courses
        $courses = [
            ['course_code' => 'BATCH2024-25', 'course_name' => 'Batch 2024-25'],
            ['course_code' => 'CSE101', 'course_name' => 'Computer Science Basics'],
            ['course_code' => 'CSE102', 'course_name' => 'Advanced Computer Science'],
            // Add more courses as needed
        ];
        foreach ($courses as $course) {
            Course::query()->create($course);
        }

        // Default classes
        $classes = [
            ['course_id' => 1, 'class_name' => 'LKG', 'class_time' => '2023-01-01 09:00:00', 'location' => 'Room 101'],
            ['course_id' => 1, 'class_name' => 'UKG', 'class_time' => '2023-01-01 09:00:00', 'location' => 'Room 102'],
            ['course_id' => 1, 'class_name' => '1', 'class_time' => '2023-01-01 09:00:00', 'location' => 'Room 103'],
            ['course_id' => 1, 'class_name' => '2', 'class_time' => '2023-01-01 09:00:00', 'location' => 'Room 104'],
            ['course_id' => 1, 'class_name' => '3', 'class_time' => '2023-01-01 09:00:00', 'location' => 'Room 105'],
            ['course_id' => 1, 'class_name' => '4', 'class_time' => '2023-01-01 09:00:00', 'location' => 'Room 106'],
            ['course_id' => 1, 'class_name' => '5', 'class_time' => '2023-01-01 09:00:00', 'location' => 'Room 107'],
            ['course_id' => 1, 'class_name' => '6', 'class_time' => '2023-01-01 09:00:00', 'location' => 'Room 108'],
            ['course_id' => 1, 'class_name' => '7', 'class_time' => '2023-01-01 09:00:00', 'location' => 'Room 108'],
            ['course_id' => 1, 'class_name' => '8', 'class_time' => '2023-01-01 09:00:00', 'location' => 'Room 109'],
            ['course_id' => 1, 'class_name' => '9', 'class_time' => '2023-01-01 09:00:00', 'location' => 'Room 110'],
            ['course_id' => 1, 'class_name' => '10', 'class_time' => '2023-01-01 09:00:00', 'location' => 'Room 111'],
            ['course_id' => 1, 'class_name' => '11', 'class_time' => '2023-01-01 09:00:00', 'location' => 'Room 112'],
            ['course_id' => 1, 'class_name' => '12', 'class_time' => '2023-01-01 09:00:00', 'location' => 'Room 113'],

            /*['course_id' => 1, 'class_name' => 'Intro to CS', 'class_time' => '2023-01-01 09:00:00', 'location' => 'Room 101'],
            ['course_id' => 2, 'class_name' => 'Advanced CS', 'class_time' => '2023-01-01 10:00:00', 'location' => 'Room 102'],*/
            // Add more classes as needed
        ];

        foreach ($classes as $class) {
            ClassDetail::query()->create($class);
        }

        $settings = array(
            array(
                "group" => "general",
                "name" => "attendance_method",
                "locked" => 0,
                "payload" => "\"qr_code\"",
                "created_at" => "2024-06-09 11:41:25",
                "updated_at" => "2024-06-09 11:48:50"
            ),
            array(
                "group" => "general",
                "name" => "punch_in_time_start",
                "locked" => 0,
                "payload" => "\"08:00:00\"",
                "created_at" => "2024-06-09 11:41:25",
                "updated_at" => "2024-06-09 11:48:50"
            ),
            array(
                "group" => "general",
                "name" => "punch_in_time_end",
                "locked" => 0,
                "payload" => "\"10:00:00\"",
                "created_at" => "2024-06-09 11:41:25",
                "updated_at" => "2024-06-09 11:48:50"
            ),
            array(
                "group" => "general",
                "name" => "lunch_break_enabled",
                "locked" => 0,
                "payload" => "false",
                "created_at" => "2024-06-09 11:41:25",
                "updated_at" => "2024-06-09 11:48:50"
            ),
            array(
                "group" => "general",
                "name" => "lunch_break_start",
                "locked" => 0,
                "payload" => "\"12:00:00\"",
                "created_at" => "2024-06-09 11:41:25",
                "updated_at" => "2024-06-09 11:48:50"
            ),
            array(
                "group" => "general",
                "name" => "lunch_break_end",
                "locked" => 0,
                "payload" => "\"13:00:00\"",
                "created_at" => "2024-06-09 11:41:25",
                "updated_at" => "2024-06-09 11:48:50"
            ),
            array(
                "group" => "general",
                "name" => "late_arrival_tolerance_enabled",
                "locked" => 0,
                "payload" => "false",
                "created_at" => "2024-06-09 11:41:25",
                "updated_at" => "2024-06-09 11:48:50"
            ),
            array(
                "group" => "general",
                "name" => "late_arrival_tolerance_minutes",
                "locked" => 0,
                "payload" => "0",
                "created_at" => "2024-06-09 11:41:25",
                "updated_at" => "2024-06-09 11:48:50"
            ),
            array(
                "group" => "general",
                "name" => "early_departure_tolerance_enabled",
                "locked" => 0,
                "payload" => "false",
                "created_at" => "2024-06-09 11:41:25",
                "updated_at" => "2024-06-09 11:48:50"
            ),
            array(
                "group" => "general",
                "name" => "early_departure_tolerance_minutes",
                "locked" => 0,
                "payload" => "0",
                "created_at" => "2024-06-09 11:41:25",
                "updated_at" => "2024-06-09 11:48:50"
            ),
            array(
                "group" => "general",
                "name" => "overtime_calculation_enabled",
                "locked" => 0,
                "payload" => "true",
                "created_at" => "2024-06-09 11:41:25",
                "updated_at" => "2024-06-09 11:48:50"
            ),
            array(
                "group" => "general",
                "name" => "overtime_calculation_threshold",
                "locked" => 0,
                "payload" => "0",
                "created_at" => "2024-06-09 11:41:25",
                "updated_at" => "2024-06-09 11:48:50"
            ),
            array(
                "group" => "general",
                "name" => "shifts",
                "locked" => 0,
                "payload" => "\"single\"",
                "created_at" => "2024-06-09 11:41:25",
                "updated_at" => "2024-06-09 11:48:50"
            ),
            array(
                "group" => "general",
                "name" => "holiday_attendance_enabled",
                "locked" => 0,
                "payload" => "false",
                "created_at" => "2024-06-09 11:41:25",
                "updated_at" => "2024-06-09 11:41:25"
            ),
            array(
                "group" => "general",
                "name" => "weekend_attendance_enabled",
                "locked" => 0,
                "payload" => "false",
                "created_at" => "2024-06-09 11:41:25",
                "updated_at" => "2024-06-09 11:41:25"
            ),
            array(
                "group" => "general",
                "name" => "leave_management_integration_enabled",
                "locked" => 0,
                "payload" => "false",
                "created_at" => "2024-06-09 11:41:25",
                "updated_at" => "2024-06-09 11:41:25"
            )
        );
        DB::table('settings')->truncate();
        foreach ($settings as $setting) {
            DB::table('settings')->insert($setting);
        }
    }
}
