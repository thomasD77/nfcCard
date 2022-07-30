<?php

    use App\Models\JobFunction;
    use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Schema;

class CreateJobFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_functions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $jobs = [
            "Accounting",
            "Administrative",
            "Arts and Design",
            "Business Development",
            "Community and Social Services",
            "Consulting",
            "Construction",
            "Education",
            "Engineering",
            "Entrepreneurship",
            "Finance",
            "Healthcare Services",
            "Human Resources",
            "Information Technology",
            "Legal",
            "Marketing",
            "Media and Communication",
            "Military and Protective Services",
            "Operations",
            "Product Management",
            "Program and Project Management",
            "Purchasing",
            "Pharma",
            "Medical",
            "Software",
            "Quality Assurance",
            "Real Estate",
            "Research",
            "Sales",
            "Support",
        ];

        $jobsToInsert = [];
        foreach($jobs as $job){
            $jobsToInsert[] = [
                'name' => $job,
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ];
        }

        JobFunction::insert($jobsToInsert);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_functions');
    }
}
