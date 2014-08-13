<?php
/**
 * This is a PHP Implementation of the ALGO60 algorithim for calculating
 * the transcendental number e with only integer arithmetic as prestented
 * by A.H.J.Sale in the article "The Calculation of e to Many Significant Digits"
 * published in The Computer Journal (1968) 11 (2): 229-230. doi: 10.1093/comjnl/11.2.229
 * @see http://comjnl.oxfordjournals.org/content/11/2/229.abstract
 *
 * Code comment:
 *
 *   This function for calculating the transcendental number e
 *   to n correct decimal places uses only integer arithmetic,
 *   except for estimating the required series length.
 *
 *   The digits of the result are placed in the array d, the array element d[0]
 *   containing entier(e), and the subsequent elements the following digits.
 *
 *   These digits are individually calculated and may be printed one-by- one
 *   within the for statement labelled "sweep".
 *
 * @param $n number of decimal places to compute
 * @param array $d to store the decimals of e
 */
function ecalculation($n, array &$d) {
	# Estimate the required series length
	$m = 4;
	$test = ($n + 1.0) * 2.30258509;
	while ($m * (log($m)-1.0) + 0.5 * log(6.2831852 * $m) < $test) {
		$m++;
	}

	# Initialize coefficients
	$coef = [];
	for ($j = 2; $j<=$m; $j++) {
		$coef[$j] = 1;
	}
	$d[0] = 2;

	# Calculate n digits
	sweep:
	for ($i=1; $i<=$n; $i++) {
		$carry = 0;
		# Generate digits
		for ($j = $m; $j>=2 ;$j--) {
			$temp = (int)($coef[$j] * 10 + $carry);
			$carry = (int)($temp / $j);
			$coef[$j] = (int)($temp - $carry * $j);
		}
		$d[$i] = $carry;
	}
}

/**
 * The the ecalculation function for a quick testrun.
 */
function test() {
	$n = 100;
	$d = [];
	ecalculation($n, $d);
	$e = '2.'.substr(implode('',$d),1);
	assert($e == "2.7182818284590452353602874713526624977572470936999595749669676277240766303535475945713821785251664274");
	echo "THe first $n digits of e are: $e";
}

test();
?>
