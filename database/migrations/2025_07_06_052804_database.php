<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{   
    public function up(): void
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->date('date_of_birth')->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('address', 200)->nullable();
            $table->binary('photo')->nullable();
            $table->timestamps();
        });

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('persons');
            $table->string('enrollment_number', 20)->unique();
            $table->date('enrollment_date')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('persons');
            $table->integer('current_grade_level')->nullable();
            $table->timestamps();
        });

        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('persons');
            $table->string('staff_number', 20)->unique();
            $table->date('hire_date')->nullable();
            $table->string('position', 50)->nullable();
            $table->string('department', 50)->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained('staff');
            $table->string('subject_specialization', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('subject_name', 100);
            $table->string('subject_code', 20)->unique();
            $table->string('description', 500)->nullable();
            $table->string('department', 50)->nullable();
            $table->timestamps();
        });

        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('class_name', 50);
            $table->integer('grade_level');
            $table->string('academic_year', 20);
            $table->foreignId('homeroom_teacher_id')->nullable()->constrained('teachers');
            $table->timestamps();
        });

        Schema::create('class_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('classes');
            $table->foreignId('subject_id')->constrained('subjects');
            $table->foreignId('teacher_id')->constrained('teachers');
            $table->string('schedule_day', 10);
            $table->time('start_time');
            $table->time('end_time');
            $table->string('room_number', 20)->nullable();
            $table->timestamps();
        });

        Schema::create('student_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('class_id')->constrained('classes');
            $table->date('enrollment_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });

        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('class_subject_id')->constrained('class_subjects');
            $table->date('date');
            $table->string('status', 20); // Present, Absent, Late, Excused
            $table->string('notes', 200)->nullable();
            $table->timestamps();
        });

        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('class_subject_id')->constrained('class_subjects');
            $table->string('grade_type', 20); // Exam, Quiz, Homework, Project
            $table->date('grade_date');
            $table->decimal('score', 5, 2);
            $table->decimal('max_score', 5, 2);
            $table->decimal('weight', 5, 2);
            $table->string('comments', 200)->nullable();
            $table->timestamps();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users2');
            $table->foreignId('receiver_id')->constrained('users2');
            $table->string('title', 100);
            $table->string('message', 500);
            $table->dateTime('sent_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('notifications');
        Schema::dropIfExists('grades');
        Schema::dropIfExists('attendance');
        Schema::dropIfExists('student_classes');
        Schema::dropIfExists('class_subjects');
        Schema::dropIfExists('classes');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('staff');
        Schema::dropIfExists('students');
        Schema::dropIfExists('persons');
        Schema::dropIfExists('users2');

        Schema::enableForeignKeyConstraints();
    }

};
