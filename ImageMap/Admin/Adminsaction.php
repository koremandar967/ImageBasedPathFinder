<?php
session_start();
include('db.php');
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
url: "Adminvalid.php",
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
url: "Adminvalid.php",
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
url: "Adminsaction.php",
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
url: "Adminsaction.php",
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
url: "Adminsaction.php",
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
// Approval selection Record Into Table++++++++++++++++++++++++++++++++++++++++++++++++++++++
$(function() {
$(".Approval").click(function() {
var element = $(this);
var del_id = element.attr("id");
var textcontent2 = $("#pagva").val();
var info = 'Aid=' + del_id+'&page='+ textcontent2;
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
url: "Adminsaction.php",
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
$delete = "DELETE FROM userreg WHERE UID='$id'";
mysql_query( $delete);
}
?>

<?php
if(isset($_POST['ide']))
{
$id=$_POST['ide'];
$select_table = "select * from userreg where UID=".$id;
$fetch= mysql_query($select_table);
while($row = mysql_fetch_array($fetch))
{
?>
<div id="cp_contact_form">
<div id="cp_contact_form">
<form action="Adminsaction.php" method="post" name="form" id="form" enctype="multipart/form-data">

				<div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">ID</label>
                    <input type="text" name="ucontent" size="0" maxlength="0" value="<?php echo $row['UID']; ?>" class="form-control" id="firstName" Placeholder="ID">           
                  </div> </div>

                  <div class="col-md-6 margin-bottom-15">
                    <label for="lastName" class="control-label">First Name</label>
                    <input type="text" name="ucontent1"  value="<?php echo $row['Fname']; ?>" class="form-control" id="lastName" Placeholder="First Name">        
                  </div>

                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Last Name</label>
                    <input type="text" name="ucontent2" value="<?php echo $row['Lname']; ?>" class="form-control" id="firstName" Placeholder="Last Name">           
				</div>
                  <div class="col-md-6 margin-bottom-15">
                    <label for="lastName" class="control-label">Email</label>
                    <input type="text" name="ucontent3"  value="<?php echo $row['Email']; ?>" class="form-control" id="lastName" Placeholder="Email">        
                  </div>
                         <div class="col-md-6 margin-bottom-15">
                    <label for="lastName" class="control-label">Password</label>
                    <input type="Password" name="ucontent4"  value="<?php echo $row['Pass']; ?>" class="form-control" id="lastName" Placeholder="Password">        
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
<form  action="Adminsaction.php" method="post" name="form" id="form" enctype="multipart/form-data">


                  <div class="col-md-6 margin-bottom-15">
                    <label for="lastName" class="control-label">First Name</label>
                    <input type="text" name="content1"  class="form-control" id="lastName" Placeholder="First Name">        
                  </div>

                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Last Name</label>
                    <input type="text" name="content2" class="form-control" id="firstName" Placeholder="Last Name">           
				</div>
                  <div class="col-md-6 margin-bottom-15">
                    <label for="lastName" class="control-label">Email</label>
                    <input type="text" name="content3" class="form-control" id="lastName" Placeholder="Email">        
                  </div>
                         <div class="col-md-6 margin-bottom-15">
                    <label for="lastName" class="control-label">Password</label>
                    <input type="Password" name="content4" class="form-control" id="lastName" Placeholder="Password">        
                  </div>

              <div class="row templatemo-form-buttons">
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
if(isset($_POST['content1']))
{

$content1=mysql_real_escape_string($_POST['content1']);
$content2=mysql_real_escape_string($_POST['content2']);
$content3=mysql_real_escape_string($_POST['content3']);
$content4=mysql_real_escape_string($_POST['content4']);
$RD=date('Y-m-d');


mysql_query("INSERT INTO userreg(Fname,Lname,Email,Pass) VALUES('$content1','$content2','$content3','$content4')");

echo "<font style='color:#0000FF;'>Record Saved</font><br><br><br>";
}
if(isset($_POST['ucontent']))
{

$ucontent=mysql_real_escape_string($_POST['ucontent']);
$ucontent1=mysql_real_escape_string($_POST['ucontent1']);
$ucontent2=mysql_real_escape_string($_POST['ucontent2']);
$ucontent3=mysql_real_escape_string($_POST['ucontent3']);
$ucontent4=mysql_real_escape_string($_POST['ucontent4']);

$ip=mysql_real_escape_string($_SERVER['REMOTE_ADDR']);
mysql_query("update userreg set Fname='$ucontent1', Lname='$ucontent2', Email='$ucontent3',Pass='$ucontent4' where UID=$ucontent");
echo "<font style='color:#0000FF;'>Record Update</font><br><br><br>";
}
?>

<div class="table-responsive">
<h4 class="margin-bottom-15">All Admin Table</h4>
<table class="table table-striped table-hover table-bordered">
<thead><tr>
<td><b> ID</b></td>
<td><b> Name</b></td>
<td><b> Email</b></td>
<td></td>
</tr></thead>
<tbody>
<?PHP
					$per_page = 5; 
					$select_table = "select * from userreg";
					$fetch= mysql_query($select_table);
					$count = mysql_num_rows($fetch);
					$pages = ceil($count/$per_page);

$page=1;
if(isset($_POST['page']))
{
$page=$_POST['page'];
$start = ($page-1)*$per_page;
$select_table =$select_table." order by UID limit $start,$per_page";
$fetch= mysql_query($select_table);
}
//echo $select_table."sdfdfds".$page;
while($row = mysql_fetch_array($fetch))
{
?>
<TR>
<TD><?php echo $row['UID']; ?></TD>
<TD><?php echo $row['Fname']; ?> <?php echo $row['Lname']; ?></TD>
<TD><?php echo $row['Email']; ?></TD>
<TD><a href="#" class="ABCD" id="<?php echo $row['UID']; ?>">[ Delete ]</a>
<a href="#" class="Edit" id="<?php echo $row['UID']; ?>"></a>
</TD>
</TR>
<?php
}
?>
</tbody></TABLE> 
              
</div>
