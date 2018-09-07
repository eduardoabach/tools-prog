<?php
   function is_valid_cpf($cpf){
      $cpf       = str_pad(str_replace(array('.', '-', '/'), '', $cpf), 11, '0', STR_PAD_LEFT);
      $invalidos = array(
         '00000000000', '11111111111', '22222222222', '33333333333', '44444444444',
         '55555555555', '66666666666', '77777777777', '88888888888', '99999999999');

      if (strlen($cpf) != 11 || in_array($cpf, $invalidos)) {
         return false;
      } else {
         for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
               $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
               return false;
            }
         }

         return true;
      }
   }

   function is_valid_cnpj($cnpj){
      $cnpj = str_pad(str_replace(array('.', '-', '/'), '', $cnpj), 14, '0', STR_PAD_LEFT);

      $invalidos = array(
         '00000000000000', '11111111111111', '22222222222222',
         '33333333333333', '44444444444444', '55555555555555',
         '66666666666666', '77777777777777', '88888888888888',
         '99999999999999'
      );

      if (strlen($cnpj) != 14 || in_array($cnpj, $invalidos)) {
         return false;
      } else {
         for ($t = 12; $t < 14; $t++) {
            for ($d = 0, $p = $t - 7, $c = 0; $c < $t; $c++) {
               $d += $cnpj{$c} * $p;
               $p = ($p < 3) ? 9 : --$p;
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cnpj{$c} != $d) {
               return false;
            }
         }

         return true;
      }
   }

   function is_valid_email($email){
      return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]+$/ix", $email)) ? false : true;
   }

   function is_valid_cep($cep){
      return preg_match('/^[0-9]{5}\-[0-9]{3}$/', $cep);
   }

   function format_cpf_or_cnpj($cpf_cnpj){
      $val = str_replace(array('.', '-', '/'), '', trim($cpf_cnpj));
      $len = strlen($val);

      if ($len > 2 && $len < 12) {
         $res = format_CPF($val);
      } else {
         $res = format_CNPJ($val);
      }

      return $res;
   }

   function format_CPF($cpf){
      $cpf = str_replace(array(',', '.', '-', '/'), '', trim($cpf));
      $len = strlen($cpf);

      if ($len > 2 && $len < 12) {
         $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
         $p1  = substr($cpf, 0, 3);
         $p2  = substr($cpf, 3, 3);
         $p3  = substr($cpf, 6, 3);
         $p4  = substr($cpf, 9, 2);

         return $p1 . "." . $p2 . "." . $p3 . "-" . $p4;
      } else if ($len < 3) {
         return '';
      } else {
         return $cpf;
      }
   }

   function format_CNPJ($cnpj){
      $cnpj = trim($cnpj);
      $len  = strlen($cnpj);

      if ($len > 6 && $len < 15) {
         $cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);
         $p1   = substr($cnpj, 0, 2);
         $p2   = substr($cnpj, 2, 3);
         $p3   = substr($cnpj, 5, 3);
         $p4   = substr($cnpj, 8, 4);
         $p5   = substr($cnpj, 12, 2);

         return $p1 . "." . $p2 . "." . $p3 . "/" . $p4 . "-" . $p5;
      } else {
         return $cnpj;
      }
   }

   function format_cep($cep, $default = '00000-000'){
      if (!strlen($cep)) {
         return $default;
      }

      return substr_replace(str_pad(get_only_numbers($cep), 8, '', STR_PAD_RIGHT), '-', 5, 0);
   }

?>