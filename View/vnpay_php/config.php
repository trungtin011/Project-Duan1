<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  
 $vnp_TmnCode = "X6TP291Q"; // Mã do VNPAY cung cấp
 $vnp_HashSecret = "D7NWRZQSM4E2FNLWW5QRWZRWNDNXLJOW"; // Chuỗi bí mật do VNPAY cung cấp
 $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // URL cổng thanh toán 
$vnp_Returnurl = "";
$vnp_apiUrl = "http://localhost/Project-Duan1-php/View/vnpay_php/vnpay_return.php";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";

