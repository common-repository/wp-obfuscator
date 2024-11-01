<?php 

/*

Author: Adrien Thierry

Licence: GPLv2 or later

http://seraum.com

http://asylum.seraum.com

http://hackmyfortress.com

More info ? Need a better php obfuscator ? Contact us : http://seraum.com

*/

class Free_Obfusc{


	function doIt($code)
	{
		$round = 2;
		for($i = 0; $i < $round; $i++)
		{
			$code = $this->hideCode($code);
		}
		return $code;
	}

	function hideCode($code)
	{
	$code = "?>" . $code;
	$obf = unpack("H*", bin2hex(gzdeflate($code)))[1];
	$create = base64_encode("create_function");
	$pac = base64_encode("pack");
	$preg = base64_encode("preg_replace_callback");
	$h = base64_encode("H*");
	$hex = base64_encode("hex2bin");
	$gzi = base64_encode("gzinflate");
	$s = base64_encode("|.|");
	$point = base64_encode(".");
	$base64d = base64_encode("base64_decode");
	$evald = base64_encode("eval");
	$base64dname = $this->ivrandom(rand(4, 10));
	$base64dname2 = $this->ivrandom(rand(4, 10));
	$base64dname3 = $this->ivrandom(rand(4, 10));
	$base64dname4 = $this->ivrandom(rand(4, 10));
	$base64dname5 = $this->ivrandom(rand(4, 10));
	$base64dname6 = $this->ivrandom(rand(4, 10));
	$base64dname7 = $this->ivrandom(rand(4, 10));
	$base64dname8 = $this->ivrandom(rand(4, 10));
	$createname = $this->ivrandom(rand(4, 10));
	$pacname = $this->ivrandom(rand(4, 10));
	$pregname = $this->ivrandom(rand(4, 10));
	$hname = $this->ivrandom(rand(4, 10));
	$hexname = $this->ivrandom(rand(4, 10));
	$sname = $this->ivrandom(rand(4, 10));
	$gziname = $this->ivrandom(rand(4, 10));
	$pointname = $this->ivrandom(rand(4, 10));
	$evalname = $this->ivrandom(rand(4, 10));
	$randname = $this->ivrandom(rand(4, 10));
	$rot = $this->ivrandom(rand(4, 10));
	$arg1 = $this->ivrandom(rand(4, 10));

	$strot = '$' . $this->ivrandom(rand(4, 10));
	$n = '$' . $this->ivrandom(rand(4, 10));
	$nbrot = '$' . $this->ivrandom(rand(4, 10));
	$strrot = str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_/ ,.:!');
	$randrot = rand(1, 100);
	$randclear = $randrot;
	$randrot = $this->decompose_int($randrot);

	$frot = ' function ' .$rot . '(' . $strot . ', ' . $n . ', ' . $nbrot . ') {' . $nbrot . ' = ' . $nbrot . ' . ' . $nbrot . ';' . $this->create_aleat() . $n . ' = (int)' . $n . ' % (strlen(' . $nbrot . ') / 2);' . $this->create_aleat() . 'for ($i = 0, $l = strlen(' . $strot . '); $i < $l; $i++) {if(strpos(' . $nbrot . ', ' . $strot . '[$i]) !== false){' . $this->create_aleat() . $strot . '[$i] = ' . $nbrot . '[(strpos(' . $nbrot . ', ' . $strot . '[$i]) + (strlen(' . $nbrot . ') / 2)) - ' . $n . '];}}return ' . $strot . ';}';

	$b64 = "base64_decode";

	$evalf = ' eval($' . $arg1 . ');';

	$evalo = unpack("H*", bin2hex($evalf));
	$evalb64 = $this->rot($b64, $randclear, $strrot);
	$result = '<?php ' . $this->create_aleat()  . '$' . $randname . ' = ' . $randrot . ';'  . $this->create_aleat()  . '$' . $base64dname . ' = ' . $rot . "('" . $evalb64 . '\', $' . $randname . ', \'' . $strrot . '\');' . $this->create_aleat() . '$' . $createname . ' = $' . $base64dname . '("' . $create . '");' . $this->create_aleat()  . '$' . $base64dname2 . ' = $' . $base64dname . ';' . $this->create_aleat()  . '$' . $pacname . ' = $' . $base64dname2 . '("' . $pac . '");' . $this->create_aleat()  . '$' . $base64dname3 . ' = $' . $base64dname2 . ';' . $this->create_aleat()  . '$' . $pregname . ' = $' . $base64dname . '("' . $preg . '");' . $this->create_aleat()  . '$' . $base64dname4 . ' = $' . $base64dname3 . ';' . $this->create_aleat()  . '$' . $hname . ' = $' . $base64dname . '("' . $h . '");' . $this->create_aleat()  . '$' . $base64dname5 . ' = $' . $base64dname4 . ';' . $this->create_aleat()  . '$' . $hexname . ' = $' . $base64dname . '("' . $hex . '");' . $this->create_aleat()  . '$' . $base64dname6 . ' = $' . $base64dname5 . ';' . $this->create_aleat()  . '$' . $sname . ' = $' . $base64dname . '("' . $s . '");' . $this->create_aleat()  . '$' . $base64dname7 . ' = $' . $base64dname6 . ';' . $this->create_aleat()  . '$' . $pointname . ' = $' . $base64dname7 . '("' . $point . '");' . '$' . $base64dname8 . ' = $' . $base64dname7 . ';' . $this->create_aleat()  . '$' . $gziname . ' = $' . $base64dname8 . '("' . $gzi . '");' . '$' . $evalname . ' = $' . $createname . '(\'$' . $arg1 . '\', $' . $hexname . '($' . $pacname . '($' . $hname . ', "' . $evalo[1] . '")));' . $this->create_aleat()  . '$' . $pregname . '($' . $sname . ',$' . $createname . '("", $' . $evalname . '($' . $gziname . '($' . $hexname . '($' . $pacname . '($' . $hname . ', "' . $obf . '"))))),$' . $pointname . ');' . $this->create_aleat()  . '' . $frot . '' . $this->create_aleat()  . '?>';

	return $result;
	}

