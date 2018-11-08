<?php 
include('server_invoice.php');

  if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM INVOICE_13113 WHERE id='$id'");
  if (count($record) == 1 ) {
    $n = mysqli_fetch_array($record);
    $id = $n['id'];
    $Item_ID= $n['Item_ID'];
    $QUANTITY = $n['QUANTITY'];
    
    }
  }
?>


<?php 
  if (isset($_SESSION['message'])): ?>
    <div class="msg">
<?php 
  echo $_SESSION['message']; 
  unset($_SESSION['message']);
?>
    </div>
<?php endif ?>

  


<form method="post" action="server_invoice.php" >

  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <div class="input-group">

<div class="input-group">
        <input type="hidden" name="INVID" id = "inv">
  </div>
  <div class="input-group">
    <label>ITEM ID</label>
    <input type="text" name="Item_ID" value="<?php echo $Item_ID; ?>">
  </div>

  <div class="input-group">
    <label>QUANTITY</label>
    <input type="number" name="QUANTITY" value="<?php echo $QUANTITY; ?>">
  </div>



  <div class="input-group">

    <?php if ($update == true): ?>
      <button class="btn" type="submit" name="update" style="background: #556B2F;" >Update</button>
    <?php else: ?>
      <button class="btn" type="submit" name="save" >Save</button>
    <?php endif ?>
  </div>
</form>

<script src = "js/jquery-3.1.1.js"></script>  
<script src = "js/bootstrap.js"></script>

<script type = "text/javascript">
$(document).ready(function(){
    var price = 0;
    $('#searchid').change(function(){
      if ($('#searchid').val() == "")
        $('#searchinvid').prop('disabled', true);
      else
      {
        $('#searchinvid').prop('disabled', false);
        showinvid();
      }
    });
    $('#searchinv').change(function(){
      if ($('#searchinvid').val() == "")
        $('#add1').prop('disabled', true);
      else
      {
        $('#add1').prop('disabled', false);
      }
      show();
    });

$('#quantity').change(function(){
        var total = parseInt((100-$('#discount').val())/100 * price * $('#quantity').val()); 
          $('#total').val(total);
});

$('#discount').change(function(){
        var total = parseInt((100-$('#discount').val())/100 * price * $('#quantity').val()); 
          $('#total').val(total);
});

$('#pcode').change(function(){
      $pcode = $('#pcode').val();
      
      $.ajax({
        type: "POST",
        url: "search.php",
        data: {
          pcode: $pcode,
          searchprod: 1,
        },
        
        success: function(data)
        {
          var obj = JSON.parse(data);
          $('#shade').val(obj.SHADE);
          $('#type').val(obj.TYPE);
          $('#size').val(obj.SIZE);
          $('#price').val(obj.PRICE);
          price = parseInt(obj.PRICE);
        }
      });
});

$('#cid').change(function(){
      $cid = $('#cid').val();
      
      $.ajax({
        type: "POST",
        url: "search.php",
        data: {
          cid: $cid,
          search: 1,
        },
        
        success: function(data)
        {
          var obj = JSON.parse(data);
          $('#cname').val(obj.CNAME);
          $('#sname').val(obj.SNAME);
          $('#cno').val(obj.CNO);
          $('#address').val(obj.ADDRESS);
          $('#area').val(obj.ADDRESS);
          $('#gc').val(obj.GC);
        }
      });
});

$(document).on('click', '#additem', function(){
      if ($('#pcode').val()=="" || $('#quantity').val()=="" || $('#quantity').val()<=0 || $('#discount').val()<0|| $('#discount').val() == ''){
        alert('Please input data first');
      }
      else{
      $('#addentry').modal('hide');
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
      $pcode=$('#pcode').val();
      $quantity=$("#quantity").val();
      $discount=$("#discount").val(); 
      $invid=$("#searchinvid").val();
      $('#additem').html('Adding..');
      $.ajax({
          type: "POST",
          url: "addnew.php",
          data: {
            pcode: $pcode,
            invid: $invid,
            quantity: $quantity,
            discount: $discount,
            additem: 1,
          },
          success: function(response){
            $obj = response;
            if($obj != "")
                  alert($obj);
            $('#additem').html('Add');
            show();
            
          }
        });
      }
    });


    //ADD NEW
    $(document).on('click', '#addnew', function(){
      if ($('#cid').val()=="" || $('#invid').val()=="" || isNaN(Date.parse($('#date').val()))){
        alert('Please input data first');
      }
      else{
      $('#createinvoice').modal('hide');
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
      $cid=$('#cid').val();
      $invid=$("#invid").val();
      $date=$("#date").val(); 
      $('#addnew').html('Adding..');
      $.ajax({
          type: "POST",
          url: "addnew.php",
          data: {
            cid: $cid,
            invid: $invid,
            date: $date,
            add: 1,
          },
          success: function(response){
            $obj = response;
            if($obj != "")
                  alert($obj);
            $('#addnew').html('Add');
            showinvid();
            
          }
        });
      }
    });
    

    //DELETE
    $(document).on('click', '.delete', function(){
      $id=$(this).val();
      $(this).html('Deleting..');
        $.ajax({
          type: "POST",
          url: "delete.php",
          data: {
            id: $id,
            del: 1,
          },
          success: function(response){
            $obj = response;
            if($obj != "")
            {
                  alert($obj);
                  $(this).html('Delete');
            }
                showinvid();
                show();
          }
        });
    });

    $(document).on('click', '.deleteitem', function(){
      $id=$(this).val();
      $(this).html('Deleting..');
        $.ajax({
          type: "POST",
          url: "delete.php",
          data: {
            id: $id,
            delitem: 1,
          },
          success: function(response){
            $obj = response;
            if($obj != "")
            {
                  alert($obj);
                  $(this).html('Delete');
            }
                show();
          }
        });
    });

    //UPDATE
    $(document).on('click', '.updateuser', function(){
      $uid=$(this).val();
      $('#edit'+$uid).modal('hide');
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
      $uquantity=$('#uquantity'+$uid).val();
      $udiscount=$('#udiscount'+$uid).val();
      $.ajax({
          type: "POST",
          url: "update.php",
          data: {
            id: $uid,
            quantity: $uquantity,
            discount: $udiscount,
            edit: 1,
          },
          success: function(){
            show();
          }
        });
    });
  
  });
  
  function showinvid(){
    $searchid = $('#searchid').val();
    $.ajax({
      url: 'searchinvoice.php',
      type: 'POST',
      data:{
        searchid: $searchid,
      },
      success: function(response){
        $('#searchinv').html(response);
      }
    });
  }
  function show(){
    $cid=$('#searchid').val();
    $invid=$('#searchinvid').val();
    $.ajax({
      url: 'show_user.php',
      type: 'POST',
      data:{
        invid: $invid,
        cid: $cid,
        show: 1,
      },
      success: function(response){
        $('#userTable').html(response);
        $('#inv').val($invid);
      }
    });
  }
  
