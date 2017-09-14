<?php
error_reporting (E_ALL ^ E_NOTICE ^ E_WARNING);
include("Admin/db.php");
require_once('phasher.class.php');
$I = PHasher::Instance();

function edgeimg($im) {

$imgw = imagesx($im);
$imgh = imagesy($im);

for ($i=0; $i<$imgw; $i++)
{
        for ($j=0; $j<$imgh; $j++)
        {
                $rgb = ImageColorAt($im, $i, $j);
                $rr = ($rgb >> 16) & 0xFF;
                $gg = ($rgb >> 8) & 0xFF;
                $bb = $rgb & 0xFF;
                $g = round(($rr + $gg + $bb) / 3);
				if($g>=198)
				{
				$g=255;
				}
				else{
				$g=0;
				}

                $val = imagecolorallocate($im, $g, $g, $g);
                imagesetpixel ($im, $i, $j, $val);
        }
}
return $im;
}


	if(isset($_FILES['Ofile']['tmp_name']) and $_FILES['Ofile']['name']!="")
	{
$location=$_POST["location"];
$hh=time().$_FILES['Ofile']['name'];
move_uploaded_file($_FILES['Ofile']['tmp_name'],"userupload/".$hh); 
$str1 = $I->HashAsString($I->HashImage("userupload/".$hh));
echo "File upload";
$a=$hh;

$image="userupload/".$hh;
if(strpos($a, '.jpg') !== false or strpos($a, '.JPG') !== false)
$im = imagecreatefromjpeg($image);
if(strpos($a, '.jpg') !== false or strpos($a, '.JPEG') !== false)
$im = imagecreatefromjpeg($image);
if(strpos($a, '.png') !== false or strpos($a, '.PNG') !== false)
$im = imagecreatefrompng($image);
if(strpos($a, '.gif') !== false or strpos($a, '.GIF') !== false)
$im = imagecreatefromgif($image);
$im=edgeimg($im);
$hh1=time()."edge".$_FILES['Ofile']['name'];
imagejpeg($im,"userupload/".$hh1);
imagedestroy($im);
$str2 = $I->HashAsString($I->HashImage("userupload/".$hh1));


$locations = explode(",", $location);
$lat=$locations[0]; // piece1
$log=$locations[1]; // piece2

$comp=0;
$comp1=40;
$ecomp1=40;
$lat1=0.0;
$log1=0.0;

$select_table = "select * from places,placesimg where places.PID=placesimg.pid";
$fetch= mysql_query($select_table);
while($row = mysql_fetch_array($fetch))
{
$comp = $I->CompareStrings($str1, $row['pichashval']);
$ecomp = $I->CompareStrings($str2, $row['grayhashval']);
if($comp>=$comp1 and $ecomp>=$ecomp1)
	{
$comp1=$comp;
$ecomp1=$ecomp;
$lat1=$row['Latitude'];
$log1=$row['Longitude'];
	}
}

unlink("userupload/".$hh);
unlink("userupload/".$hh1);
if($lat1>=1.0 and $log1>=1.0)
		{
echo "<script> location.href=\"http://192.168.43.2/ImageMap/MyTracklocation.php?LAT=$lat&LOG=$log&LAT1=$lat1&LOG1=$log1\";</script>";
		}else

unlink("userupload/".$hh);
unlink("userupload/".$hh1);
		{
echo "<br>No Record Found Of This Place.!";
		}

	}
	else
	{
		echo "File Not Found";
	}

?>