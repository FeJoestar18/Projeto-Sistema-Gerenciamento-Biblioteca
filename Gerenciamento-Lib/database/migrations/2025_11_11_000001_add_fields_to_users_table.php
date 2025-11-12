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
        Schema::table('users', function (Blueprint $table) {
            $table->text('cpf')->nullable()->after('email'); // Criptografado
            $table->text('cnpj')->nullable()->after('cpf'); // Criptografado
            $table->text('rg')->nullable()->after('cnpj'); // Criptografado
            $table->enum('role', ['admin', 'funcionario', 'usuario'])->default('usuario')->after('password');
            $table->boolean('is_blocked')->default(false)->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['cpf', 'cnpj', 'rg', 'role', 'is_blocked']);
        });
    }
};