</script>
<style type="text/css">
  body {
       font-size: 12px;
  }
  table{
        width: 80%;
        margin: 30px auto;
        border-collapse: collapse;
        text-align: center;
  }
  tr {
        border-bottom: 1px solid purple;
  }
  th, td{
        border: none;
        height: 30px;
        padding: 5px;
  }
  tr:hover {
        background: #F5F5F5;
  }

  form {
        width: 20%;
        margin: 50px auto;
      text-align: left;
        padding: 20px; 
        border: 1px solid purple; 
        border-radius: 5px;
  }

  .input-group {
        margin: 10px 0px 10px 0px;
  }
  .input-group label {
        display: block;
        text-align: left;
        margin: 3px;
  }
  .input-group input {
      height: 30px;
        width: 93%;
        padding: 5px 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid gray;
  }
  .btn {
      padding: 10px;
        font-size: 15px;
        color: white;
        background: #5F9EA0;
        border: none;
        border-radius: 5px;
  }
  .edit_btn {

        padding: 2px 5px;
        background: #2E8B57;
        color: white;
        border-radius: 3px;
  }

  .del_btn {
    
       padding: 2px 5px;
        color: white;
        border-radius: 3px;
        background: #800000;
  }
  .msg {
       margin: 30px auto; 
       padding: 10px; 
               border-radius: 5px; 
     color: #3c763d; 
         background: #dff0d8; 
         border: 1px solid #3c763d;
           width: 50%;
         text-align: center;
  }
  @import url(http://fonts.googleapis.com/css?family=Raleway);
#cssmenu,
#cssmenu ul,
#cssmenu ul li,
#cssmenu ul li a {
  margin: 0;
  padding: 0;
  border: 0;
  list-style: none;
  line-height: 1;
  display: block;
  position: relative;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
#cssmenu:after,
#cssmenu > ul:after {
  content: ".";
  display: block;
  clear: both;
  visibility: hidden;
  line-height: 0;
  height: 0;
}
#cssmenu {
  width: auto;
  border-bottom: 3px solid #47c9af;
  font-family: Raleway, sans-serif;
  line-height: 1;
}
#cssmenu ul {
  background: #ffffff;
}
#cssmenu > ul > li {
  float: left;
}
#cssmenu.align-center > ul {
  font-size: 0;
  text-align: center;
}
#cssmenu.align-center > ul > li {
  display: inline-block;
  float: none;
}
#cssmenu.align-right > ul > li {
  float: right;
}
#cssmenu.align-right > ul > li > a {
  margin-right: 0;
  margin-left: -4px;
}
#cssmenu > ul > li > a {
  z-index: 2;
  padding: 18px 25px 12px 25px;
  font-size: 15px;
  font-weight: 400;
  text-decoration: none;
  color: #444444;
  -webkit-transition: all .2s ease;
  -moz-transition: all .2s ease;
  -ms-transition: all .2s ease;
  -o-transition: all .2s ease;
  transition: all .2s ease;
  margin-right: -4px;
}
#cssmenu > ul > li.active > a,
#cssmenu > ul > li:hover > a,
#cssmenu > ul > li > a:hover {
  color: #ffffff;
}
#cssmenu > ul > li > a:after {
  position: absolute;
  left: 0;
  bottom: 0;
  right: 0;
  z-index: -1;
  width: 100%;
  height: 120%;
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
  content: "";
  -webkit-transition: all .2s ease;
  -o-transition: all .2s ease;
  transition: all .2s ease;
  -webkit-transform: perspective(5px) rotateX(2deg);
  -webkit-transform-origin: bottom;
  -moz-transform: perspective(5px) rotateX(2deg);
  -moz-transform-origin: bottom;
  transform: perspective(5px) rotateX(2deg);
  transform-origin: bottom;
}
#cssmenu > ul > li.active > a:after,
#cssmenu > ul > li:hover > a:after,
#cssmenu > ul > li > a:hover:after {
  background: #47c9af;
}

