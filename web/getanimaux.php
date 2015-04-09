<?php
/**
 * Created by PhpStorm.
 * User: Feyhna
 * Date: 05/04/2015
 * Time: 04:51
 */

$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','','sf');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql="SELECT * FROM animaux WHERE espece_id = '".$q."'";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result)) {
    echo '<div class="col-md-4 col-sm-6 hero-feature"> <div class="thumbnail" style="height: 550px"><img src="/sf/web/bundles/priscazoo/images/'.$row['photo'].'"alt="'.$row['nom'].'"><div class="caption"><h3>'.$row['nom'].'</h3><div style="text-align: left">';
    if($row['genre'] === 'm'){
        echo "<b>Genre : </b> Mâle</br/>";
    }else{
        echo "<b > Genre : </b > Femelle<br />";
    }
    echo "<b>Date naissance : </b>".$row['datenaissance']."<br/>";
    if($row['datedeces'] != NULL){
        echo "<b>Date décès : </b>".$row['datedeces']."<br/>";
    }
    echo "<p><b>Description : </b>".utf8_encode($row['description'])."</p></div></div></div></div>";
}
mysqli_close($con);
?>