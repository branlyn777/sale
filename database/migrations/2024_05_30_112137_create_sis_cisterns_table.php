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
        Schema::create('sis_cisterns', function (Blueprint $table) {
            $table->id();
            


            // CHECK ALVAMA (Excel)
            $table->date('fecha');
            $table->string('placa_1');
            $table->string('placa_2');

            // Tarjeta de Operaciones
            $table->string('tracto');
            $table->string('cisterna');

            // Documentos
            $table->enum('ruat', ['ok', 'corregir', 'falta'])->default('falta');
            $table->enum('certificado_de_fabricacion_del_tanque', ['ok', 'corregir', 'falta'])->default('falta');
            $table->enum('poliza_de_seguro', ['ok', 'corregir', 'falta'])->default('falta');
            $table->enum('certificado_hermeticidad', ['ok', 'corregir', 'falta'])->default('falta');
            $table->enum('tarjeta_de_cubicacion', ['ok', 'corregir', 'falta'])->default('falta');
            $table->enum('nit', ['ok', 'corregir', 'falta'])->default('falta');


            // Fotografias del Cisterna
            $table->enum('posterior', ['ok', 'corregir', 'falta'])->default('falta');
            $table->enum('superior', ['ok', 'corregir', 'falta'])->default('falta');
            $table->enum('lateral_izquierdo', ['ok', 'corregir', 'falta'])->default('falta');
            $table->enum('lateral_derecho', ['ok', 'corregir', 'falta'])->default('falta');
            $table->enum('frontal_con_equipos_de_seguridad', ['ok', 'corregir', 'falta'])->default('falta');
            $table->enum('plaqueta_cisterna', ['ok', 'corregir', 'falta'])->default('falta');
            $table->enum('foto_valvulas', ['ok', 'corregir', 'falta'])->default('falta');            



            // Cubicadora
            $table->enum('plaqueta', ['ok', 'corregir', 'falta'])->default('falta');
            $table->enum('precintos', ['ok', 'corregir', 'falta'])->default('falta');
            $table->enum('stickers_afericion', ['ok', 'corregir', 'falta'])->default('falta');            


            // Licencia y Listado Conductores
            $table->enum('licencia_conductor_principal', ['ok', 'corregir', 'falta'])->default('falta');
            $table->enum('licencia_conductor_reemplazo', ['ok', 'corregir', 'falta'])->default('falta');            

            // RR PP
            $table->string('vigencia_poder');




            // DATOS DEL SEMIREMOLQUE
            $table->string('marca');
            $table->string('clase');
            $table->string('forma');

            // Capacidad Compartimientos (Compartimientos Dos)
            $table->integer('compartimiento_litros_1');
            $table->integer('compartimiento_litros_2');
            $table->integer('compartimiento_galones_1');
            $table->integer('compartimiento_galones_2');

            $table->string('norma_de_fabricacion');
            $table->integer('numero_de_rompeolas');
            $table->decimal('presion_de_diseno', 7, 2);
            $table->decimal('presion_de_prueba', 7, 2);

            // Medidas del Cisterna
            $table->integer('compartimiento_1');
            $table->integer('compartimiento_2');
            $table->decimal('largo_1', 5, 2);
            $table->decimal('largo_2', 5, 2);
            $table->decimal('ancho_1', 5, 2);
            $table->decimal('ancho_2', 5, 2);
            $table->decimal('alto_1', 5, 2);
            $table->decimal('alto_2', 5, 2);

            $table->decimal('distancia_entre_ejes_1', 5, 2);
            $table->decimal('distancia_entre_ejes_2', 5, 2);
            $table->decimal('tara', 5, 2);
            $table->decimal('corrosion', 5, 2);

            $table->integer('valvulas_de_descarga');
            $table->string('tapas_externas_con_valvulas_de_admision_o_escotillas');
            $table->enum('sistemas_de_recuperacion_de_gases_o_vapores', ['si', 'no'])->default('no');
            $table->enum('sistema_de_sensor_de_llenado_o_sobrellenado', ['si', 'no'])->default('no');
            $table->enum('sistema_de_puesta_a_tierra', ['si', 'no'])->default('no');
            $table->enum('sistema_de_carga_por_fondo', ['si', 'no'])->default('no');



            // DATOS DEL CHASIS
            $table->date('fecha_de_fabricacion');
            $table->string('numero_de_chasis');
            $table->string('numero_de_serie');

            $table->integer('numero_de_ejes');
            $table->integer('numero_de_llantas');
            $table->string('material');
            $table->string('tipo_de_soldadura_a');
            $table->string('color_cisterna');
            $table->string('tipo_de_soldadura_b');
            $table->string('conductor_de_descarga');

            // Espesores de plancha
            $table->decimal('cabeza', 5, 2);
            $table->decimal('tapas', 5, 2);
            $table->decimal('manto', 5, 2);
            $table->decimal('antivuelque', 5, 2);
            $table->integer('numero_de_hojas');

            // Agrega campos de timestamps y soft deletes
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sis_cisterns');
    }
};
