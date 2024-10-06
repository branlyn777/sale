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
        Schema::create('sis_payrolls', function (Blueprint $table) {
            $table->id();
            $table->string('cliente')->nullable();
            $table->string('numero_de_transporte')->nullable();
            $table->string('propietario')->nullable();
            $table->string('placa')->nullable();
            $table->string('tramo')->nullable();
            $table->string('producto')->nullable();
            $table->date('fecha_de_carga')->nullable();
            $table->string('carguio')->nullable();
            $table->date('fecha_de_llegada')->nullable();
            $table->decimal('volumen_descarguio', 22, 10)->nullable();
            $table->decimal('merma_carguio', 22, 10)->nullable();
            $table->decimal('merma_limite_excedible', 22, 10)->nullable();
            $table->decimal('cobros_al_100_de_la_merma', 22, 10)->nullable();
            $table->decimal('merma_cobrable', 22, 10)->nullable()->nullable();
            $table->decimal('precio_de_la_merma', 22, 10)->nullable();
            $table->decimal('merma_por_cobrar', 22, 10)->nullable();
            $table->decimal('flete', 22, 10)->nullable();
            $table->decimal('liquido_basico', 22, 10)->nullable();
            $table->decimal('derecho_de_empresa', 22, 10)->nullable();
            $table->decimal('liquido_facturado', 22, 10)->nullable();
            $table->decimal('anticipo', 22, 10)->nullable();
            $table->date('fecha_de_pago_anticipo')->nullable();
            $table->string('fecha_de_pago_anticipo_literal')->nullable();
            $table->decimal('saldo', 22, 10)->nullable();
            $table->date('fecha_de_pago')->nullable();
            $table->string('fecha_de_pago_saldo_literal')->nullable();
            $table->decimal('total', 22, 10)->nullable();
            $table->decimal('total_deuda', 22, 10)->nullable();
            $table->string('factura_numero')->nullable();
            $table->date('fecha')->nullable();
            $table->string('it')->nullable();
            $table->string('resolucion_internacional')->nullable();
            $table->string('poliza_de_responsabilidad_civil')->nullable();
            $table->string('poliza_de_transporte')->nullable();
            $table->string('iva')->nullable();
            $table->decimal('gastos_administrativos_santa_cruz', 22, 10)->nullable();
            $table->decimal('merma', 22, 10)->nullable();
            $table->decimal('ibmetro', 22, 10)->nullable();
            $table->decimal('rastreo_satelital', 22, 10)->nullable();
            $table->decimal('otros_descuentos', 22, 10)->nullable();
            $table->decimal('totales', 22, 10)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sis_payrolls');
    }
};
