<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Seeder de datos de ejemplo para la tienda de café premium.
 * Puebla: usuarios, categorias, productos, producto_skus,
 *         pedidos, pedido_items y carrito_items.
 *
 * Ejecutar con: php artisan db:seed --class=CafeSeeder
 */
class CafeSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. USUARIOS ───────────────────────────────────────────────────────
        $this->command->info('Sembrando usuarios...');

        $adminId = DB::table('usuarios')->insertGetId([
            'nombre'     => 'Admin Café Premium',
            'email'      => 'admin@cafepremium.co',
            'contrasena' => Hash::make('password123'),
            'telefono'   => '573001234567',
            'rol'        => 'administrador',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $cliente1Id = DB::table('usuarios')->insertGetId([
            'nombre'     => 'Carlos Rodríguez',
            'email'      => 'carlos@gmail.com',
            'contrasena' => Hash::make('password123'),
            'telefono'   => '573159876543',
            'rol'        => 'cliente',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $cliente2Id = DB::table('usuarios')->insertGetId([
            'nombre'     => 'María Fernanda López',
            'email'      => 'mafe@hotmail.com',
            'contrasena' => Hash::make('password123'),
            'telefono'   => '573204567890',
            'rol'        => 'cliente',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ── 2. CATEGORÍAS ─────────────────────────────────────────────────────
        $this->command->info('Sembrando categorías...');

        $catOrigenId = DB::table('categorias')->insertGetId([
            'nombre'      => 'Café de Origen',
            'slug'        => 'cafe-de-origen',
            'descripcion' => 'Cafés especiales de una sola región colombiana, con perfil de sabor único y trazabilidad completa.',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        $catBlendId = DB::table('categorias')->insertGetId([
            'nombre'      => 'Blends Especiales',
            'slug'        => 'blends-especiales',
            'descripcion' => 'Mezclas cuidadosamente balanceadas entre distintos orígenes para lograr perfiles complejos y consistentes.',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        $catDescafId = DB::table('categorias')->insertGetId([
            'nombre'      => 'Descafeinado',
            'slug'        => 'descafeinado',
            'descripcion' => 'Café sin cafeína procesado con método agua suizo, conservando todos los sabores del grano original.',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        // ── 3. PRODUCTOS ──────────────────────────────────────────────────────
        $this->command->info('Sembrando productos...');

        $prod1Id = DB::table('productos')->insertGetId([
            'categoria_id' => $catOrigenId,
            'nombre'       => 'Huila Especial Lavado',
            'slug'         => 'huila-especial-lavado',
            'descripcion'  => 'Café de altura del sur del Huila, procesado por vía húmeda. Acidez brillante con cuerpo suave y dulzor prolongado.',
            'ruta_imagen'  => 'productos/huila-especial.jpg',
            'origen'       => 'Pitalito, Huila, Colombia',
            'altura'       => '1.700 - 2.100 msnm',
            'notas_cata'   => 'Durazno, Panela, Almendra, Jazmín',
            'esta_activo'  => true,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        $prod2Id = DB::table('productos')->insertGetId([
            'categoria_id' => $catOrigenId,
            'nombre'       => 'Nariño Natural Honey',
            'slug'         => 'narino-natural-honey',
            'descripcion'  => 'Procesado en honey, lo que le otorga una dulzura excepcional y cuerpo cremoso. Cosecha de pequeños productores del macizo colombiano.',
            'ruta_imagen'  => 'productos/narino-honey.jpg',
            'origen'       => 'La Unión, Nariño, Colombia',
            'altura'       => '1.800 - 2.300 msnm',
            'notas_cata'   => 'Frutos Rojos, Caramelo, Chocolate con Leche, Uva Pasa',
            'esta_activo'  => true,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        $prod3Id = DB::table('productos')->insertGetId([
            'categoria_id' => $catOrigenId,
            'nombre'       => 'Antioquia Sierra Nevada',
            'slug'         => 'antioquia-sierra-nevada',
            'descripcion'  => 'Proveniente de las estribaciones de la Sierra Nevada del Cocuy en Antioquia. Taza equilibrada y versátil para cualquier método de preparación.',
            'ruta_imagen'  => 'productos/antioquia-sierra.jpg',
            'origen'       => 'Jardín, Antioquia, Colombia',
            'altura'       => '1.500 - 1.900 msnm',
            'notas_cata'   => 'Chocolate Negro, Nuez, Manzana Verde, Miel',
            'esta_activo'  => true,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        $prod4Id = DB::table('productos')->insertGetId([
            'categoria_id' => $catBlendId,
            'nombre'       => 'Blend Casa Barista',
            'slug'         => 'blend-casa-barista',
            'descripcion'  => 'Nuestra mezcla estrella: 60% Huila + 40% Nariño. Diseñada para espresso en casa, con crema densa y equilibrio perfecto entre acidez y amargor.',
            'ruta_imagen'  => 'productos/blend-casa.jpg',
            'origen'       => 'Huila + Nariño, Colombia',
            'altura'       => '1.600 - 2.000 msnm',
            'notas_cata'   => 'Avellana, Caramelo, Cítrico Suave, Cuerpo Alto',
            'esta_activo'  => true,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        $prod5Id = DB::table('productos')->insertGetId([
            'categoria_id' => $catDescafId,
            'nombre'       => 'Descafeinado Swiss Water',
            'slug'         => 'descafeinado-swiss-water',
            'descripcion'  => 'Proceso suizo sin químicos que elimina el 99.9% de la cafeína preservando los aceites y aromas originales del grano.',
            'ruta_imagen'  => 'productos/descafeinado.jpg',
            'origen'       => 'Cauca, Colombia',
            'altura'       => '1.700 - 2.000 msnm',
            'notas_cata'   => 'Chocolate con Leche, Vainilla, Nuez Moscada',
            'esta_activo'  => true,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        // ── 4. PRODUCTO SKUs ──────────────────────────────────────────────────
        // Precio en CENTAVOS. Ejemplo: $28.000 COP = 2800000
        $this->command->info('Sembrando SKUs...');

        $skus = [
            // Huila Especial Lavado
            ['producto_id' => $prod1Id, 'sku' => 'HUI-LAV-250-CLA-GRA', 'peso_libras' => 0.55, 'nivel_tueste' => 'Claro',  'tipo_molienda' => 'Grano Entero',      'precio' => 2200000, 'stock' => 30],
            ['producto_id' => $prod1Id, 'sku' => 'HUI-LAV-500-MED-FIL', 'peso_libras' => 1.10, 'nivel_tueste' => 'Medio',  'tipo_molienda' => 'Filtro',             'precio' => 3800000, 'stock' => 25],
            ['producto_id' => $prod1Id, 'sku' => 'HUI-LAV-1LB-MED-GRA', 'peso_libras' => 1.00, 'nivel_tueste' => 'Medio',  'tipo_molienda' => 'Grano Entero',      'precio' => 3500000, 'stock' => 40],
            ['producto_id' => $prod1Id, 'sku' => 'HUI-LAV-2LB-MED-GRA', 'peso_libras' => 2.00, 'nivel_tueste' => 'Medio',  'tipo_molienda' => 'Grano Entero',      'precio' => 6500000, 'stock' => 15],

            // Nariño Natural Honey
            ['producto_id' => $prod2Id, 'sku' => 'NAR-HON-1LB-CLA-GRA', 'peso_libras' => 1.00, 'nivel_tueste' => 'Claro',  'tipo_molienda' => 'Grano Entero',      'precio' => 4200000, 'stock' => 20],
            ['producto_id' => $prod2Id, 'sku' => 'NAR-HON-1LB-CLA-FIL', 'peso_libras' => 1.00, 'nivel_tueste' => 'Claro',  'tipo_molienda' => 'Filtro',             'precio' => 4200000, 'stock' => 18],
            ['producto_id' => $prod2Id, 'sku' => 'NAR-HON-2LB-MED-GRA', 'peso_libras' => 2.00, 'nivel_tueste' => 'Medio',  'tipo_molienda' => 'Grano Entero',      'precio' => 7800000, 'stock' => 10],

            // Antioquia Sierra Nevada
            ['producto_id' => $prod3Id, 'sku' => 'ANT-SIE-1LB-MED-GRA', 'peso_libras' => 1.00, 'nivel_tueste' => 'Medio',  'tipo_molienda' => 'Grano Entero',      'precio' => 3200000, 'stock' => 35],
            ['producto_id' => $prod3Id, 'sku' => 'ANT-SIE-1LB-OSC-ESP', 'peso_libras' => 1.00, 'nivel_tueste' => 'Oscuro', 'tipo_molienda' => 'Espresso',           'precio' => 3200000, 'stock' => 28],
            ['producto_id' => $prod3Id, 'sku' => 'ANT-SIE-2LB-MED-PRE', 'peso_libras' => 2.00, 'nivel_tueste' => 'Medio',  'tipo_molienda' => 'Prensa Francesa',   'precio' => 5900000, 'stock' => 12],

            // Blend Casa Barista
            ['producto_id' => $prod4Id, 'sku' => 'BLE-CAS-1LB-MED-ESP', 'peso_libras' => 1.00, 'nivel_tueste' => 'Medio',  'tipo_molienda' => 'Espresso',           'precio' => 3600000, 'stock' => 50],
            ['producto_id' => $prod4Id, 'sku' => 'BLE-CAS-1LB-MED-GRA', 'peso_libras' => 1.00, 'nivel_tueste' => 'Medio',  'tipo_molienda' => 'Grano Entero',      'precio' => 3600000, 'stock' => 45],
            ['producto_id' => $prod4Id, 'sku' => 'BLE-CAS-5LB-MED-GRA', 'peso_libras' => 5.00, 'nivel_tueste' => 'Medio',  'tipo_molienda' => 'Grano Entero',      'precio' => 1600000, 'stock' => 8],

            // Descafeinado Swiss Water
            ['producto_id' => $prod5Id, 'sku' => 'DES-SWI-1LB-MED-GRA', 'peso_libras' => 1.00, 'nivel_tueste' => 'Medio',  'tipo_molienda' => 'Grano Entero',      'precio' => 4500000, 'stock' => 22],
            ['producto_id' => $prod5Id, 'sku' => 'DES-SWI-1LB-MED-FIL', 'peso_libras' => 1.00, 'nivel_tueste' => 'Medio',  'tipo_molienda' => 'Filtro',             'precio' => 4500000, 'stock' => 20],
        ];

        $skuIds = [];
        foreach ($skus as $sku) {
            $skuIds[$sku['sku']] = DB::table('producto_skus')->insertGetId([
                'producto_id'      => $sku['producto_id'],
                'sku'              => $sku['sku'],
                'peso_libras'      => $sku['peso_libras'],
                'nivel_tueste'     => $sku['nivel_tueste'],
                'tipo_molienda'    => $sku['tipo_molienda'],
                'precio'           => $sku['precio'],
                'stock_disponible' => $sku['stock'],
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }

        // ── 5. PEDIDOS ────────────────────────────────────────────────────────
        $this->command->info('Sembrando pedidos...');

        $pedido1Id = DB::table('pedidos')->insertGetId([
            'user_id'              => $cliente1Id,
            'numero_pedido'        => 'CAF-20260418-0001',
            // Monto total en centavos: $35.000 COP
            'monto_total'          => 3500000 + 4200000, // 2 productos
            'estado'               => 'pagado',
            'metodo_pago'          => 'CARD',
            'id_transaccion_pago'  => 'wompi-txn-257494-001',
            'direccion_envio'      => 'Calle 15 #23-45, Bogotá, Cundinamarca',
            'telefono_contacto'    => '573159876543',
            'notas'                => 'Dejar con el portero si no hay nadie.',
            'created_at'           => now()->subDays(3),
            'updated_at'           => now()->subDays(3),
        ]);

        $pedido2Id = DB::table('pedidos')->insertGetId([
            'user_id'              => $cliente2Id,
            'numero_pedido'        => 'CAF-20260418-0002',
            'monto_total'          => 3600000 + 4500000,
            'estado'               => 'pendiente',
            'metodo_pago'          => null,
            'id_transaccion_pago'  => null,
            'direccion_envio'      => 'Carrera 8 #12-30, Medellín, Antioquia',
            'telefono_contacto'    => '573204567890',
            'notas'                => null,
            'created_at'           => now()->subHours(2),
            'updated_at'           => now()->subHours(2),
        ]);

        $pedido3Id = DB::table('pedidos')->insertGetId([
            'user_id'              => $cliente1Id,
            'numero_pedido'        => 'CAF-20260418-0003',
            'monto_total'          => 6500000,
            'estado'               => 'enviado',
            'metodo_pago'          => 'PSE',
            'id_transaccion_pago'  => 'wompi-txn-257494-003',
            'direccion_envio'      => 'Calle 15 #23-45, Bogotá, Cundinamarca',
            'telefono_contacto'    => '573159876543',
            'notas'                => 'Regalo, por favor incluir tarjeta.',
            'created_at'           => now()->subDays(7),
            'updated_at'           => now()->subDays(5),
        ]);

        // ── 6. PEDIDO ITEMS ───────────────────────────────────────────────────
        $this->command->info('Sembrando items de pedidos...');

        DB::table('pedido_items')->insert([
            // Items del pedido 1
            [
                'pedido_id'       => $pedido1Id,
                'producto_sku_id' => $skuIds['HUI-LAV-1LB-MED-GRA'],
                'cantidad'        => 1,
                // Precio histórico en centavos al momento de la compra
                'precio_unitario' => 3500000,
                'created_at'      => now()->subDays(3),
                'updated_at'      => now()->subDays(3),
            ],
            [
                'pedido_id'       => $pedido1Id,
                'producto_sku_id' => $skuIds['NAR-HON-1LB-CLA-GRA'],
                'cantidad'        => 1,
                'precio_unitario' => 4200000,
                'created_at'      => now()->subDays(3),
                'updated_at'      => now()->subDays(3),
            ],
            // Items del pedido 2
            [
                'pedido_id'       => $pedido2Id,
                'producto_sku_id' => $skuIds['BLE-CAS-1LB-MED-ESP'],
                'cantidad'        => 1,
                'precio_unitario' => 3600000,
                'created_at'      => now()->subHours(2),
                'updated_at'      => now()->subHours(2),
            ],
            [
                'pedido_id'       => $pedido2Id,
                'producto_sku_id' => $skuIds['DES-SWI-1LB-MED-FIL'],
                'cantidad'        => 1,
                'precio_unitario' => 4500000,
                'created_at'      => now()->subHours(2),
                'updated_at'      => now()->subHours(2),
            ],
            // Items del pedido 3
            [
                'pedido_id'       => $pedido3Id,
                'producto_sku_id' => $skuIds['HUI-LAV-2LB-MED-GRA'],
                'cantidad'        => 1,
                'precio_unitario' => 6500000,
                'created_at'      => now()->subDays(7),
                'updated_at'      => now()->subDays(7),
            ],
        ]);

        // ── 7. CARRITO ITEMS ──────────────────────────────────────────────────
        // Simula que María Fernanda tiene productos en su carrito sin comprar aún
        $this->command->info('Sembrando carritos...');

        DB::table('carrito_items')->insert([
            [
                'user_id'         => $cliente2Id,
                'producto_sku_id' => $skuIds['ANT-SIE-1LB-MED-GRA'],
                'cantidad'        => 2,
                'created_at'      => now()->subHours(1),
                'updated_at'      => now()->subHours(1),
            ],
            [
                'user_id'         => $cliente2Id,
                'producto_sku_id' => $skuIds['BLE-CAS-1LB-MED-GRA'],
                'cantidad'        => 1,
                'created_at'      => now()->subHours(1),
                'updated_at'      => now()->subHours(1),
            ],
        ]);

        $this->command->info('✅ CafeSeeder completado con éxito.');
        $this->command->table(
            ['Tabla', 'Registros insertados'],
            [
                ['usuarios',       3],
                ['categorias',     3],
                ['productos',      5],
                ['producto_skus',  15],
                ['pedidos',        3],
                ['pedido_items',   5],
                ['carrito_items',  2],
            ]
        );
    }
}
