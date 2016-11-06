
<html>
  <head>
  <link rel="stylesheet" type="text/css" href="menu.css"/>
  <link rel="stylesheet" type="text/css" href="table.css"/> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>   
  </head>
  <title>-------::: CodeIS :::BookStore - Webservice -------</title>
  <body>
  <br>
  <center><h1> Search Book </h1></center>
    <nav id="primary_nav_wrap">
<ul>
  <li class="current-menu-item"><a>CodeIS</a></li>
  <li><a>Service</a>
    <ul>
      <li><a href="/Webservice/addNewBook.php">Create A new Book </a></li>
      <li><a href="/Webservice/DeleteBook.php">Remove Book </a></li>
      <li><a href="/Webservice/EditBook.php">Edit Book</a></li>
    </ul>
  </li>
  <li><a href="/Webservice/Server.php">Web Server</a></li>
  <li><a href="/Webservice/Contact.php">Contact Us</a></li>
</ul>
<br><br>
  </nav>
<div align="right">
  Search : &nbsp <input id="key" name="key"></input>
</div>
<div id="table" ></div>
<script>  
    $(document).ready(function(){ 
      $(document).on('click', '#btn_add', function(){  
          var catagory = $('#from_catagory').text();  
          var title = $('#from_title').text(); 
          var author = $('#from_author').text();  
          var publisher = $('#from_publisher').text();
          var publish_date = $('#from_publish_date').text();  
          var type = $('#from_type').text(); 
          var price = $('#from_price').text();   
          if(catagory == '') {  
                alert("Enter Catagory !");  
                return false;  
          }  
          if(title == '') {  
                alert("Enter Title !");  
                return false;  
          }
          if(author == '') {  
                alert("Enter Author !");  
                return false;  
          }  
          if(publisher == '') {  
                alert("Enter Publisher !");  
                return false;  
          } 
          if(publish_date == '') {  
                alert("Enter Publish_date !");  
                return false;  
          }  
          if(type == '') {  
                alert("Enter Type !");  
                return false;  
          }  
          if(price == '') {  
                alert("Enter Price !");  
                return false;  
          }
          $.ajax({  
                url:"T_Add.php",  
                method:"POST",  
                data:{from_catagory:catagory ,from_title:title, from_author:author,from_publisher:publisher,from_publish_date:publish_date,from_type:type,from_price:price},  
                dataType:"text",  
                success:function(data)  
                {  
                    alert(data); 
                    fetch_data()   
                       
                }  
           })       
      });
      var SKey = "";
      $(document).change(function() {
          var searchK = $('#key').val();
          SKey = searchK;
          $.ajax({  
                url:"T_Search.php",  
                method:"POST",  
                data:{key:searchK},  
                dataType:"text",
                success:function(data){ 
                    $('#table').html("");
                    $('#table').html(data);
                    console.log(data);
                }  
           });  
      });
      function fetch_data()  
      {  
           $.ajax({  
                url:"T_Search.php",  
                method:"POST",  
                data:{key:SKey},  
                dataType:"text",
                success:function(data){
                     $('#table').html("");  
                     $('#table').html(data);  
                }  
           });  
      }  
      $(document).on('click', '.btn_delete', function(){  
           var title = $(this).data("id7");  
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                     url:"T_Delete.php",  
                     method:"POST",  
                     data:{id:title},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);
                          fetch_data()    
                    }  
                });  
           }  
      });
      function edit_data(id, text, column_name)  {  
           $.ajax({  
                url:"T_Edit.php",  
                method:"POST",  
                data:{id:id, text:text, column_name:column_name},  
                dataType:"text",  
                success:function(data){  
                    alert(data);
                    fetch_data()
                        
                }  
           });  
      }  
      $(document).on('blur', '.from_catagory', function(){  
           var id = $(this).data("id2");  
           var catagoryV= $(this).text();
           edit_data(id, catagoryV, "catagory"); 
      }); 
      $(document).on('blur', '.from_author', function(){  
           var id = $(this).data("id3");  
           var authorV = $(this).text();  
           edit_data(id,authorV, "author");
      }); 
      $(document).on('blur', '.from_publisher', function(){  
           var id = $(this).data("id4");
           var publisherV = $(this).text();  
           edit_data(id,publisherV, "publisher");  
      });
                
    });
</script>

</body>
</html>