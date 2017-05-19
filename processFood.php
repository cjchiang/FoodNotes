<?php include("include/header.php"); session_start();?>
<?php 
$storeOnOrOff = array();
$storePrices = array();
$storeValues = array();
$i = 0;
$j = 0;
$z = 0;
foreach($_POST as $foodName => $value)
{
    if(preg_match('/name/', $foodName)) {
        $foodName = str_replace("name", "" , $foodName);
        $foodName = str_replace("_", " ", $foodName);
        $storeOnOrOff[$i] = $foodName;// . "=" . (string)$value;
        $i = $i + 1;
    }
    if (preg_match('/price/', $foodName)) {
        $foodName = str_replace("price", "" , $foodName);
        $foodName = str_replace("_", " ", $foodName);
        $storePrices[$j] = $foodName;
        $storeValues[$z] = $value;
        $j = $j + 1;
        $z = $z + 1;
    }
}
$_SESSION['OnOffHolder'] = $storeOnOrOff;
$_SESSION['storeMyPrices'] = $storePrices;
$_SESSION['storeMyValues'] = $storeValues;
<<<<<<< HEAD
$a = true;
if($a) {
    echo $_SESSION['OnOffHolder'][0];
    echo "<font></font>";
}
=======
header('Location: addFood.php');
>>>>>>> aad885df71c3fdb17addbfe49e8dce87b1e79b79
?>
<script type="text/javascript">
    $("font").ready(function(){
        location.replace("addFood.php");
    });
</script>
<?php include("include/footer.php"); ?>