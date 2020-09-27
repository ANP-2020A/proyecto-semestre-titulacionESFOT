<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
//            $table->integer('director_id');
//            $table->integer('coodirector_id');
            $table->string('title', 255)->nullable();
            $table->string('general_objective', 255)->nullable();
            $table->string('specifics_objectives', 255)->nullable();
            $table->text('problem')->nullable();
            $table->text('hypothesis')->nullable();
            $table->text('justification')->nullable();
            $table->text('methodology')->nullable();
            $table->text('work_plan')->nullable();
            $table->text('project_type')->nullable();
            $table->text('bibliography')->nullable();
            $table->string('research_line', 255)->nullable();
            $table->string('knowledge_area', 255)->nullable();
            $table->enum('status', [
                'plan_saved',
                'plan_sent',
                'plan_approved_director',
                'san_curriculum_1',
                'plan_review_commission',
                'plan_approved_commission',
                'project_uploaded',
                'project_approved_director'.
                'san_curriculum_2',
                'tribunal_assigned',
                'project_graded',
                'test_defense_apt',
                'date_defense_assigned',
                'project_completed',
                'plan_rejected',
                'project_rejected']);
            $table->timestamps();
            $table->dateTime('uploaded_at')->nullable();
            $table->string('schedule')->nullable();
            $table->string('report_pdf', 255)->nullable();
            $table->dateTime('report_uploaded_at')->nullable();
            $table->dateTime('report_modified_at')->nullable();
            $table->bigInteger('teacher_id')->unsigned();
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('restrict');
        });

        Schema::create('project_student', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('restrict');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('restrict');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('project_student');
        Schema::dropIfExists('projects');
        Schema::enableForeignKeyConstraints();
    }
}
