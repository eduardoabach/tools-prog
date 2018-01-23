<?php

trigger_error("Unable to load class: $class", E_USER_WARNING);

$b64Test = base64_encode('string');
echo base64_decode($b64Test); // echo 'string'


// Nome de variável dinâmico
for($i=0; $i<10;$i++){
  ${'ex'.$i} = 'Exemplo '.$i;
}
echo $ex0; // out: Exemplo 0
echo $ex8; // out: Exemplo 8

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


// VER TODOS OS ERROS
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);


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



