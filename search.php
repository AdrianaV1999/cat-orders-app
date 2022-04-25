<?php
include "config.php";

if(isset($_POST['search_by_name'])){
    $string = mysqli_real_escape_string($con,$_POST['search_by_name']);
    $sel="select * from Proizvod where Naziv like '%$string%' ";
    $query=mysqli_query($con,$sel);
    if(mysqli_num_rows($query)>0){
        echo'<tr>
        <th>Naziv</th>
        <th>Cena</th>
        <th>Kvantitet</th>
     </tr>';
        while($data=mysqli_fetch_array($query)){
            echo'
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
    }
    else
    {
        echo'<tr style="background-color:#fdfcfc">
                <th style="background-color:#fdfcfc">Naziv</th>
                <th style="background-color:#fdfcfc">Cena</th>
                <th style="background-color:#fdfcfc">Kvantitet</th>
            </tr>
            <tr>
                <td style="background-color:#fdfcfc">Data not found</td>
                <td style="background-color:#fdfcfc">Data not found</td>
            </tr>';
    }
}
?>
