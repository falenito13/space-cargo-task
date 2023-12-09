<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('request_response_logs', function (Blueprint $table) {
            $table->id();
            $table->string('method', 6);
            $table->string('session_id', 40);
            $table->ipAddress('ip_address');
            $table->string('address', 255);
            $table->json('parameters');
            $table->dateTime('request_time');
            $table->smallInteger('status_code');
            $table->text('error_message')->nullable();
            $table->json('response');
            $table->float('service_work_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_response_logs');
    }
};
