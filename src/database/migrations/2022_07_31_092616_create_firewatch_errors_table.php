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
        Schema::create('firewatch_errors', function (Blueprint $table) {
            $table->id();
            $table->text('error_message');
            $table->integer('error_line_no');
            $table->string('error_file_name');
            $table->string('error_code');
            $table->longText('error_stack_trace');
            $table->integer('occurence_count')->default(1);

            $table->string('request_url');
            $table->string('request_method');
            $table->longText('request_headers')->nullable();
            $table->longText('request_query_string')->nullable();
            $table->longText('request_body')->nullable();
            $table->longText('request_files')->nullable();
            $table->longText('request_session')->nullable();
            $table->longText('request_cookies')->nullable();

            $table->foreignId('assignee_user_id')->nullable()->constrained(config('firewatch.user.table'));
            $table->foreignId('solved_by_user_id')->nullable()->constrained(config('firewatch.user.table'));
            $table->bigInteger('solved_date')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firewatch_errors');
    }
};
