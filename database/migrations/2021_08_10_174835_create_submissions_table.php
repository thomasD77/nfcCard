<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->integer('phone');
            $table->date('date')->nullable();
            $table->boolean('approval')->nullable();
            $table->text('description')->nullable();
            $table->boolean('archived')->default(0);
            $table->timestamps();
        });

        DB::table('submissions')->insert([
            'name' => 'Pol Vanhoeve',
            'email' => 'pol.vanhoeve@gmail.com',
            'phone' => '474413669',
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'approval' => 1,
            'archived' => 0,
            'description' => 'Het is al geruime tijd een bekend gegeven dat een lezer, tijdens het bekijken van de layout van een pagina, afgeleid wordt door de tekstuele inhoud. Het belangrijke punt van het gebruik van Lorem Ipsum is dat het uit een min of meer normale verdeling van letters bestaat, in tegenstelling tot "Hier uw tekst, hier uw tekst" wat het tot min of meer leesbaar nederlands maakt. Veel desktop publishing pakketten nl web pagina editors gebruiken tegenwoordig Lorem Ipsum als hun standaard model tekst, nl een zoekopdracht naar "lorem ipsum" ontsluit veel websites die nog in aanbouw zijn. Verscheidene versies hebben zich ontwikkeld in de loop van de jaren, soms per ongeluk soms expres (ingevoegde humor nl dergelijke).',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('submissions')->insert([
            'name' => 'Mark Vanhoeve',
            'email' => 'pol.vanhoeve@gmail.com',
            'phone' => '474413669',
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'approval' => 1,
            'archived' => 0,
            'description' => 'Het is al geruime tijd een bekend gegeven dat een lezer, tijdens het bekijken van de layout van een pagina, afgeleid wordt door de tekstuele inhoud. Het belangrijke punt van het gebruik van Lorem Ipsum is dat het uit een min of meer normale verdeling van letters bestaat, in tegenstelling tot "Hier uw tekst, hier uw tekst" wat het tot min of meer leesbaar nederlands maakt. Veel desktop publishing pakketten nl web pagina editors gebruiken tegenwoordig Lorem Ipsum als hun standaard model tekst, nl een zoekopdracht naar "lorem ipsum" ontsluit veel websites die nog in aanbouw zijn. Verscheidene versies hebben zich ontwikkeld in de loop van de jaren, soms per ongeluk soms expres (ingevoegde humor nl dergelijke).',
            'created_at' => Carbon::now()->subMonths(2)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('submissions')->insert([
            'name' => 'Mark Vanhoeve',
            'email' => 'pol.vanhoeve@gmail.com',
            'phone' => '474413669',
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'approval' => 1,
            'archived' => 0,
            'description' => 'Het is al geruime tijd een bekend gegeven dat een lezer, tijdens het bekijken van de layout van een pagina, afgeleid wordt door de tekstuele inhoud. Het belangrijke punt van het gebruik van Lorem Ipsum is dat het uit een min of meer normale verdeling van letters bestaat, in tegenstelling tot "Hier uw tekst, hier uw tekst" wat het tot min of meer leesbaar nederlands maakt. Veel desktop publishing pakketten nl web pagina editors gebruiken tegenwoordig Lorem Ipsum als hun standaard model tekst, nl een zoekopdracht naar "lorem ipsum" ontsluit veel websites die nog in aanbouw zijn. Verscheidene versies hebben zich ontwikkeld in de loop van de jaren, soms per ongeluk soms expres (ingevoegde humor nl dergelijke).',
            'created_at' => Carbon::now()->subMonths(2)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submissions');
    }
}
