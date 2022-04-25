<?php
require "config.php";
?>
<!Doctype html>
<html>
<head>
  <title>VASA KORPA</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/home.css">
</head>
<body class="img js-fullheight" style="background-image: url(images/frr.jpg);">
  <div class="container" style="text-align:center;">
  <img src="images/cat.png" alt="Stvari za macke" width="250" height="250">
    <h1>KORPA</h1>
    <button class="btn btn-warning" id="add_data" style="float:right;margin:10px;">DODAJ NOVE PODATKE</button>
    
    
      <table class="table table-bordered" id="show_data">
    <p>
          <input type="text" placeholder="Unesi naziv" id="check_by_name" class="form-control" />
       </p>
       <p id="data_status"></p>
      <tr>
        <th style="background-color:#cfdac6">Naziv</th>
        <th style="background-color:#bddcbc">Cena</th>
        <th style="background-color:#cfdac6">Kvantitet</th>
      </tr>
      <tr id="add_data_field" style="display:none;">
        <td><input type="text" placeholder="Unesi novi proizvod"  id="naziv" class="form-control" /></td>
        <td><input type="number" placeholder="Unesi cenu"  id="cena"  class="form-control" /></td>
        <td><input type="number" placeholder="Unesi kolicinu"  id="kvantitet"  class="form-control" /></td>
        <td><button class="btn" id="add">DODAJ</button></td>
      </tr>
      <?php
      /*$con = mysqli_connect('localhost','root','','baza');
      if(!$con)
      {
        die('connection not establish');
      }
      */
      $sel = "select * from Proizvod ORDER by ProizvodID DESC";
      $query = mysqli_query($con,$sel);
      if(mysqli_num_rows($query) > 0)
      {
        while($data = mysqli_fetch_array($query))
        {
          echo '
            <tr>
              <td style="background-color:#fdfcfc">'.$data['Naziv'].'</td>
              <td style="background-color:#fdfcfc">'.$data['CENA'].'</td>
              <td style="background-color:#fdfcfc">'.$data['KVANTITET'].'</td>
              <td style="background-color:#fdfcfc">
                <button class="btn edit" id='.$data['ProizvodID'].'>IZMENI</button>
                <button class="btn delete" id='.$data['ProizvodID'].'>OBRISI</button>
              </td>
            </tr>
          ';
        }
      }
      else
      {
        echo '
            <tr>
              <td>No  Data found</td>
              <td>No  Data found</td>
              <td>No  Data found</td>
            </tr>
          ';
      }
      ?>
    </table>

  </div>

  <script type="text/javascript">
  // add_data
    $(document).on('click','#add_data',function (){
         $('#add_data_field').show();
    });
  // add data in database
    $(document).on('click','#add',function (){
        var nm = $('#naziv').val();
        var em = $('#cena').val();
        var am = $('#kvantitet').val();
    $.ajax({
      url:"add_data.php",
      method:"post",
      data:{nm:nm,em:em,am:am},
      success:function(data){
        $('#show_data').html(data);
      }
    });
    });
  // Show edit data
  $(document).on('click','.edit',function (){
        var id = $(this).attr('id');
    var edit = 'show_edit_data';
    $.ajax({
      url:"edit_data.php",
      method:"post",
      data:{id:id,edit:edit},
      success:function(data){
        $('#show_data').html(data);
      }
    });
    });
  // edit data
  $(document).on('click','.update',function (){
        var name = $('#new_naziv').val();
        var email = $('#new_cena').val();
        var lob = $('#new_kvantitet').val();
    var update_id = $(this).attr('id');
    var edit = 'edit_data';
    $.ajax({
      url:"edit_data.php",
      method:"post",
      data:{name:name,email:email,lob:lob,edit:edit,update_id:update_id},
      success:function(data){
        $('#show_data').html(data);
      }
    });
    });
  // delete data
  $(document).on('click','.delete',function (){
        var del_id = $(this).attr('id');
    $.ajax({
      url:"delete_data.php",
      method:"post",
      data:{del_id:del_id},
      success:function(data){
        $('#show_data').html(data);
      }
    });
    });
    //search data
    $(document).on('keyup','#check_by_name',function(){
       var search_by_name = $('#check_by_name').val();
       $.ajax({
          url:"search.php",
          method:"post",
          data:{search_by_name:search_by_name},
          beforeSend:function(data){
              $('#data_status').html('<strong>fetching data.....</strong>');
          },
          success:function(data){
             $('#data_status').html('<strong>You search '+ search_by_name +' </strong>');
             $('#show_data').html(data);
          }
       })
    });
  

  $(document).ready(function() {
    $('#add').click(function() {
        if (!$('#naziv').val()) {
            alert('Unesi naziv proizvoda!');
        }
    })
});



  </script>
</body>
</html>