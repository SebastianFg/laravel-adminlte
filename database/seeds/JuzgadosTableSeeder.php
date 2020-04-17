<?php

use Illuminate\Database\Seeder;
use App\Modelos\Juzgado;
class JuzgadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Juzgado::create([
        	'nombre_juzgado' => 'JUZGADO DE INSTRUCCIÓN Nº 1 PROVINCIA DE MISIONES',
        	'direccion_juzgado' => 'AVDA. LÓPEZ TORRES NRO 2690',
        	'telefono_juzgado' => '(0376) 4446440',
        	'responsable_juzgado' => 'DR. CARDOZO, MARCELO ALEJANDRO, JUEZ DE INSTRUCCIÓN'
        ]);
        Juzgado::create([
        	'nombre_juzgado' => 'JUZGADO DE INSTRUCCIÓN Nº 2 PROVINCIA DE MISIONES',
        	'direccion_juzgado' => 'CALLE SANTA FE NRO 1630 - PISO: PB',
        	'telefono_juzgado' => '(0376) 4446440',
        	'responsable_juzgado' => 'Dr. MONTE, JUAN MANUEL, JUEZ DE INSTRUCCIÓN'
        ]);
        Juzgado::create([
        	'nombre_juzgado' => 'JUZGADO DE INSTRUCCIÓN Nº 3 PROVINCIA DE MISIONES',
        	'direccion_juzgado' => 'CALLE SANTA FE NRO 1630 - PISO 1',
        	'telefono_juzgado' => ' (0376) 4446440',
        	'responsable_juzgado' => 'DR. VERON, FERNANDO LUIS, JUEZ DE INSTRUCCIÓN'
        ]);
        Juzgado::create([
        	'nombre_juzgado' => 'JUZGADO DE INSTRUCCIÓN Nº 6 PROVINCIA DE MISIONES',
        	'direccion_juzgado' => 'CALLE BUENOS AIRES NRO 1231 - PISO PB',
        	'telefono_juzgado' => ' (0376) 4446571',
        	'responsable_juzgado' => 'DR. BALOR, RICARDO WALTER, JUEZ DE INSTRUCCIÓN'
        ]);
        Juzgado::create([
        	'nombre_juzgado' => 'JUZGADO DE INSTRUCCIÓN Nº 7 PROVINCIA DE MISIONES',
        	'direccion_juzgado' => 'CALLE PEDRO MENDEZ ESQ. URUGUAY NRO 2221 - PISO PB',
        	'telefono_juzgado' => '(0376) 4446570',
        	'responsable_juzgado' => 'DR. CARDOZO, MARCELO ALEJANDRO, JUEZ DE INSTRUCCIÓN'
        ]);
        Juzgado::create([
        	'nombre_juzgado' => 'JUZGADO FEDERAL DE PRIMERA INSTANCIA EN LO CRIMINAL Y CORRECCIONAL DE LA PROVINCIA DE MISIONES',
        	'direccion_juzgado' => 'AVDA. MITRE 2358 - POSADAS (3300) - MISIONES',
        	'telefono_juzgado' => '(3764) 4424609',
        	'responsable_juzgado' => 'DR. RAMÓN CLAUDIO CHÁVEZ'
        ]);
        Juzgado::create([
        	'nombre_juzgado' => 'JUZGADO FEDERAL DE PRIMERA INSTANCIA DE OBERÁ PROVINCIA DE MISIONES',
        	'direccion_juzgado' => 'LARREA 974, OBERÁ, MISIONES',
        	'telefono_juzgado' => '(03755) 426912',
        	'responsable_juzgado' => 'DR. ALEJANDRO MARCOS GALLANDAT LUZURIAGA'
        ]);
        Juzgado::create([
        	'nombre_juzgado' => 'JUZGADO FEDERAL DE PRIMERA INSTANCIA EL DORADO PROVINCIA DE MISIONES',
        	'direccion_juzgado' => 'AMÉRICA 234, ELDORADO, MISIONES',
        	'telefono_juzgado' => '(03751) 42-3383',
        	'responsable_juzgado' => 'DR. MIGUEL ÁNGEL GUERRERO'
        ]);
    }
}
