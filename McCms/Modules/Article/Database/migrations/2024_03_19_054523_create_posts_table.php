<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('标题|input');
            $table->string('author')->nullable()->comment('作者');
            $table->integer('cate_id')->default(0)->comment('分类id');
            $table->text('content')->comment('内容');
            $table->string('thumb')->nullable()->comment('缩略图');
            $table->integer('click')->default(0)->comment('点击数');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};