@extends('admin.dashboard')
@section('admin_content')
<style>
    .detail_cus{
        width: 100%;
        height: 60px;border-radius: 4%
    }
    .detail_cus td:nth-child(1),.detail_cus td:nth-child(3){
        background-color:orange;
        width: 45%  ;
        text-align: center;
    }
</style>
   <body>
    {{-- <?php $idbussin = Auth::user()->id_business;
    ?> --}}
    <div style="clear: both; height: 61px;"></div>
    <div class="wrapper wrapper-content animated fadeInRight">
         <div class="row">
            <div class="col-sm-8">
               <div class="inqbox">
                  <div class="inqbox-content">
                        <span class="text-muted small pull-right"><a data-toggle="modal" data-target="#create_customer" ><img src="{{asset ('backend/icon_trading/plus.svg')}}"></a></span>
                           <h2><strong>Danh sách khách hàng</strong></h2>
                           <div class="input-group">
                              <input type="text" placeholder="Nhập tên, số điện thoại, email, mã khách hàng" id="key_seach" value="" class="input form-control">
                              <span class="input-group-btn">
                              <button type="button" class="btn btn btn-primary" onclick="seach_customer()"> <i class="fa fa-search"></i> Tìm kiếm</button>
                              </span>
                           </div>
                           <div class="clients-list">
                              <div class="tab-content" >

                                 <div id="tab-account" class="tab-pane active" >
                                    <div class="full-height-scroll">
                                       <div class="table-responsive">
                                          <table class="table table-striped table-hover">
                                            <tr>
                                                <th style="width:2%;"></th>
                                                <th>Tên Khách hàng</th>
                                                <th>Số điện thoại</th>
                                                <th>Số tài khoản ATM</th>
                                            
                                                <th style="width:18%;">Hành động</th>
                                                
                                            </tr>
                                             <tbody id="content-customer">
                                                <tr>
                                                    <th style="width:2%;"></th>
                                                    <td>Nguyen Van A</td>
                                                    <td>0336819000</td>
                                                    <td>6555565644646</td>
                                                  

                                                    <td><button type="button"  class="btn btn-secondary btn-sm"><i class="fa fa-history"></i></button> &nbsp <button type="button" data-toggle="modal" data-target="#detail_customer" class="btn btn-secondary btn-sm"><i class="fa fa-pencil-square"></i></button></td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                  </div>
               </div>
            </div>
            <div class="col-sm-4">
                <div class="inqbox ">
                   <div class="inqbox-content"><div id='content_detail_customer'>
                    <div id="contact-1" class="tab-pane active">
                        <h3>Nguyễn Van A</h3>
                        <h4>Số điện thoại: 0336819000</h4>
                        <h4>Giao dịch gần nhất: 05/02/2021</h4>
                        <hr>
                        
                            <h4></h4>
                            <input type="date" style="height :30px ;width:45% ;" id="ngaybatdau" onchange="seach_order()"> >>
                            <input type="date" style="height :30px ;width:45% ;" id="ngayketthuc" onchange="seach_order()">
                            <hr>
                   </div>
                    <div class="tab-content" id="content-order" style="width: 100%;height: 510px;overflow: auto;">
                        <div>
                            <tr>
                                <td> <strong> 15/03/2001 - 20:21 &nbsp&nbsp </strong></td>
                                <td> <img src="{{asset ('backend/icon_trading/up.svg')}}"></td>
                            </tr>
                            <tr>
                                <td><strong>Số tiền: </strong></td>
                                <td><strong style="color:red">+450,000,000</strong></td>
                            </tr>
                        </div>
                        <hr>
                        <div>
                            <tr>
                                <td><strong>15/03/2001 - 20:21 &nbsp&nbsp  </strong></td>
                                <td> <img src="{{asset ('backend/icon_trading/down.svg')}}"></td>
                            </tr>
                            <tr>
                                <td><strong>Số tiền: </strong></td>
                                <td><strong style="color:green">-450,000,000</strong></td>
                            </tr>
                        </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>