	function decompose_int($int)
	{
		$res = "";
		$tmpi = 0;
		while($int > 0)
		{
			$tmpi = rand(0, $int);
			$int = $int - $tmpi;
			$res .= "$tmpi+";
		}
		$res = substr($res, 0, -1);
		return $res;
	}
	function ivrandom($car) 
	{
		$string = "";
		$chaine = "abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		srand((double)microtime()*1000000);
		for($i=0; $i<$car; $i++) 
		{
			$string .= $chaine[rand()%strlen($chaine)];
		}
		return $string;
	}

	function rot($s, $n, $nbrot) 
	{
		$nbrot = $nbrot . $nbrot;
		$n = (int)$n % (strlen($nbrot) / 2);
		for ($i = 0, $l = strlen($s); $i < $l; $i++) 
		{
			if(strpos($nbrot, $s[$i]) !== false)
			{
				$s[$i] = $nbrot[strpos($nbrot, $s[$i]) + $n];
			}
		}
		return $s;
	}

	function unrot($s, $n = 13, $nbrot = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_/ ,.:!') 
	{
		$nbrot = $nbrot . $nbrot;
		$n = (int)$n % (strlen($nbrot) / 2);
		for ($i = 0, $l = strlen($s); $i < $l; $i++) 
		{
			if(strpos($nbrot, $s[$i]) !== false)
			{
				$s[$i] = $nbrot[(strpos($nbrot, $s[$i]) + (strlen($nbrot) / 2)) - $n];
			}
		}
		return $s;
	}
	function create_aleat()
	{
			$res = "";
			$a = rand(1, 2);
			if($a == 1)
			{
				$var = "";
				$value = "";
				$n = rand(1, 10);
				for($i = 0; $i < $n; $i++)
				{
					$var = $this->ivrandom(rand(2, 10));
					$value = $this->ivrandom(rand(1, 100));
					$tmp = '$' . $var . '="' . $value . '";';
					$res .= $tmp;
				}
			}
			else if($a == 2)
			{
				$value = "";
				$n = rand(1, 4);
				for($i = 0; $i < $n; $i++)
				{
					$value = "//" . $this->ivrandom(rand(1, 1000)) . "\r\n";
					$res .= $value;
				}
			}
			
			return $res;
	}

}

?>
