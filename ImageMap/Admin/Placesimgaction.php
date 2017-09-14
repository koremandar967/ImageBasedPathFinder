<?php
session_start();
include('db.php');
require_once('../phasher.class.php');
$I = PHasher::Instance();
?>
<div id="flash" class="flash"></div>

<script type="text/javascript" src="./jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.min.js" ></script>
<script type="text/javascript" src="js/jquery.form.js"></script>

<script type="text/javascript">
// Insert Record Into Table++++++++++++++++++++++++++++++++++++++++++++++++++++++
$(function() {
$(".submit_button").click(function() {
var dataString = $('#form').serialize()+'&page='+ $("#pagva").val();

//document.getElementById("show").innerHTML="";

				$("#form").ajaxForm({
						target: '#show'
					}).submit();

return false;
});
});
</script>

<script type="text/javascript">
// Update Record Into Table++++++++++++++++++++++++++++++++++++++++++++++++++++++
$(function() {
$(".Updatesubmit_button").click(function() {
var dataString = $('#form').serialize()+'&page='+ $("#pagva").val();;


//document.getElementById("show").innerHTML="";
				$("#form").ajaxForm({
						target: '#show'
					}).submit();



return false;
});
});
</script>

<script type="text/javascript">
// Paging Record Into Table++++++++++++++++++++++++++++++++++++++++++++++++++++++
$(function() {
$(".pages").click(function() {
var element = $(this);
var del_id = element.attr("id");
var info = 'page=' + del_id;

if(info=='')
{
alert("Select For delete..");
}
else
{
document.getElementById("show").innerHTML="";
$("#flash").fadeIn(400).html('<span class="load"><img src="load.gif"></span>');
$.ajax({
type: "POST",
url: "Placesimgaction.php",
data: info,
cache: true,
success: function(html){
$("#flash").fadeIn(400).html('');
$("#show").append(html);
$("#content").focus();
}  
});
}
return false;
});
});
</script>


<script type="text/javascript">
// Update selection Record Into Table++++++++++++++++++++++++++++++++++++++++++++++++++++++
$(function() {
$(".Edit").click(function() {
var element = $(this);
var del_id = element.attr("id");
var textcontent2 = $("#pagva").val();
var info = 'ide=' + del_id+'&page='+ textcontent2;

if(info=='')
{
alert("Select For Edit..");
//$("#content").focus();
}
else
{
document.getElementById("show").innerHTML="";
$("#flash").fadeIn(400).html('<span class="load"><img src="load.gif"></span>');
$.ajax({
type: "POST",
url: "Placesimgaction.php",
data: info,
cache: true,
success: function(html){
$("#flash").fadeIn(400).html('');
$("#show").append(html);
$("#content").focus();
}  
});
}
return false;
});
});
</script>


<script type="text/javascript">
// Delete selection Record Into Table++++++++++++++++++++++++++++++++++++++++++++++++++++++
$(function() {
$(".ABCD").click(function() {
var element = $(this);
var del_id = element.attr("id");
var textcontent2 = $("#pagva").val();
var info = 'id=' + del_id+'&page='+ textcontent2;
if(info=='')
{
alert("Select For delete..");
//$("#content").focus();
}
else
{
document.getElementById("show").innerHTML="";
$("#flash").fadeIn(400).html('<span class="load"><img src="load.gif"></span>');
$.ajax({
type: "POST",
url: "Placesimgaction.php",
data: info,
cache: true,
success: function(html){
$("#flash").fadeIn(400).html('');
$("#show").append(html);
$("#content").focus();
}  
});
}
return false;
});
});
</script>



<?php
if(isset($_POST['id']))
{
$id=$_POST['id'];
$delete = "DELETE FROM placesimg WHERE piid='$id'";
mysql_query( $delete);
}
?>

<div id="cp_contact_form">
<div id="cp_contact_form">
<form  action="Placesimgaction.php" method="post" name="form" id="form" enctype="multipart/form-data">
<div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="lastName" class="control-label">Location Name</label>
                    <Select name="content1"  class="form-control" id="firstName">   
