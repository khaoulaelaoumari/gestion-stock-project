<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactureFourniProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facture_fourni_produits', function (Blueprint $table) {
            $table->bigInteger('id_produit')->unsigned();
            $table->bigInteger('id_facture')->unsigned();
            $table->foreign('id_produit')->references('id')->on('produits');
            $table->foreign('id_facture')->references('id')->on('facture_fournisseurs');
            $table->double('quantite');
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
        Schema::dropIfExists('facture_fourni_produits');
    }
}
