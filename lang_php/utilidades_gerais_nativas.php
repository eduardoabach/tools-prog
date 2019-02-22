<?php

trigger_error("Unable to load class: $class", E_USER_WARNING);

// ----------------------------------------------------------

$list = array(
  'nome' => 'Ana',
  'idade' => 28
);
echo (array_key_exists('nome', $list)) ? $list['nome'] : '';

// ----------------------------------------------------------

$b64Test = base64_encode('string');
echo base64_decode($b64Test); // echo 'string'

// ----------------------------------------------------------

// Nome de variável dinâmico
for($i=0; $i<10;$i++){
  ${'ex'.$i} = 'Exemplo '.$i;
}
echo $ex0; // out: Exemplo 0
echo $ex8; // out: Exemplo 8

// ----------------------------------------------------------

var_dump(property_exists('myClass', 'exemplo')); //true
var_dump(property_exists(new myClass, 'exemplo')); //true
var_dump(property_exists('myClass', 'exemplo_private')); //false, estamos fora do contexto da class

// usando o nome
var_dump(method_exists('Directory','read'));

// ou com o próprio objeto
$directory = new Directory('.');
var_dump(method_exists($directory,'read'));

if(function_exists('imap_open'))
	die('existe');

// ----------------------------------------------------------

print_r(get_declared_classes());
/* Array(
    [0] => stdClass
    [1] => __PHP_Incomplete_Class
    [2] => Directory
) */

// mostrar funções
$arr = get_defined_functions();
print_r($arr);
/*Array(
    [internal] => Array        (
            [0] => zend_version
            [1] => func_num_args
            [2] => func_get_arg
            [5] => strcmp
            ...
        )
    [user] => Array(
            [0] => myrow
    )
)*/

// mostrar variaveis existentes
$b = array(1,1,2,3,5,8);
$arr = get_defined_vars();
print_r($arr["b"]);
print_r($arr["_SERVER"]);

// mostra todos os indíces possíveis para a matriz de variáveis
print_r(array_keys(get_defined_vars()));

// ----------------------------------------------------------

print_r(get_loaded_extensions());
/* Array(
   [0] => xml
   [1] => wddx
   [2] => standard
   [3] => session
   [4] => posix
   [5] => pgsql
   [6] => pcre
   [7] => gd
   [8] => ftp
   [9] => db
   [10] => calendar
   [11] => bcmath
)*/

// TIPAGEM / CASTING
//Retorna 'integer'
$var = 2;
print gettype($var);
//Retorna 'string'
$var = "6";
print gettype($var);

$foo = "5bar"; // string
$bar = true;   // boolean
settype($foo, "integer"); // $foo é agora 5   (integer)
settype($bar, "string");  // $bar é agora "1" (string)

$var = "true";
settype($var, 'bool');
var_dump($var); // true

$var = "false";
settype($var, 'bool');
var_dump($var); // true mesmo assim!!

$var = "";
settype($var, 'bool');
var_dump($var); // false


// ----------------------------------------------------------


//Uso do DateTime = http://php.net/manual/pt_BR/datetime.createfromformat.php
echo DateTime::createFromFormat('h:i:sA','4:15:03PM')->format('H:i:s'); // 16:15:03
echo DateTime::createFromFormat('H\h i\m s\s','23h 15m 03s')->format('H:i:s'); // 23:15:03
echo DateTime::createFromFormat('Y-m-d H:i:s', '2009-02-15 15:16:17')->format('d/m/Y h:i:s A'); // 15/02/2009 03:16:17 PM
echo DateTime::createFromFormat('Y-m-d H:i:s', '2009-02-15 15:16:17')->add('P7Y5M4DT4H3M2S')->format('d/m/Y h:i:s A'); // 15/02/2009 03:16:17 PM
echo DateTime::createFromFormat('Y-m-d H:i:s', '2009-02-15 15:16:17')->add(new DateInterval('PT10H30S'))->format('d/m/Y h:i:s A'); // 16/02/2009 01:16:47 AM

$date = new DateTime('2000-01-01');
$date->add(new DateInterval('PT10H30S'));
echo $date->format('Y-m-d H:i:s') . "\n";

