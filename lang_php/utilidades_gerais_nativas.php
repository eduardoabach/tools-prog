<?php

trigger_error("Unable to load class: $class", E_USER_WARNING);

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