<?php
$select_table1 = "select * from places";
$fetch1= mysql_query($select_table1);
while($row1 = mysql_fetch_array($fetch1))
{
	?>
	<option value="<?php echo $row1['PID']; ?>"><?php echo $row1['PTitle']; ?></option>
	<?php
}
?>
					</Select>
                  </div>
		
 </div>
<input  type="file" name="file" placeholder="Select File" value="">



                <div class="col-md-12">
                  <button type="button" name="submit" class="submit_button">Save</button>   
                </div>
              </div>

</form>
</div>
</div>



<?php

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

if(isset($_POST['content1']))
{

$content=mysql_real_escape_string($_POST['content1']);
$RD=date('Y-m-d');

$h="";
$str1="";
$h1="";
$str2="";

if(isset($_FILES['file']['name']))
	{
$h=time().$_FILES['file']['name'];
move_uploaded_file($_FILES['file']['tmp_name'],"../upload/".$h); 
$str1 = $I->HashAsString($I->HashImage("../upload/".$h));
$im="";
$a=$h;

$image="../upload/".$h;
if(strpos($a, '.jpg') !== false or strpos($a, '.JPG') !== false)
$im = imagecreatefromjpeg($image);
if(strpos($a, '.png') !== false or strpos($a, '.PNG') !== false)
$im = imagecreatefrompng($image);
if(strpos($a, '.gif') !== false or strpos($a, '.GIF') !== false)
$im = imagecreatefromgif($image);
$im=edgeimg($im);
$h1=time()."edge".$_FILES['file']['name'];
imagejpeg($im,"../upload/".$h1);
imagedestroy($im);
$str2 = $I->HashAsString($I->HashImage("../upload/".$h1));
	}

mysql_query("INSERT INTO placesimg(pid,Pfile,pichashval,grayhashval) VALUES('$content','$h','$str1','$str2')");

echo "<font style='color:#0000FF;'>Record Saved</font><br><br><br>";
}
?>

<div class="table-responsive">
<h4 class="margin-bottom-15">All Location Images</h4>
<table class="table table-striped table-hover table-bordered">
<thead><tr>
<td><b> ID</b></td>
<td><b> Title</b></td>
<td><b> City</b></td>
<td><b> Date</b></td>
<td></td>
</tr></thead>
<tbody>
<?PHP
					$per_page = 10; 
					$select_table = "select * from places,placesimg where places.PID=placesimg.pid";
					$fetch= mysql_query($select_table);
					$count = mysql_num_rows($fetch);
					$pages = ceil($count/$per_page);

$page=1;
if(isset($_POST['page']))
{
$page=$_POST['page'];
$start = ($page-1)*$per_page;
$select_table =$select_table." order by piid limit $start,$per_page";
$fetch= mysql_query($select_table);
}
while($row = mysql_fetch_array($fetch))
{
?>
<TR>
<TD><?php echo $row['piid']; ?></TD>
<TD><?php echo $row['PTitle']; ?></TD>
<TD><?php echo $row['City']; ?></TD>
<TD><?php echo $row['Pdate']; ?></TD>
<TD><?php echo $row['Pfile']; ?></TD>
<TD><a href="#" class="ABCD" id="<?php echo $row['piid']; ?>">[ Delete ]</a></TD>
</TR>
<?php
}
?>
</tbody></TABLE> 
              <ul class="pagination pull-right">
				<?php
				echo "<li><a href='#'class='pages' id='1'>|<</a></li>";
				for($i=1; $i<=$pages; $i++)
				{
					echo "<li><a href='#' class='pages' id=".$i.">".$i."</a></li>";
				}
				echo "<li><a href='#' class='pages' id=".--$i.">>|</a></li>";
				echo "<input type='hidden' id='pagva' class='pagva' name='pagva' style='width:30px;' value='".$page."'>";
				?>
</ul> 				
</div>