// ----------------------------------------------------------


echo strtoupper('Teste de 3 tenTATIvas.'); // TESTE DE 3 TENTATIVAS.
echo strtoupper('teste de 3 tentativas.'); // TESTE DE 3 TENTATIVAS.
echo strtoupper('TESTE DE 3 TENTATIVAS.'); // TESTE DE 3 TENTATIVAS.

echo strtolower('Teste de 3 tenTATIvas.'); // teste de 3 tentativas.
echo strtolower('teste de 3 tentativas.'); // teste de 3 tentativas.
echo strtolower('TESTE DE 3 TENTATIVAS.'); // teste de 3 tentativas.

echo ucfirst('Teste de 3 tenTATIvas.'); // Teste de 3 tenTATIvas.
echo ucfirst('teste de 3 tentativas.'); // Teste de 3 tentativas.
echo ucfirst('TESTE DE 3 TENTATIVAS.'); // TESTE DE 3 TENTATIVAS.

echo ucwords('Teste de 3 tenTATIvas.'); // Teste De 3 TenTATIvas.
echo ucwords('teste de 3 tentativas.'); // Teste De 3 Tentativas.
echo ucwords('TESTE DE 3 TENTATIVAS.'); // TESTE DE 3 TENTATIVAS.

$teste = 'Ana';
echo str_pad($teste, 10); // "Ana       "
echo str_pad($teste, 10, "=-", STR_PAD_LEFT); // "=-=-=-=Ana"
echo str_pad($teste, 10, "_", STR_PAD_BOTH); // "___Ana____"

echo substr('Ana Maria da Silva', 0, 10); //corta texto, "Ana Maria "
echo substr('Sábado', 0, 3); //corta texto, "Sá"
echo mb_substr('Sábado', 0, 3); //corta texto, "Sáb"

echo str_replace('teste', 'novo', 'Algum texto de exemplo: teste.') // Algum texto de exemplo: novo.

// Exibir caracteres unicode
echo json_decode('"\u001B"');

// ----------------------------------------------------------

// ## NÚMEROS #########################################################################

$num = 25;

$raizQuadrada = sqrt($num); // 5

$potencia = 2;
$potencia = pow($num,$potencia); // 625

$graus = 45; // inclinação...
$radianos = deg2rad($graus); // 0.785398163397
$grausNovamente = rad2deg($radianos);
$seno = sin($radianos);
$cosseno = cos($radianos);
$tangente = tan($radianos);

echo pi(); // 3.1415926535898
echo M_PI; // 3.1415926535898
echo M_SQRTPI; // raiz de pi, 1.77245385090551602729

$hipotenusa = hypot(3,4); // 5, = sqrt(3*3+4*4);

$numDecimal = 256;
$numBinario = base_convert($numDecimal, 10, 2);
$numHexa = base_convert($numDecimal, 10, 16);

echo log(8, 2); // logaritmo, o result é 3, 2*2*2 = 8
echo log(25, 5); // result é 2, 5*5 = 25


// COMPARANDO DECIMAIS NO PHP
// Isso ocorre porque, internamente, o PHP não arredonda automaticamente as casas decimais em suas operações matemáticas
// e se isso for somado ao fato dos processadores dos computadores apresentarem pontos flutuantes em algumas operações
// certamente essa flutuação (ou variação, se preferir) aparecerá em algum momento se não for corrigida.

// Conta #1 - Comparando 0.25 e 0.25: valores iguais
$varA = 0.25;
$varB = 1 - 0.75; // 0.25
$resultadoConta2 = ($varA == $varB) ? 'valores iguais' : 'valores diferentes';
echo 'Conta #1 - Comparando '.$varA.' e '.$varB.': '.$resultadoConta2.'<br>';

// Conta #2 - Comparando 0.23 e 0.23: valores diferentes
$varA = 0.23;
$varB = 1 - 0.77; // 0.23
$resultadoConta2 = ($varA == $varB) ? 'valores iguais' : 'valores diferentes';
echo 'Conta #2 - Comparando '.$varA.' e '.$varB.': '.$resultadoConta2.'<br>';

