<?

//valor vinha de post e poderia não ser confiável, portanto passava por um (int) para reforçar o que queria.
//era um id de registro de banco de dados.
$numTest = '5573165743';

//Server 64-bit
//Integers: -9,223,372,036,854,775,808 ~ 9,223,372,036,854,775,807 (~±9 quintilhões, 19 dígitos)
$numTest64b = (int) $numTest; //OK, 5573165743

//Server 32-bit
//Integers: -2,147,483,648 ~ 2,147,483,647 (~±2 bilhões, 10 dígitos)
$numTest32b = (int) $numTest; //

//SOLUCTION para as duas possibilidades
$numTest32b = (float) $numTest; //OK, 5573165743

?>