<!DOCTYPE html>
<html lang="en">
  <head>  
    <meta charset="UTF-8">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//rawgit.com/botmonster/jquery-bootpag/master/lib/jquery.bootpag.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <title>Test2</title>
  </head>
  <body>
  
          <div class="col-sm-6">
              <h3>ใบกำกับภาษี</h3>
              <form name="searchText" id="searchText" method="POST" >
                  <input type="text" id="keyword" name="keyword" class="form-control" placeholder="ค้นหา.."/><br>
                  <input type="submit" id="submit" name="submit" value="ค้นหา" class="btn btn-success"/>
              </form>
          </div>
              <div class="text-center">
                <table class="table" id="invoiceTable"> 
                      <thead class="bg-primary text-light">
                          <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Invoice Number</th>                         
                            <th class="text-center">Name</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Telephone</th>
                            <th class="text-center">Email</th>
                          </tr>
                          
                      </thead>
                      <tbody>

                      </tbody>
                  </table>
                  <div id="show_pagination"></div>
                  <div id="totalPages"></div>
            </div>
          <!-- การส่งข้อมูลด้วย AJAX เพื่อค้นหา ไปที่ไฟล์ search_result.php-->
    <script>
      $(function(){
// เริ่มต้นให้โหลดข้อมูลทั้งหมดออกมาแสดง โดยเรียกฟังก์ชัน all_users()
            all_users();
          function all_users() {
              $.ajax({ 
                        url: 'all_user.php',
                        type: 'GET', 
                        dataType: 'json',
                        success: function(data){
                                // กำหนดตัวแปรเก็บโครงสร้างแถวของตาราง
                                var trstring ="";
                                // ตัวแปรนับจำนวนแถว
                                var countrow = 1;

                                // วนลูปข้อมูล JSON ลงตาราง
                                $.each(data, function(key, value){
                                    // แสดงค่าลงในตาราง
                                    trstring += `
                                    <tr> 
                                        <td class="text-center"><button> + </button></td>
                                        <td class="text-center">${value.invoice_number}</td>
                                        <td class="text-center">${value.name}</td>
                                        <td class="text-center">${value.address}</td>
                                        <td class="text-center">${value.telephone}</td>
                                        <td class="text-center">${value.email}</td>      
                                    </tr>`;
                                    $('table tbody').html(trstring);
                                    countrow++;
                        });
                    }
                });
          }

         $('#searchText').submit(function(e) {
               e.preventDefault();
                // รับค่าจากฟอร์ม
                let keyword = $("#keyword").val();
                let data = {}; 
                    data["keyword"] = keyword;
                let json = JSON.stringify(data);
                // ส่งค่าไป search_result.php ด้วย jQuery Ajax
                $.ajax({
                    url: 'search_result.php',
                    type: 'POST',
                    dataType: 'json',
                    data: { json: json },
                    success: function(data){
                        if(data.length != 0){
                              // กรณีมีข้อมูล
                            // กำหนดตัวแปรเก็บโครงสร้างแถวของตาราง
                            let trstring ="";

                            // ตัวแปรนับจำนวนแถว
                            let countrow = 1;

                            // วนลูปข้อมูล JSON ลงตาราง
                            $.each(data, function(key, value){
                                // แสดงค่าลงในตาราง
                                trstring += `
                                    <tr>
                                        <td class="text-center">${value.invoice_number}</td>
                                        <td class="text-center">${value.name}</td>
                                        <td class="text-center">${value.address}</td>
                                        <td class="text-center">${value.telephone}</td>
                                        <td class="text-center">${value.email}</td>
                                    </tr>`;
                                $('table tbody').html(trstring);
                                countrow++;
                            });
                        }else{
                            alert('ไม่พบข้อมูลที่ค้นหา');
                        }
                    }
                });
            });
            // function createPagination(curr, page) {
                    $('#show_pagination').bootpag({
                    total: 22,
                    page: 1,
                    maxVisible: 10
                    }).on('page', function(e, num){

                    //     let keyword = $("#keyword").val();
                    //     all_users(keyword,num);
                    });
            // }
      });
    </script>  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>