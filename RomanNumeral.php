<?php
/**
 * Static helper class for validation and conversion of
 * of roman numerals (strings) to decimals (ints) and vice versa.
 */

class RomanNumeral {

	public static $symtab = [
		'M'	=> 1000,
		'C'	=> 100,
		'D'	=> 500,
		'L'	=> 50,
		'X'	=> 10,
		'V'	=> 5,
		'I'	=> 1,
	];

	/**
	 * @param $n decimal to convert
	 * @return string roman numeral
	 */
	public static function getRoman($n) {
		$ret = '';
		foreach (self::$symtab as $symbol => $value) {
			while ($value <= $n) {
				if (4 == $n) {
					$value = $n; $symbol = 'IV';
				}
				if (9 == $n) {
					$value = $n; $symbol = 'IX';
				}
				if (50 > $n && $n >= 40) {
					$value = 40; $symbol = 'XL';
				}
				if (100 > $n && $n >= 90) {
					$value = 90; $symbol = 'XC';
				}
				if (500 > $n && $n >= 400) {
					$value = 400; $symbol = 'CD';
				}
				if (1000 > $n && $n >= 900) {
					$value = 900; $symbol = 'CM';
				}
				$n -= $value;
				$ret .= $symbol;
			}
		}
		return $ret;
	}

	/**
	 * Converts a roman numeral string to decimal
	 * @param $n roman numeral to convert
	 * @return int decimal
	 * @throws InvalidArgumentException
	 */
	public static function getDecimal($n) {
		if (!preg_match('/^(M|C|D|L||X|V|I)+$/', $n)) {
			throw new InvalidArgumentException("Not a roman numeral.");
		}
		$ret = 0;
		for($i = 0; strlen($n) > $i; $i++) {
			$value = self::$symtab[substr($n, $i, 1)];
			if ($i<strlen($n)) {
				switch (substr($n, $i, 2)) {
					case 'IV': $value =   4; $i++; break;
					case 'IX'; $value =   9; $i++; break;
					case 'XL'; $value =  40; $i++; break;
					case 'XC'; $value =  90; $i++; break;
					case 'CD'; $value = 400; $i++; break;
					case 'CM'; $value = 900; $i++; break;
					default:
				}
			}
			$ret += $value;
		}
		if ($n != self::getRoman($ret)) {
			throw new InvalidArgumentException("Not a valid roman numeral.");
		}
		return $ret;
	}

	/**
	 * Checks if a given string is a valid roman numeral
	 * @param $n roman numeral
	 * @return bool
	 */
	function isValid($n) {
		if (!preg_match('/^(M|C|D|L||X|V|I)+$/', $n)) {
			return false;
		}
		return $n === self::getRoman(self::getDecimal($n));
	}
}
