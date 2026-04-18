<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ConfiguracionSistemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $configuraciones = [

            // ── Configuración WhatsApp ────────────────────────────────────────
            [
                'clave'       => 'whatsapp_numero',
                'valor'       => '3180631890', // ← Reemplazar: formato internacional sin '+'
                'descripcion' => 'Número de WhatsApp de la tienda en formato internacional (ej: 3180631890)',
                'grupo'       => 'whatsapp',
            ],
            [
                'clave'       => 'whatsapp_mensaje_pedido',
                'valor'       => 'Hola! ☕ Acabo de realizar el pedido *#{numero_pedido}* por *${monto_total}*. ¿Me pueden confirmar la disponibilidad y el proceso de envío? ¡Gracias!',
                'descripcion' => 'Mensaje predeterminado al redirigir al cliente a WhatsApp tras el pedido. Placeholders: {numero_pedido}, {monto_total}, {productos}',
                'grupo'       => 'whatsapp',
            ],
            [
                'clave'       => 'whatsapp_activo',
                'valor'       => 'true',
                'descripcion' => 'Activa o desactiva el botón de redirección a WhatsApp en el checkout',
                'grupo'       => 'whatsapp',
            ],

            // ── Configuración Wompi ───────────────────────────────────────────
            [
                'clave'       => 'wompi_llave_publica',
                'valor'       => 'pub_test_XXXXXXXXXXXXXXXX', // ← Reemplazar con llave real
                'descripcion' => 'Llave pública de Wompi (usada en el frontend/widget). Cambiar a pub_prod_... en producción.',
                'grupo'       => 'wompi',
            ],
            [
                'clave'       => 'wompi_llave_privada',
                'valor'       => 'prv_test_XXXXXXXXXXXXXXXX', // ← Reemplazar; guardar en .env en producción
                'descripcion' => 'Llave privada de Wompi (usada en el backend para firmar). NUNCA exponer en frontend.',
                'grupo'       => 'wompi',
            ],
            [
                'clave'       => 'wompi_llave_eventos',
                'valor'       => 'test_events_XXXXXXXXXXXXXXXX', // ← Reemplazar; se usa para validar firma del webhook
                'descripcion' => 'Llave de eventos de Wompi para validar la firma SHA256 del webhook entrante.',
                'grupo'       => 'wompi',
            ],
            [
                'clave'       => 'wompi_moneda',
                'valor'       => 'COP',
                'descripcion' => 'Moneda usada en todas las transacciones Wompi',
                'grupo'       => 'wompi',
            ],
            [
                'clave'       => 'wompi_ambiente',
                'valor'       => 'sandbox', // ← Cambiar a 'produccion' cuando estés listo
                'descripcion' => 'Ambiente de Wompi: sandbox (pruebas) o produccion',
                'grupo'       => 'wompi',
            ],

            // ── Configuración general de la tienda ───────────────────────────
            [
                'clave'       => 'tienda_nombre',
                'valor'       => 'Café Premium',
                'descripcion' => 'Nombre de la tienda mostrado en emails y mensajes',
                'grupo'       => 'tienda',
            ],
            [
                'clave'       => 'tienda_email_contacto',
                'valor'       => 'hola@cafepremium.co',
                'descripcion' => 'Email de contacto principal de la tienda',
                'grupo'       => 'tienda',
            ],
        ];

        // Usar upsert para poder re-ejecutar el seeder sin duplicar registros
        foreach ($configuraciones as $config) {
            DB::table('configuracion_sistema')->updateOrInsert(
                ['clave' => $config['clave']],
                array_merge($config, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
