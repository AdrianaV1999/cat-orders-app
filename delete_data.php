<?php
include "config.php";
if(isset($_POST['del_id']))
{
   // declaring a output variable for showing data
   $output='';
   $id = $_POST['del_id'];
   /* creating database connection
   $con = mysqli_connect('localhost','root','','baza');
   if(!$con)
   {
      die('connection not establish');
   }
   */
   $del = "delete from Proizvod where ProizvodID='".$id."'";
   $query = mysqli_query($con,$del);
   if($query)
   {
    $output.='<table class="table table-bordered" id="show_data">
    <tr>
    <th style="background-color:#cfdac6">Naziv</th>
    <th style="background-color:#bddcbc">Cena</th>
    <th style="background-color:#cfdac6">Kvantitet</th
    </tr>
    <tr id="add_data_field" style="display:none;">
<td><input type="text" placeholder="Unesi novi proizvod" id="naziv" class="form-control" /></td>
<td><input type="number" placeholder="Unesi cenu" id="cena" class="form-control" /></td>
<td><input type="number" placeholder="Unesi kolicinu" id="kvantitet" class="form-control" /></td>
<td><button class="btn" id="add">DODAJ</button></td>
</tr>';
$sel = "select * from Proizvod order by ProizvodID desc";
$query = mysqli_query($con,$sel);
while($data = mysqli_fetch_array($query))
{
   $output.='
   <tr>
              <td style="background-color:#fdfcfc">'.$data['Naziv'].'</td>
              <td style="background-color:#fdfcfc">'.$data['CENA'].'</td>
              <td style="background-color:#fdfcfc">'.$data['KVANTITET'].'</td>
              <td style="background-color:#fdfcfc">
                <button class="btn edit" id='.$data['ProizvodID'].'>IZMENI</button>
                <button class="btn delete" id='.$data['ProizvodID'].'>OBRISI</button>
              </td>
            </tr>';
}
$output.='</table>';

   }
   else
   {
      $output.='Problem in Inserting data';
   }
echo $output;
}
?>