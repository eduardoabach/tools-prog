<?
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

// ###########################################################################

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


?>