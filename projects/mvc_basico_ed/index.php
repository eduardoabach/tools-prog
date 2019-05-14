<?php

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$p1 = new Pessoa('Maria', '28');
$p2 = new Pessoa('Carlos');

echo $p1->getInfo().'<br>';
echo $p2->getInfo().'<br>';

$p3 = new Colaborador('James', '20', 2400);
echo $p3->getInfo().'<br>';

$p4 = new Colaborador('Jack', null, 5000);
echo $p4->getInfo().'<br>';
