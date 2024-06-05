<?php

use App\Enums\StaffDesignation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->down();
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->foreignId('permission_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('permission_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('roll_number')->unique();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender');
            $table->string('contact_number');
            $table->text('address')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('staff_id')->unique();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->enum('designation', StaffDesignation::toSelectArray());
            $table->string('contact_number');
            $table->string('email')->unique();
            $table->text('address')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_code')->unique();
            $table->string('course_name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
        Schema::create('class_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('class_name');
            $table->dateTime('class_time')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
        });
        Schema::create('student_class_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('class_detail_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('qr_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_detail_id')->constrained()->onDelete('cascade');
            $table->string('qr_code')->unique();
            $table->timestamp('generated_at');
            $table->timestamp('expires_at');
            $table->timestamps();
        });
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('class_detail_id')->constrained()->onDelete('cascade');
            $table->foreignId('qr_code_id')->constrained()->onDelete('cascade');
            $table->timestamp('checked_in_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('qr_codes');
        Schema::dropIfExists('student_class_details');
        Schema::dropIfExists('class_details');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('students');
        Schema::dropIfExists('staff');
        Schema::dropIfExists('user_permissions');
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('role_permissions');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
    }
};
