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
        Schema::table('projectts', function (Blueprint $table) {
            $table->ForeignId('type_id')->nullable()->after('id')->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projectts', function (Blueprint $table) {
            $table->dropForeign('projectts_type_id_foreign'); 
                               
            $table->dropColumn('type_id');

        });
    }
};
