<?php
if(isset($_POST['edit']))
{
   // creating database connection
   $con = mysqli_connect('localhost','root','','baza');
   if(!$con)
   {
      die('connection not establish');
   }
   // declaring a output variable for showing data
   $output='';
   if($_POST['edit'] == 'show_edit_data')
   {
      $id = $_POST['id'];
      $update = "select * from Proizvod where ProizvodID='".$id."'";
      $update_query = mysqli_query($con,$update);
      if($update_query)
      {
         $update_data = mysqli_fetch_array($update_query);
         $output.='
         <table class="table table-bordered" id="show_data">
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
            if($data['ProizvodID'] == $id)
            {
               $output.='
               <tr>
                  <td style="background-color:#fdfcfc"><input type="text" id="new_naziv" class="form-control" value="'.$update_data['Naziv'].'" /></td>
                  <td style="background-color:#fdfcfc"><input type="text" id="new_cena" class="form-control" value="'.$update_data['CENA'].'" /></td>
                  <td style="background-color:#fdfcfc"><input type="text" id="new_kvantitet" class="form-control" value="'.$update_data['KVANTITET'].'" /></td>
                  <td style="background-color:#fdfcfc"><button class="btn update" id='.$update_data['ProizvodID'].'>Update</button></td>
               </tr>
               ';
            }
            else
            {
               $output.='
                  <tr>
                  <td style="background-color:#fdfcfc">'.$data['Naziv'].'</td>
                  <td style="background-color:#fdfcfc">'.$data['CENA'].'</td>
                  <td style="background-color:#fdfcfc">'.$data['KVANTITET'].'</td>
                                       <td td style="background-color:#fdfcfc">
                        <button class="btn edit" id='.$data['ProizvodID'].'>IZMENI</button>
                        <button class="btn delete" id='.$data['ProizvodID'].'>OBRISI</button>
                     </td>
                  </tr>';
            }
         }
         $output.='</table>';
      }
      else
      {
         $output.='Problem in Fetching data';
      }
   }
   else
   {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $eemail = $_POST['lob'];
      $id = $_POST['update_id'];
      $update = "update Proizvod set Naziv='".$name."',CENA='".$email."',KVANTITET='".$eemail."' where ProizvodID='".$id."'";
      $update_query = mysqli_query($con,$update);
      if($update_query)
      {
        $output.='<table class="table table-bordered" id="show_data">
        <tr>
        <th style="background-color:#cfdac6">Naziv</th>
        <th style="background-color:#bddcbc">Cena</th>
        <th style="background-color:#cfdac6">Kvantitet</th        </tr>
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
         $output.='Problem in Updating data';
      }
   }
echo $output;
}
?>