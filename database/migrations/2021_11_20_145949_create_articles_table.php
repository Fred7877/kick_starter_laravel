<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('subtitle', 200);
            $table->text('body');
            $table->string('status'); // draft, ready, audit, refused
            $table->foreignId('author_id')->constrained('users');
            $table->date('start_publish_date');
            $table->date('end_publish_date');
            $table->date('publish_date');

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
        Schema::dropIfExists('articles');
    }
}
