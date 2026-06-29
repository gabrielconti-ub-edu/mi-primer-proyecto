<?php
$version="";
$server_name="";
$server_port="";

 if (getenv('HOME') == ''){                       // Not set when running as service
   $root= substr($_SERVER["DOCUMENT_ROOT"],0,-4); // this alternative with limitations
 }                                                // gets path to folder UniServerZ

 else{                                            // Set when run as standard program
   $root= getenv('HOME');                         // this is the ideal method to
 }                                                // get the path to folder UniServerZ

$file="$root\home\us_config\us_config.ini" ;     // Name and path of configuration file

if (file_exists($file) && is_readable($file)){   // Check file
  $settings=parse_ini_file($file,true);          // parse file into an array
  $version=$settings["APP"]["AppVersion"];       // get parameter
}


$file="$root\home\us_config\us_user.ini" ;       // Name and path of user configuration file

if (file_exists($file) && is_readable($file)){     // Check file
  $settings=parse_ini_file($file,true);            // parse file into an array
  $server_name=$settings["USER"]["US_SERVERNAME"]; // get parameter
  $server_port=$settings["USER"]["AP_PORT"];       // get parameter
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>Carpetas - test page</title>
<meta name="Description" content="Carpetas - test page" />
<meta name="Keywords" content="Gabriel Conti,Conti" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
</head>

<style type="text/css">
/*****************************************/
.intro{
  margin-top:10px;
  margin-bottom:10px;
  padding:3px;
  font-size:11px;
  font-family:Verdana;
  background-color: #E7E7FD;
  border-top:1px solid #4f4f97;
  border-bottom:1px solid #4f4f97;
}
/*****************************************/
</style>

<body>

<div id="wrap">
  <div id="header">
     <a href="https://www.uniformserver.com"><img src="images/logo.png" align="left" alt="The Uniform Server Zero" /></a>
       <div id="header_txt" >
         <div style="position:absolute;">
             ZeroXV <?php print "- ".$version; ?> </p>
         </div>
       </div>
  </div>


  <div id="content">
    <h1>Bienvenido a los Ejemplos</h1>

    <p class="intro">Esta página <b>index.php</b> tiene todos los ejemplos de<b>PRÁCTICA</b>
    </p>


<!-- splash page link -->
<!-- <?php print("--" . ">");?>

  <table>
  <tr>
   <td>
     <h2>Server links</h2>
      <p> <a href="http://<?php echo($server_name.':'.$server_port) ?>/us_opt1/index.php" target="_blank" >PhpMyAdmin</a>.</p>
   </td>
  </tr>
  </table>
<?php print("<"."!"."--")?> -->

<!-- subdirs  -->
<!-- <?php print("--" . ">");?>

  <table>
  <tr><td><h2>Served Subdirectories</h2></td></tr>
  </table>
  <table width=100%>
  <?php $n = 0; foreach (scandir("./") as $file){
    if (is_dir($file) && !in_array($file, array(".", "..", "css", "images"))){
        $n++;
        echo ($n % 3 ? (($n+1) % 3 ? "<tr><td width=33%>$n - <a href='" . $file . "' target='_blank'>" . $file . "</a></td>" : "<td width=33%>$n - <a href='" . $file . "' target='_blank'>" . $file . "</a></td>") : "<td>$n - <a href='" . $file . "' target='_blank'>" . $file . "</a></td></tr>");
    }
  }
  echo ($n == 0 ? "<tr><td style='color: red;' colspan='3'>None</td></tr>" : ($n % 2 == 0 ? "" : "<td></td></tr>"));?>
  </table>
<?php print("<"."!"."--")?> -->


<!-- php files  -->
<!-- <?php print("--" . ">");?>

  <table>
  <tr><td><h2>Served PHP Files</h2></td></tr>
  </table>
  <table width=100%>

  <?php $n = 0; foreach (scandir("./") as $file){
    if (strtolower(strrchr($file, '.'))==".php" && $file!="index.php"){
        $n++;
        echo ($n % 3 ? (($n+1) % 3 ? "<tr><td width=33%>$n - <a href='" . $file . "' target='_blank'>" . $file . "</a></td>" : "<td width=33%>$n - <a href='" . $file . "' target='_blank'>" . $file . "</a></td>") : "<td>$n - <a href='" . $file . "' target='_blank'>" . $file . "</a></td></tr>");
    }
  }
  echo ($n == 0 ? "<tr><td style='color: red;' colspan='3'>None</td></tr>" : ($n % 2 == 0 ? "" : "<td></td></tr>"));?>
  </table>
 
<?php print("<"."!"."--")?> -->


  <div id="divider">Desarrollado By <a href="www.linkedin.com/in/gabrielcarlosconti/">Gabriel Conti</a></div>
</div>
</div>
</body>
</html>
