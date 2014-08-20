<?php	
  //@link http://blog.codinghorror.com/why-cant-programmers-program/
  //@link http://en.wikipedia.org/wiki/Fizz_buzz
  
  for ($i = 1; $i<=100; $i++) {
    $output = '';
    if (0 == $i % 3) {
        $output.= 'Fizz';
    }
    if (0 == $i % 5) {
        $output.= 'Buzz';
    }
    echo $output ? $output : $i, "\n";
  }
?>