// Conta #3 - Comparando 0.23 e 0.23: valores iguais
$varA = round(0.23, 2);
$varB = round(1 - 0.77, 2); // 0.23
$resultadoConta2 = ($varA == $varB) ? 'valores iguais' : 'valores diferentes';
echo 'Conta #3 - Comparando '.$varA.' e '.$varB.': '.$resultadoConta2.'<br>';

// ----------------------------------------------------------

// ## JSON #########################################################################


echo json_encode("teste");

$string = "minha string";
$fp = fopen('arquivo.json', 'w');
fwrite($fp, json_encode($string));
fclose($fp);   

$noticias = array(
array(
    "titulo" => "noticia 1",
    "corpo" => "corpo da noticia 1",
    "data" => "02/07/2014"
    ),

array(
    "titulo" => "noticia 2",
    "corpo" => "corpo da noticia 2",
    "data" => "02/07/2014"
),

array(
    "titulo" => "noticia 3",
    "corpo" => "corpo da noticia 3",
    "data" => "02/07/2014"
),

array(
    "titulo" => "noticia 4",
    "corpo" => "corpo da noticia 4",
    "data" => "02/07/2014"
)
);

echo json_encode($noticias);
 
// Atribui o conteúdo do arquivo para variável $arquivo
$arquivo = file_get_contents('cadastro.json');
 
// Decodifica o formato JSON e retorna um Objeto
$json = json_decode($arquivo);
 
// Loop para percorrer o Objeto
foreach($json as $registro):
    echo 'Código: ' . $registro->codigo . ' - Nome: ' . $registro->nome . ' - Telefone: ' . $registro->telefone . '<br>';
endforeach;

// ----------------------------------------------------------


$cpf = preg_replace("/[^0-9]/", '', '165.083.943-04'); //out: 16508394304

// ----------------------------------------------------------

convBase('123', '0123456789', '01234567');
//Convert '123' from decimal (base10) to octal (base8).
//result: 173

convBase('70B1D707EAC2EDF4C6389F440C7294B51FFF57BB', '0123456789ABCDEF', '01');
//Convert '70B1D707EAC2EDF4C6389F440C7294B51FFF57BB' from hexadecimal (base16) to binary (base2).
//result:
//111000010110001110101110000011111101010110000101110
//110111110100110001100011100010011111010001000000110
//001110010100101001011010100011111111111110101011110
//111011

convBase('1324523453243154324542341524315432113200203012', '012345', '0123456789ABCDEF');
//Convert '1324523453243154324542341524315432113200203012' from senary (base6) to hexadecimal (base16).
//result: 1F9881BAD10454A8C23A838EF00F50

convBase('355927353784509896715106760','0123456789','Christopher');
//Convert '355927353784509896715106760' from decimal (base10) to undecimal (base11) using "Christopher" as the numbers.
//result: iihtspiphoeCrCeshhorsrrtrh

convBase('1C238Ab97132aAC84B72','0123456789aAbBcCdD', '~!@#$%^&*()');
//Convert'1C238Ab97132aAC84B72' from octodecimal (base18) using '0123456789aAbBcCdD' as the numbers to undecimal (base11) using '~!@#$%^&*()' as the numbers.
//result: !%~!!*&!~^!!&(&!~^@#@@@&

// ----------------------------------------------------------

// VER TODOS OS ERROS
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

// ----------------------------------------------------------

// Constantes pré-definidas
PHP_VERSION //(string) 
PHP_MAJOR_VERSION //(integer) 
PHP_OS //O sistema operacional para o qual o PHP foi compilado. 
PHP_OS_FAMILY //'Windows', 'BSD', 'Darwin', 'Solaris', 'Linux' ou 'Unknown'. Disponível a partir do PHP 7.2.0. 
PHP_INT_SIZE // O tamanho de um inteiro em bytes, então 32 / 64...
DEFAULT_INCLUDE_PATH  (string) 
PHP_EXTENSION_DIR  (string) 
PHP_BINDIR (string) 
PHP_DATADIR (string) 
PHP_LOCALSTATEDIR (string) 
PHP_CONFIG_FILE_PATH (string) 



