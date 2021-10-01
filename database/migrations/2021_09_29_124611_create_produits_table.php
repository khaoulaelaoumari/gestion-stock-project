<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('fournis_id')->unsigned();
            $table->foreign('fournis_id')->references('id')->on('fournisseurs');
            $table->string('Nom')->nullable();
            $table->float('Prix_Achat')->nullable();
            $table->string('ref-prod')->nullable();
            $table->bigInteger('quantite')->nullable();
            $table->float('tva')->nullable();
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
        Schema::dropIfExists('produits');
    }
}
