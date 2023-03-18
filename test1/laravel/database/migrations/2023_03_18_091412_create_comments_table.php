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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->unsignedBigInteger('post_id');
            $table->timestamps();

            // 在 comments 表格中新增了一個 post_id 欄位，用來與 posts 表格進行關聯。$table->foreign() 方法是用來建立外來鍵，onDelete('cascade') 表示當 posts 表格中某個記錄被刪除時，與之相關聯的 comments 表格中的記錄也會被自動刪除。
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
