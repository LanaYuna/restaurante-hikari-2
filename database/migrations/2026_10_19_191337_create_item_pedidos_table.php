<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void{
        Schema::create('itens_pedido', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pedido_id')
                ->constrained('pedidos')
                ->cascadeOnDelete();

            $table->foreignId('produto_id')
                ->nullable()
                ->constrained('produtos')
                ->nullOnDelete();

            $table->string('nome_produto');

            $table->decimal('preco_unitario', 10, 2);

            $table->unsignedInteger('quantidade');

            $table->decimal('subtotal', 10, 2);

            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('item_pedidos');
    }
};