{{--  Model_detail_customer  --}}
        <div id="detail_customer" class="modal fade">
            <div class="modal-dialog">
             <div class="modal-content">
              <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <center><h2 class="modal-title"style="color:black"><strong>Chi tiết khách hàng</strong></h2></center>
              </div>
              <div class="modal-body">

               <form id="insert_customer_form">
                {{ csrf_field() }}
                <label>Tên khách hàng (<font style="color: red">*</font>)</label>
                <input type="text" name="customer_name" id="customer_name" class="form-control" />
                <small id="ercustomer_name" class="text-danger"></small>
                <br />

                <label>Mã khách hàng: </label>
                <input type="text" value="KH3215646" readonly id="customer_name" class="form-control" />
                <br />
                <label>Số điện thoại: </label>
                <input type="text" value="0123456789" readonly id="customer_name" class="form-control" />
                <br />
                <label>Số CMND: </label>
                <input type="text" value="26264587799" readonly id="customer_name" class="form-control" />
                <br />
    
                <label>Mã giới thiệu: </label>
                <input type="tel" id="customer_phone" name="customer_phone" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="KT_sodienthoai(this.value)" maxlength="10" class="form-control">
                <small id="ercustomer_phone" class="text-danger"></small>
                <br />

                <label>Hình CMND mặt trước: </label>
                <input type="file" name="customer_email" id="customer_email" class="form-control" />
                <small id="ercustomer_email" class="text-danger"></small>
           
                <hr/>
                <center><h2 style="color:black"><strong>Phương thức thanh toán</strong></h2></center>
                <br />
                <label>Tên ngân hàng: </label> <input type="button" class="btn btn-success btn-sm" value="Chọn">
                <input type="text" name="customer_email" id="customer_email" class="form-control" />
                <small id="ercustomer_email" class="text-danger"></small>
                <br />
                <label>Số tài khoản: </label>
                <input type="text" name="customer_email" id="customer_email" class="form-control" />
                <small id="ercustomer_email" class="text-danger"></small>
                <br />
                <label>Tên chủ thẻ: </label>
                <input type="text" name="customer_email" id="customer_email" class="form-control" />
                <small id="ercustomer_email" class="text-danger"></small>
                <br />
                <label>Hỉnh ảnh thẻ ATM mắt trước: </label>
                <input type="file" name="customer_email" id="customer_email" class="form-control" />
                <small id="ercustomer_email" class="text-danger"></small>
                <br />
                <br />
                <input type="submit" name="insert" id="insert_customer" value="Thêm" class="btn btn-success" />
               </form>
              </div>
              <div class="modal-footer">
               <button type="button" id="close_modol_insert" class="btn btn-default" data-dismiss="modal">Đóng</button>
              </div>
             </div>
            </div>
           </div>
{{--  -------------------------------------------------------------  --}}
{{--  Model_creat_customer  --}}
        <div id="create_customer" class="modal fade">
            <div class="modal-dialog">
             <div class="modal-content">
              <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <center><h2 class="modal-title"style="color:black"><strong>Tạo mới</strong></h2></center>
              </div>
              <div class="modal-body">

               <form id="insert_customer_form">
                {{ csrf_field() }}
                <label>Tên khách hàng (<font style="color: red">*</font>)</label>
                <input type="text" name="customer_name" id="customer_name" class="form-control" />
                <small id="ercustomer_name" class="text-danger"></small>
                <br />

                <label>Mã khách hàng: </label>
                <input type="text" id="customer_name" class="form-control" />
                <br />
                <label>Số điện thoại: </label>
                <input type="text" id="customer_name" class="form-control" />
                <br />
                <label>Số CMND: </label>
                <input type="text" id="customer_name" class="form-control" />
                <br />
    
                <label>Mã giới thiệu: </label>
                <input type="tel" id="customer_phone" name="customer_phone" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="KT_sodienthoai(this.value)" maxlength="10" class="form-control">
                <small id="ercustomer_phone" class="text-danger"></small>
                <br />

                <label>Hình CMND mặt trước: </label>
                <input type="file" name="customer_email" id="customer_email" class="form-control" />
                <small id="ercustomer_email" class="text-danger"></small>
           
                <hr/>
                <center><h2 style="color:black"><strong>Phương thức thanh toán</strong></h2></center>
                <br />
                <label>Tên ngân hàng: </label> <input type="button" class="btn btn-success btn-sm" value="Chọn">
                <input type="text" name="customer_email" id="customer_email" class="form-control" />
                <small id="ercustomer_email" class="text-danger"></small>
                <br />
                <label>Số tài khoản: </label>
                <input type="text" name="customer_email" id="customer_email" class="form-control" />
                <small id="ercustomer_email" class="text-danger"></small>
                <br />
                <label>Tên chủ thẻ: </label>
                <input type="text" name="customer_email" id="customer_email" class="form-control" />
                <small id="ercustomer_email" class="text-danger"></small>
                <br />
                <label>Hỉnh ảnh thẻ ATM mắt trước: </label>
                <input type="file" name="customer_email" id="customer_email" class="form-control" />
                <small id="ercustomer_email" class="text-danger"></small>
                <br />
                <br />
                <input type="submit" name="insert" id="insert_customer" value="Thêm" class="btn btn-success" />
               </form>
              </div>
              <div class="modal-footer">
               <button type="button" id="close_modol_insert" class="btn btn-default" data-dismiss="modal">Đóng</button>
              </div>
             </div>
            </div>
           </div>
{{--  -------------------------------------------------------------  --}}

    </div>


    </body>
    <script src="{{ asset('backend/js/jquery-3.5.0.min.js') }}"></script>
    <script src="{{ asset('backend/js/admin/admin_local.js') }}"></script>
    <script src="{{ asset('backend/js/admin_han/admin_customer.js') }}"></script>
@endsection
