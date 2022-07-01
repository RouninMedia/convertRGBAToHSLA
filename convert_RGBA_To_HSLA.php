<?php

function convert_RGBA_To_HSLA ($r, $g, $b, $a) {

  $h = 0;
  $s = 0;
  $l = 0;
  
  $r = ($r / 255);
  $g = ($g / 255);
  $b = ($b / 255);
  
  $cmin = min($r, $g, $b);
  $cmax = max($r, $g, $b);
  $delta = ($cmax - $cmin);
  
  // CALCULATE HUE
  switch (TRUE) {
  
    case ($delta === 0): $h = 0; break;
    case ($cmax === $r): $h = fmod((($g - $b) / $delta), 6); break;
    case ($cmax === $g): $h = ($b - $r) / ($delta + 2); break;
    case ($cmax === $b): $h = ($r - $g) / ($delta + 4); break;
  }
     
  $h = round($h * 60);
  $h = ($h < 0) ? $h += 360 : $h;
  
  // START LIGHTNESS CALCULATION
  $l = ($cmax + $cmin) / 2;
  
  // START SATURATION CALCULATION
  $s = ($delta === 0) ? 0 : $delta / (1 - abs(2 * $l - 1));
  
  // COMPLETE SATURATION AND LIGHTNESS CALCULATION
  $s = round(($s * 100), 2);
  $l = round(($l * 100), 2);
  
  return 'hsla('.$h.', '.$s.'%, '.$l.'%, '.$a.')';
}

echo convert_RGBA_To_HSLA(147, 133, 26, 0.66);

?>
