<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReleasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('releases', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->string('account');
            $table->date('issue_date');
            $table->date('due_date');
            $table->string('emp_tp_processo');
            $table->integer('partner_id')->unsigned()->nullable();
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('release_statuses')->onDelete('cascade');
            $table->integer('wallets_id')->unsigned();
            $table->foreign('wallets_id')->references('id')->on('type_wallets')->onDelete('cascade');
            $table->integer('bank_id')->unsigned();
            $table->foreign('bank_id')->references('id')->on('type_banks')->onDelete('cascade');
            $table->integer('operations_id')->unsigned();
            $table->foreign('operations_id')->references('id')->on('type_operations')->onDelete('cascade');
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('type_releases')->onDelete('cascade');
            $table->unsignedBigInteger('assigned_to')->unsigned()->nullable();
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');
            $table->integer('month_id')->unsigned()->nullable();
            $table->foreign('month_id')->references('id')->on('month_releases')->onDelete('cascade');
            $table->double('amount', 10, 2)->default(0);
            $table->double('amount_paid', 10, 2)->default(0);
            $table->boolean('recurrent');    
            $table->boolean('franchisee');     
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('releases');
    }
}
