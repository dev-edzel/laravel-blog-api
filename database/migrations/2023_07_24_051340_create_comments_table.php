<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->string('author');
            $table->unsignedBigInteger('post_id');
            $table->timestamps();

            // Add foreign key constraint to link the comment to the post
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}