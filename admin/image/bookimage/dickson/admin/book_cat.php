<?php 
session_start();
ob_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template_admin.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Book Shop</title>

<script language="JavaScript" src="gen_validatorv31.js" type="text/javascript"></script>
<script language="JavaScript" src="calendar_db.js"></script>
<link rel="stylesheet" href="calendar.css">

<style type="text/css">
body,td,th {
	color: #FFF;
}
body {
	background-image: url(image/bg_adminbg.png);
}
</style>
</head>

<link href="css/index.css" rel="stylesheet" type="text/css" />

<body>
<table width="1024" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="100" colspan="2"><img src="image/Banner.png" alt="Book Shop" width="1024" height="100" border="0" /></td>
  </tr>
  <tr>
    <td height="50" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="200" rowspan="2" align="center" valign="top"><p><a href="index.php"><img src="image/btnhome.png" alt="Homepage" width="150" height="40" border="0" /></a></p>
    <p><a href="book.php"><img src="image/btnbook.png" alt="Book" width="150" height="40" border="0" /></a></p>
    <p><a href="adminreportmonthly.php"><img src="image/btnreport.png" alt="Report" width="150" height="40" border="0" /></a></p></td>
    <td width="800" align="right">
	<?php if(isset($_SESSION['USERNAME']))	{ ?>
	<form id="form2" name="form2" method="post" action="php/adminlogout.php">
    <input type="submit" name="btnlogout" id="btnlogout" value="Logout" />
    </form>
    <?php } ?>
    </td>
  </tr>
  <tr>
    <td width="800" valign="top">
	<!-- InstanceBeginEditable name="Content" -->
    <?php if (isset($_SESSION["USERNAME"])) { ?>
     <form id="form3" name="form3" method="post" action="php/php/catadd.php">
            <table width="80%" border="0">
              <tr>
                <td width="40%" align="left" valign="top" bgcolor="#999999">Cat Name:</td>
                <td width="60%" align="left" valign="top" bgcolor="#999999"><label>
                  <input name="s_acc" type="text" id="s_acc" size="30" />
                </label></td>
              </tr>
              <tr>
                <td colspan="2" align="left" valign="top" bgcolor="#999999"><p>
                  <label>
                    <input type="submit" name="btnsubmit" id="btnsubmit" value="Add" />
                  </label>
                  <label>
                    <input type="reset" name="btnreset" id="btnreset" value="Reset" />
                  </label>
                </p></td>
              </tr>
              </table>
              </form>
                     <?php } else {
echo "<script>alert('Warning!!! Warning!!! Warning!!! You have no permission!!!')</script>"; ?>
<meta http-equiv="REFRESH" Content="0;url=index.php">
<?php } ?>
	<!-- InstanceEndEditable --> 
    </td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>