function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
  }
$( document ).ready(function() {
    $.ajax({
        url: urlapi,
        type: 'POST',
        data: {detect:'list_request_deposit', type_manager:'admin',limit:'100'},
        dataType: 'json',
        success: function (response) 
        {
            var output =``; 
         
            response.data.forEach(function (item) {
                output +=`
                <tr>
                    <td>${item.customer_name}</td>
                    <td>${item.request_code}</td>
                    <td>${formatNumber(item.request_value)} VND</td>
                    <td>${item.request_created}</td>
                    <td><button class="btn btn-primary btn-sm" onClick="detail_deposit(${item.id_request})" ><i class="fa fa-info"></i> Chi tiết</button></td>
                </tr> `; 
            });
          
            $('#content-deposit').html(output);
        }
    });
});

function detail_deposit(id)
{
    $.ajax({
        url: urlapi,
        type: 'POST',
        data: {detect:'list_deposit_detail' , id_request:id},
        dataType: 'json',
        success: function (response) 
        {
          
           var item = response.data[0];
           var output =`
           <div class="inqbox-content">
           <div id="contact-1" class="tab-pane active">
               <center><h3><strong>Chi tiết yêu cầu giao dịch</strong></h3></center>
          </div>
          
           <div class="tab-content" id="content-order" style="width: 100%;height: 557px;overflow: auto;">
           
           <table class="detai_deal">
                   <tr>
                       <td><p>Họ & Tên:</p></td>
                       <td><p>${item.customer_name}</p></td>
                   </tr>
                   <tr>
                       <td><p>Mã lệnh:</p></td>
                       <td><p>${item.request_code}</p></td>
                   </tr>
                   <tr>
                       <td><p>Thời gian:</p></td>
                       <td><p>${item.request_time_complete}</p></td>
                   </tr>
                   <tr> 
                       <td><p style="color:green">Nạp tiền:</p></td>
                       <td><p style="color:green">${formatNumber(item.request_value)} VND</p></td>
                   </tr>
               </table>
                <hr>
            </div>
            </div>
            `;
           var a = `<input type="text" hidden id="id_request" value="${item.id_request}">`;
           $('#id_request_text').html(a);
           $('#detail_deposit').fadeOut().html(output);
           $('#detail_deposit').fadeIn().html(output);  
        }
    });
}
function filter_payment()
{
    var favDialog = document.getElementById('filter_deposit1');
    favDialog.showModal();
}
function filter_request_deposit()
{
    var start_time = $('#start_time_request').val();
    var finish_time= $('#finish_time_request').val();
 
    $.ajax({
        url: urlapi,
        type: 'POST',
        data: {detect:'list_request_deposit', type_manager:'admin', date_begin:start_time, date_end:finish_time,limit:'100' },
        dataType: 'json',
        success: function (response) 
        {
         

           if(response.success =="false")
           {
                alert('Không tìm thấy yếu cầu !');
           }else{
            var output =``; 
            response.data.forEach(function (item) {
                output +=`
                <tr>
                    <td>${item.customer_name}</td>
                    <td>${item.request_code}</td>
                    <td> - ${item.request_value} VND</td>
                    <td>${item.request_created}</td>
                    <td><button class="btn btn-primary btn-sm" onClick="detail_deposit(${item.id_request})" ><i class="fa fa-info"></i> Chi tiết</button></td>
                </tr>`;
            });
            $('#content-deposit').html(output);
            }
        }
    });

}
function create_deposit()
{
           var output =`
           <div class="inqbox-content">
           <div id="contact-1" class="tab-pane active">
               <center><h3><strong>Tạo lệnh xác nhận nạp tiền</strong></h3></center>
          </div>
          
           <div class="tab-content" id="content-order" style="width: 100%;height: 557px;overflow: auto;">
           
           <div>
                <tr>
                    <td><p>Tên khách hàng: <a onClick="list_customer" data-toggle="modal" data-target="#request_deposit"><img src="../backend/icon_trading/chon.svg"></a></p></td>
                    <td><p><input type="text" placeholder="Tên khách hàng" class="form-control"></p></td>
                </tr>
                <tr>
                    <td><p>Số tiền nạp momo(VND):</p></td>
                    <td><p><input type="text" placeholder="40.000.00" class="form-control"></p></td>
                </tr>

            </div>
            <hr>
            </div>
            </div>
            `;
           $('#detail_deposit').fadeOut().html(output);
           $('#detail_deposit').fadeIn().html(output);  
}
function list_customer()
{
    $.ajax({
        url: urlapi,
        type: 'POST',
        data: {detect:'list_customer_customer',limit:'100' },
        dataType: 'json',
        success: function (response) 
        {
            var output =``;
            response.data.forEach(function (item) {
                output+=`
                <tr>
                    <td>Nguyễn Gia Hân</td>
                    <td>sdt</td>
                    <td>stk</td>
                    <td><input type="checkbox" class="form-control"></td>
                </tr> `;
            });
            $('#list_customer').html(output);
        }
    });
    
}
function search_customer()
{
    var  customer_fullname = $('#key_seach').val();
    var  customer_cert_no = $('#key_seach').val();
    var  customer_phone = $('#key_seach').val();
    $.ajax({
        url: urlapi,
        type: 'POST',
        data: {detect:'list_customer_customer',limit:'100',customer_fullname:customer_fullname,customer_cert_no:customer_cert_no,customer_phone:customer_phone },
        dataType: 'json',
        success: function (response) 
        {
            

        }
    });

}