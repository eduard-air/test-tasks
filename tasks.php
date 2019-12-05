<?php 

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
set_time_limit(100);

// 1
function getFileExtension($filePath)
{
	$fileExtension = (new SplFileInfo($filePath))->getExtension();

	return $fileExtension;
}


// 2
function checkObject($obj)
{
	$classes = ['First', 'Second', 'Third'];
	$ans = in_array(get_class($obj), $classes);

	return $ans;
}


// 3
function findMiddle($filePath)
{
	$bytePosition = intval( (filesize($filePath)+1)/2 );
	$lineNumber = 1;
	$temp = 0;

	foreach(file($filePath) as $key => $str){
		$temp += strlen($str);
		if($temp >= $bytePosition){
			$lineNumber = $key+1;
			break;
		}
	}

	$res = [$bytePosition, $lineNumber];

	return $res;
}


// 4
function isAnagram($word1, $word2)
{
	return (sortChars($word1) == sortChars($word2));
}

function sortChars($word)
{
	$word = mb_strtolower($word);
	$stringParts = str_split($word);
	sort($stringParts);

	return implode('', $stringParts);
}


// 5
function clearBackground(){
	$img = request('img');
	$image = imagecreatefromjpeg($img);
	$out = imagecreatefromjpeg($img);
	list($width, $height) = getimagesize($img);


	$dark = 122;
	$i = 0;

	while($i < $height)
	{
		$a = 0;
		while($a < $width)
		{
			$color = imagecolorat($image, $a, $i);  
			$rgb = imagecolorsforindex ($image, $color);
			$origin = imagecolorallocate($out, $rgb['red'], $rgb['green'], $rgb['blue']);
			$rgb = round(($rgb['red'] + $rgb['green'] + $rgb['blue'])/3);
			$white = imagecolorallocate($out,255,255,255);
			imagesetpixel($out, $a, $i, (($rgb <= $dark) ? $origin : $white));
			$a++;  
		}  
		$i++;  
	}

	header('Content-type: image/jpeg');
			
	ImageJPEG($out);
	imagedestroy($out);

}



