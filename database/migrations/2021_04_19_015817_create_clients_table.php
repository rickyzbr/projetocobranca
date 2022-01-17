<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('client_statuses')->onDelete('cascade');  
            $table->integer('termination_id')->unsigned();
            $table->foreign('termination_id')->references('id')->on('types_end_clients')->onDelete('cascade'); 
            $table->integer('sale_id')->unsigned();
            $table->foreign('sale_id')->references('id')->on('types_sales_clients')->onDelete('cascade');
            $table->string('name');
            $table->string('supervisor')->nullable();
            $table->string('cadeiras_ativas');
            $table->string('cadeiras_capacidade');
            $table->string('address');
            $table->string('number');
            $table->string('complement')->nullable();
            $table->string('cep');
            $table->string('state');
            $table->string('city');
            $table->string('bairro');
            $table->string('regiao');
            $table->string('google_maps')->nullable();
            $table->string('populacao')->nullable();
            $table->string('cluster')->nullable();
            $table->string('country')->nullable();
            $table->string('razao_social');
            $table->string('cnpj');
            $table->string('cro');
            $table->string('insc')->nullable();
            $table->string('responsavel_tecnico')->nullable();
            $table->string('responsavel_tecnico_cro')->nullable();
            $table->string('phone01');
            $table->string('phone02')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('site')->nullable();
            $table->string('email')->nullable();
            $table->string('email_site')->nullable();
            $table->date('date_initial')->nullable();
            $table->date('date_end')->nullable();
            $table->date('date_open')->nullable();
            $table->date('date_termination')->nullable();
            $table->date('deadline_opening')->nullable();
            $table->text('description')->nullable();          
            $table->string('image', 100)->nullable();
            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
