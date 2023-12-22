<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('references');
            $table->unsignedBigInteger('employes_id');
            $table->foreign('employes_id')
                  ->references('id')
                  ->on('employes')
                  ->onDelete('cascade');
            $table->string('montant');
            $table->dateTime('launch_date');
            $table->dateTime('done_date');
            $table->enum('status',['SUCCESS','FAILED'])->default('SUCCESS');
            $table->enum('mois',[
                'JANVIER','FEVRIER','MARS','AVRIL','MAI','JUIN','JUiLLET','AOUT',
                'SEPTEMBRE','OCTOBRE','NOVEMBRE','DECEMBRE'
            ]);
            $table->string('annee');
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
        Schema::dropIfExists('payments');
    }
};
