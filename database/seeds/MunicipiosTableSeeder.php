<?php

use Illuminate\Database\Seeder;
use App\modelos\municipio;
class MunicipiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Municipio::create([
        	'nombre_municipio' => 'Santiago de Liniers',
        	'nombre_departamento' => 'Eldorado',
        	'poblacion' => '1950',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Norte',
        	'ur' => 'III',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Corpus',
        	'nombre_departamento' => 'San Ignacio',
        	'poblacion' => '3568',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'IX',
        ]);

		Municipio::create([
        	'nombre_municipio' => 'Itacaruare',
        	'nombre_departamento' => 'Eldorado',
        	'poblacion' => '3398',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'VI',
        ]);

		Municipio::create([
        	'nombre_municipio' => 'Puerto Rico',
        	'nombre_departamento' => 'Libertador General San Martin',
        	'poblacion' => '19500',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'IV',
        ]);

		Municipio::create([
        	'nombre_municipio' => 'Gobernador Roca',
        	'nombre_departamento' => 'San Ignacio',
        	'poblacion' => '6668',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'IX',
        ]);

		Municipio::create([
        	'nombre_municipio' => 'Montecarlo',
        	'nombre_departamento' => 'Montecarlo',
        	'poblacion' => '24338',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Norte',
        	'ur' => 'III',
        ]);

		Municipio::create([
        	'nombre_municipio' => 'General Alvear',
        	'nombre_departamento' => 'Obera',
        	'poblacion' => '1260',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'II',
        ]);

		Municipio::create([
        	'nombre_municipio' => 'Bompland',
        	'nombre_departamento' => 'Candelaria',
        	'poblacion' => '2355',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'VI',
        ]);

		Municipio::create([
        	'nombre_municipio' => 'Campo Viera',
        	'nombre_departamento' => 'Obera',
        	'poblacion' => '10078',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'II',
        ]);

		Municipio::create([
        	'nombre_municipio' => 'Apostoles',
        	'nombre_departamento' => 'Apostoles',
        	'poblacion' => '29595',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'VII',
        ]);

		Municipio::create([
        	'nombre_municipio' => 'Santo Pipo',
        	'nombre_departamento' => 'San Ignacio',
        	'poblacion' => '6109',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'IX',
        ]);

		Municipio::create([
        	'nombre_municipio' => 'Concepcion de la Sierra',
        	'nombre_departamento' => 'Concepcion',
        	'poblacion' => '7988',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'VII',
        ]);

		Municipio::create([
        	'nombre_municipio' => 'Guarani',
        	'nombre_departamento' => 'Obera',
        	'poblacion' => '4857',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'II',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Santa Ana',
        	'nombre_departamento' => 'Eldorado',
        	'poblacion' => '1950',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'VIII',
        ]);

		Municipio::create([
        	'nombre_municipio' => 'Cerro Azul',
        	'nombre_departamento' => 'Leandro N. Alem',
        	'poblacion' => '5854',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'VI',
        ]);

		Municipio::create([
        	'nombre_municipio' => 'Obera',
        	'nombre_departamento' => 'Obera',
        	'poblacion' => '66112',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'C',
        	'ur' => 'II',
        ]);

		Municipio::create([
        	'nombre_municipio' => 'General Urquiza',
        	'nombre_departamento' => 'San Ignacio',
        	'poblacion' => '1216',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'IX',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Colonia Aurora',
        	'nombre_departamento' => '25 de Mayo',
        	'poblacion' => '7744',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'XI',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Leandro N. Alem',
        	'nombre_departamento' => 'Leandro N. Alem',
        	'poblacion' => '28583',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'XI',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'San Pedro',
        	'nombre_departamento' => 'San Pedro',
        	'poblacion' => '31051',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'VIII',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Azara',
        	'nombre_departamento' => 'Apostoles',
        	'poblacion' => '4113',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'VII',
        ]);
		Municipio::create([
        	'nombre_municipio' => '9 de Julio',
        	'nombre_departamento' => 'Eldorado',
        	'poblacion' => '3839',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Norte',
        	'ur' => 'III',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Jardin America',
        	'nombre_departamento' => 'San Ignacio',
        	'poblacion' => '25726',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'IX',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Posadas',
        	'nombre_departamento' => 'Capital',
        	'poblacion' => '277564',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'I',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'El Soberbio',
        	'nombre_departamento' => 'Guarani',
        	'poblacion' => '22898',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'VIII',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Comandante Andresito',
        	'nombre_departamento' => 'General Manuel Belgrano',
        	'poblacion' => '19981',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Norte',
        	'ur' => 'V',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Caraguatay',
        	'nombre_departamento' => 'Montecarlo',
        	'poblacion' => '3378',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Norte',
        	'ur' => 'III',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Caraguatay',
        	'nombre_departamento' => 'Montecarlo',
        	'poblacion' => '3378',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Norte',
        	'ur' => 'III',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'San Antonio',
        	'nombre_departamento' => 'General Manuel Belgrano',
        	'poblacion' => '9153',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Norte',
        	'ur' => 'XII',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Gobernador Lopez',
        	'nombre_departamento' => 'Leandro N. Alem',
        	'poblacion' => '2283',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'VI',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Puerto Esperanza',
        	'nombre_departamento' => 'Iguazu',
        	'poblacion' => '17155',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Norte',
        	'ur' => 'V',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Mojon Grande',
        	'nombre_departamento' => 'San Javier',
        	'poblacion' => '2251',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'XI',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Los Helechos',
        	'nombre_departamento' => 'Obera',
        	'poblacion' => '3315',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'II',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Santa Maria',
        	'nombre_departamento' => 'Concepcion',
        	'poblacion' => '1589',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'VII',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Colonia Wanda',
        	'nombre_departamento' => 'Iguazu',
        	'poblacion' => '15529',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Norte',
        	'ur' => 'V',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Dos Arroyos',
        	'nombre_departamento' => 'Leandro N. Alem',
        	'poblacion' => '2894',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'VI',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Martires',
        	'nombre_departamento' => 'Candelaria',
        	'poblacion' => '1371',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'II',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Fachinal',
        	'nombre_departamento' => 'Capital',
        	'poblacion' => '433',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'VII',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Profundidad',
        	'nombre_departamento' => 'Candelaria',
        	'poblacion' => '629',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'X',
        ]);
		Municipio::create([
        	'nombre_municipio' => '25 de Mayo',
        	'nombre_departamento' => '25 de Mayo',
        	'poblacion' => '12912',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'XI',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Alba Posse',
        	'nombre_departamento' => '25 de Mayo',
        	'poblacion' => '7098',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'XI',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Puerto Libertad',
        	'nombre_departamento' => 'Iguazu',
        	'poblacion' => '6694',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Norte',
        	'ur' => 'V',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Almafuerte',
        	'nombre_departamento' => 'Leandro N. Alem',
        	'poblacion' => '1016',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'VI',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Colonia Polana',
        	'nombre_departamento' => 'San Ignacio',
        	'poblacion' => '935',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'IX',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Loreto',
        	'nombre_departamento' => 'Candelaria',
        	'poblacion' => '1113',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'XIII',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Puerto Piray',
        	'nombre_departamento' => 'Montecarlo',
        	'poblacion' => '9029',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Norte',
        	'ur' => 'III',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'El Alcazar',
        	'nombre_departamento' => 'Libertador General San Martin',
        	'poblacion' => '5297',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'IX',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'San Jose',
        	'nombre_departamento' => 'Apostoles',
        	'poblacion' => '7095',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'XII',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Colonia Victoria',
        	'nombre_departamento' => 'Eldorado',
        	'poblacion' => '2665',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Norte',
        	'ur' => 'III',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Garupa',
        	'nombre_departamento' => 'Capital',
        	'poblacion' => '46759',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Norte',
        	'ur' => 'X',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Eldorado',
        	'nombre_departamento' => 'Eldorado',
        	'poblacion' => '63931',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Norte',
        	'ur' => 'III',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Hipolito Irigoyen',
        	'nombre_departamento' => 'San Ignacio',
        	'poblacion' => '2296',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'IX',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'San Ignacio',
        	'nombre_departamento' => 'San Ignacio',
        	'poblacion' => '11210',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'XIII',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Tres Capones',
        	'nombre_departamento' => 'Apostoles',
        	'poblacion' => '1446',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'XII',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Campo Grande',
        	'nombre_departamento' => 'Cainguas',
        	'poblacion' => '12676',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'XIII',
        ]);

		Municipio::create([
        	'nombre_municipio' => 'Arroyo del Medio',
        	'nombre_departamento' => 'Leandro N. Alem',
        	'poblacion' => '2156',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'XI',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Panambi',
        	'nombre_departamento' => 'Obera',
        	'poblacion' => '5928',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'II',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Olegario V. Andrade',
        	'nombre_departamento' => 'Leandro N. Alem',
        	'poblacion' => '1467',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'VI',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Aristobulo del Valle',
        	'nombre_departamento' => 'Cainguas',
        	'poblacion' => '24298',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'XII',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Puerto Leoni',
        	'nombre_departamento' => 'Libertador General San Martin',
        	'poblacion' => '2677',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'IX',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Colonia Alberdi',
        	'nombre_departamento' => 'Obera',
        	'poblacion' => '3751',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'II',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'San Vicente',
        	'nombre_departamento' => 'Guarani',
        	'poblacion' => '44999',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'XIII',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Cerro Cora',
        	'nombre_departamento' => 'Candelaria',
        	'poblacion' => '1333',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'XIII',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Colonia Delicia',
        	'nombre_departamento' => 'Eldorado',
        	'poblacion' => '5836',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Norte',
        	'ur' => 'III',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Caa Yari',
        	'nombre_departamento' => 'Leandro N. Alem',
        	'poblacion' => '822',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'VI',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Candelaria',
        	'nombre_departamento' => 'Candelaria',
        	'poblacion' => '14180',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'X',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Puerto Iguazu',
        	'nombre_departamento' => 'Iguazu',
        	'poblacion' => '42849',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Norte',
        	'ur' => 'V',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Ruiz de Montoya',
        	'nombre_departamento' => 'Libertador General San Martin',
        	'poblacion' => '3635',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'IV',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Campo Ramon',
        	'nombre_departamento' => 'Obera',
        	'poblacion' => '10070',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'II',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Dos de Mayo',
        	'nombre_departamento' => 'Cainguas',
        	'poblacion' => '16429',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'VIII',
        ]);
        Municipio::create([
            'nombre_municipio' => 'Ameghino',
            'nombre_departamento' => 'San Javier',
            'poblacion' => '2227',
            'varones' => '0',
            'mujeres' => '0',
            'zona' => 'Sur',
            'ur' => 'II',
        ]);
        Municipio::create([
            'nombre_municipio' => 'San Javier',
            'nombre_departamento' => 'San Javier',
            'poblacion' => '13030',
            'varones' => '0',
            'mujeres' => '0',
            'zona' => 'Sur',
            'ur' => 'VI',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Bernardo de Irigoyen',
        	'nombre_departamento' => 'General Manuel Belgrano',
        	'poblacion' => '13768',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Norte',
        	'ur' => 'XII',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'San Martin',
        	'nombre_departamento' => 'Obera',
        	'poblacion' => '2130',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Sur',
        	'ur' => 'II',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Capiovi',
        	'nombre_departamento' => 'Libertador General San Martin',
        	'poblacion' => '6097',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'IV',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Garuhape',
        	'nombre_departamento' => 'Libertador General San Martin',
        	'poblacion' => '9355',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Centro',
        	'ur' => 'IV',
        ]);
		Municipio::create([
        	'nombre_municipio' => 'Pozo Azul',
        	'nombre_departamento' => 'San Pedro',
        	'poblacion' => '2227',
        	'varones' => '0',
        	'mujeres' => '0',
        	'zona' => 'Norte',
        	'ur' => 'VII',
        ]);
    }
}
