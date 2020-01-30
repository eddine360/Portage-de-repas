<?php
class Security {

private static $seed1 = 'xLia8MD3g3SjHFZ2MfRS';							//creation de la seed pour securiser(éviter attaque par dictionnaire)
private static $seed2 = 'Gjkl34KJugtVGfy6gsZb';

static public function getSeed1() {
   return self::$seed1;
}

static public function getSeed2() {
   return self::$seed2;
}

static public function chiffrer($texte_en_clair) {									//cryptage du mdp
  $concat = Security::getSeed1() . $texte_en_clair . Security::getSeed2();
  $texte_chiffre = hash('sha256', $concat);
  return $texte_chiffre;
}

function generateRandomHex() {
  // Generate a 32 digits hexadecimal number
  $numbytes = 16; // Because 32 digits hexadecimal = 16 bytes
  $bytes = openssl_random_pseudo_bytes($numbytes);
  $hex   = bin2hex($bytes);
  return $hex;
}

}
