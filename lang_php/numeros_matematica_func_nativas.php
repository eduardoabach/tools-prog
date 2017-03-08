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

?>