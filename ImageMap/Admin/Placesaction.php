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

$.ajax({
type: "POST",
url: "Placesvalid.php",
data: dataString,
cache: true,
success: function(html){
if(html=="Yes")
{
//document.getElementById("show").innerHTML="";

				$("#form").ajaxForm({
						target: '#show'
					}).submit();
}
else
	{
	alert(html);
	}
}  
});



return false;
});
});
</script>

<script type="text/javascript">
// Update Record Into Table++++++++++++++++++++++++++++++++++++++++++++++++++++++
$(function() {
$(".Updatesubmit_button").click(function() {
var dataString = $('#form').serialize()+'&page='+ $("#pagva").val();;

$.ajax({
type: "POST",
url: "Placesvalid.php",
data: dataString,
cache: true,
success: function(html){
if(html=="Yes")
{
//document.getElementById("show").innerHTML="";
				$("#form").ajaxForm({
						target: '#show'
					}).submit();
}
else
	{
	alert(html);
	}
	}  
});

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
url: "Placesaction.php",
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
url: "Placesaction.php",
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
url: "Placesaction.php",
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
$delete = "DELETE FROM places WHERE PID='$id'";
mysql_query( $delete);
}
?>

<?php
if(isset($_POST['ide']))
{
$id=$_POST['ide'];
$select_table = "select * from places where PID=".$id;
$fetch= mysql_query($select_table);
while($row = mysql_fetch_array($fetch))
{
?>
<div id="cp_contact_form">
<div id="cp_contact_form">
<form action="Placesaction.php" method="post" name="form" id="form" enctype="multipart/form-data">

				<div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">ID</label>
                    <input type="text" name="ucontent" size="0" maxlength="0" value="<?php echo $row['PID']; ?>" class="form-control" id="firstName" Placeholder="ID">           
                  </div>
                  <div class="col-md-6 margin-bottom-15">
                    <label for="lastName" class="control-label">Location Name</label>
                    <input type="text" name="ucontent1"  value="<?php echo $row['PTitle']; ?>" class="form-control" id="lastName" Placeholder="Location Name">        
                  </div>
                </div>

				<div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Location Address</label>
                    <textarea name="ucontent2" class="form-control" id="firstName" Placeholder="Location Address"><?php echo $row['Pinfo']; ?>  </textarea>
                  </div>

                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">City</label>
                    <input type="text" name="ucontent3"  class="form-control" id="firstName" value="<?php echo $row['City']; ?>">
                  </div> </div>

				<div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Latitude</label>
                    <input type="text" name="ucontent4" size="0" value="<?php echo $row['Latitude']; ?>" class="form-control" id="lat" Placeholder="Latitude">           
                  </div>
                  <div class="col-md-6 margin-bottom-15">
                    <label for="lastName" class="control-label">Longitude</label>
                    <input type="text" name="ucontent5"  value="<?php echo $row['Longitude']; ?>" class="form-control" id="lng" Placeholder="Longitude">        
                  </div>
                </div>



              <div class="row templatemo-form-buttons">

        <script>
            var map;
            function initialize() {
                var mapOptions = {
                    zoom: 12,
                    center: new google.maps.LatLng(16.6972161, 74.2825023),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById('map_canvas'),
                    mapOptions
                );
                google.maps.event.addListener(map, 'click', function(event) {

                });
            }

			
function newLocation(newLat,newLng) {
	map.setCenter({
		lat : newLat,
		lng : newLng
	});

            function mapDivClicked (event) {
                var target = document.getElementById('map_canvas'),
                    posx = event.pageX - target.offsetLeft,
                    posy = event.pageY - target.offsetTop,
                    bounds = map.getBounds(),
                    neLatlng = bounds.getNorthEast(),
                    swLatlng = bounds.getSouthWest(),
                    startLat = neLatlng.lat(),
                    endLng = neLatlng.lng(),
                    endLat = swLatlng.lat(),
                    startLng = swLatlng.lng();

                document.getElementById('lat').value = startLat + ((posy/350) * (endLat - startLat));
                document.getElementById('lng').value = startLng + ((posx/500) * (endLng - startLng));
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>


        <div id="map_canvas" onclick="mapDivClicked(event);" style="height: 350px; width: 100%;"></div>


							</div>

              <div class="row templatemo-form-buttons">
                <div class="col-md-12">
                  <button type="button" name="submit" class="Updatesubmit_button">Update</button>   
                </div>
              </div>
</form>
</form>
</div>
</div>
<?php
}
}
else
{
?>
<div id="cp_contact_form">
<div id="cp_contact_form">
<form  action="Placesaction.php" method="post" name="form" id="form" enctype="multipart/form-data">

				<div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="lastName" class="control-label">Location Name</label>
                    <input type="text" name="content"  class="form-control" id="lastName" Placeholder="Location Name">        
                  </div>
      
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Location Address</label>
                    <textarea name="content1" class="form-control" id="firstName" Placeholder="Location Address"></textarea>
                  </div>
                </div>

			<div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">City</label>
                    <input type="text" name="content2"  class="form-control" id="firstName">
                  </div> </div>

				<div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Latitude</label>
                    <input type="text" name="content3" size="0" value="" class="form-control" id="lat" Placeholder="Latitude">           
                  </div>
                  <div class="col-md-6 margin-bottom-15">
                    <label for="lastName" class="control-label">Longitude</label>
                    <input type="text" name="content4"  value="" class="form-control" id="lng" Placeholder="Longitude">        
                  </div>
                </div>


              <div class="row templatemo-form-buttons">

        <script>
            var map;
            function initialize() {
                var mapOptions = {
                    zoom: 12,
                    center: new google.maps.LatLng(16.6972161, 74.2825023),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById('map_canvas'),
                    mapOptions
                );
                google.maps.event.addListener(map, 'click', function(event) {

                });
            }
            function mapDivClicked (event) {
                var target = document.getElementById('map_canvas'),
                    posx = event.pageX - target.offsetLeft,
                    posy = event.pageY - target.offsetTop,
                    bounds = map.getBounds(),
                    neLatlng = bounds.getNorthEast(),
                    swLatlng = bounds.getSouthWest(),
                    startLat = neLatlng.lat(),
                    endLng = neLatlng.lng(),
                    endLat = swLatlng.lat(),
                    startLng = swLatlng.lng();

                document.getElementById('lat').value = startLat + ((posy/350) * (endLat - startLat));
                document.getElementById('lng').value = startLng + ((posx/500) * (endLng - startLng));
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
        <div id="map_canvas" onclick="mapDivClicked(event);" style="height: 350px; width: 100%;"></div>


							</div>



                <div class="col-md-12">
                  <button type="button" name="submit" class="submit_button">Save</button>   
                </div>
              </div>

</form>
</div>
</div>
<?php
}
?>


<?php
if(isset($_POST['content']))
{

$content=mysql_real_escape_string($_POST['content']);
$content1=mysql_real_escape_string($_POST['content1']);
$content2=mysql_real_escape_string($_POST['content2']);
$content3=mysql_real_escape_string($_POST['content3']);
$content4=mysql_real_escape_string($_POST['content4']);
$RD=date('Y-m-d');


mysql_query("INSERT INTO places(PTitle,Pinfo,Pdate,City,Latitude,Longitude) VALUES('$content','$content1','$RD','$content2','$content3','$content4')");

echo "<font style='color:#0000FF;'>Record Saved</font><br><br><br>";
}
if(isset($_POST['ucontent']))
{

$ucontent=mysql_real_escape_string($_POST['ucontent']);
$ucontent1=mysql_real_escape_string($_POST['ucontent1']);
$ucontent2=mysql_real_escape_string($_POST['ucontent2']);
$ucontent3=mysql_real_escape_string($_POST['ucontent3']);
$ucontent4=mysql_real_escape_string($_POST['ucontent4']);
$ucontent5=mysql_real_escape_string($_POST['ucontent5']);


$ip=mysql_real_escape_string($_SERVER['REMOTE_ADDR']);
mysql_query("update places set PTitle='$ucontent1', Pinfo='$ucontent2',City='$ucontent3',Latitude='$ucontent4',Longitude='$ucontent5' where PID=$ucontent");
echo "<font style='color:#0000FF;'>Record Update</font><br><br><br>";
}
?>


<div class="table-responsive">
<h4 class="margin-bottom-15">All Places</h4>
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
					$per_page = 5; 
					$select_table = "select * from places";
					$fetch= mysql_query($select_table);
					$count = mysql_num_rows($fetch);
					$pages = ceil($count/$per_page);

$page=1;
if(isset($_POST['page']))
{
$page=$_POST['page'];
$start = ($page-1)*$per_page;
$select_table =$select_table." order by PID limit $start,$per_page";
$fetch= mysql_query($select_table);
}
while($row = mysql_fetch_array($fetch))
{
?>
<TR>
<TD><?php echo $row['PID']; ?></TD>
<TD><?php echo $row['PTitle']; ?></TD>
<TD><?php echo $row['City']; ?></TD>
<TD><?php echo $row['Pdate']; ?></TD>
<TD><a href="#" class="ABCD" id="<?php echo $row['PID']; ?>">[ Delete ]</a>
</TD>
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
