function validate() {
    var _0x9903x2 = document.getElementById("username").value;
    var _0x9903x3 = document.getElementById("password-field").value;
    
    // regex strong password
    var _0x9903x9 = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$/;    

    // regrex exception characters
    var _0x9904x1 = /[&<>"`'-;\/]/;

    // Check username
    if (_0x9904x1.test(_0x9903x2)) {
      swal({title: "", text: "Tên người dùng chứa ký không hợp lệ", icon: "error", close: true, button: "Thử lại"});
      return false;
    };

    // Check registration password
    if (document.getElementById("confirm-password")){
        var _0x9903x4 = document.getElementById("confirm-password").value;
            
        if (_0x9903x3 != _0x9903x4) {
          swal({title: "", text: "Mật khẩu không trùng nhau...", icon: "error", close: true, button: "Thử lại"});
          return false;
        }

        if (!_0x9903x9.test(_0x9903x4)) {
            swal({title: "", text: "Mật khẩu yếu!", icon: "error", close: true, button: "Thử lại"});
            return false;
          }
        // Handle Ajax registration
        //register();

    }
    ;

    if (_0x9903x2 == "" && _0x9903x3 == "") {
      swal({title: "", text: "Bạn chưa điền đầy đủ thông tin đăng nhập...", icon: "error", close: true, button: "Thử lại"});
      return false;
    }
    ;
    if (_0x9903x2 != null && _0x9903x3 == "") {
      swal({title: "", text: "Bạn chưa nhập mật khẩu...", icon: "warning", close: true, button: "Thử lại"});
      return false;
    }
    ;
    if (_0x9903x2 == null || _0x9903x2 == "") {
      swal({title: "", text: "Tài khoản đang để trống...", icon: "warning", close: true, button: "Thử lại"});
      return false;
    }
    ;
    if (_0x9903x3 == null || _0x9903x3 == "") {
      swal({title: "", text: "Mật khẩu đang để trống...", icon: "warning", close: true, button: "Thử lại"});
      return false;
     } 

    // Handle login

    return true;
  }
  
  function RegexEmail(_0x9903x5) {
    var _0x9903x6 = document.getElementById(_0x9903x5).value;
    var _0x9903x7 = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    var _0x9903x8 = _0x9903x7.test(_0x9903x6);
    if (!_0x9903x8) {
      swal({title: "", text: "Bạn vui lòng nhập đúng định dạng email...", icon: "error", close: true, button: "Thử lại"});
      _0x9903x5.focus;
    } 
    // else {
    //   swal({title: "", text: "Chúng tôi vừa gửi cho bạn email hướng dẫn đặt lại mật khẩu vào địa chỉ cho bạn", icon: "success", close: true, button: "Đóng"});
    //   _0x9903x5.focus;
    //   window.location = "#";
    // }
  }

//   let total = 0;
//   for (let i = 0; i < 10; i++) {
//     total += i;
//   }
//   console.log("Total: " + total);

function register(){
    $(document).ready(function() {
        $("#submit").click(function(e) {
            e.preventDefault();
     
             $.ajax({
                type: "POST",
                url: "./users/register.php",
                data: {
                 username: $("#username").val(),
                 email: $("#emailInput").val(),
                 password: $("#password-field").val(),
                 confirm_password: $("#confirm-password").val(),
                 csrf_token: $("#csrf_token").val()
              },
                success: function(response) {
                    if (response == 'true') {
                         // Login successful, you can redirect or perform other actions
                      //$("#login_form").fadeOut("normal");
                      setTimeout('window.location.href = "./login.php";',1000);
                   } 
                },
    
                error: function(xhr, status, error) {
                   $("#error-message").addClass("alert-danger");
                   $("#error-message").text("Error connecting to server. Please try again later.");
                   $("#error-message").show();
                 }
             });

            
             //return false;
         });

        return false;
     });
}


function login(){
    
    $(document).ready(function() {
        $("#submit").click(function(e) {
            e.preventDefault();
            if (validate()) {
                $.ajax({
                    type: "POST",
                    url: "./users/login.php",
                    data: {
                     username: $("#username").val(),
                     password: $("#password-field").val(),
                     csrf_token: $("#csrf_token").val()
                  },
                    timeout: 3000,
                    cache: false,
                    success: function(response) {
                        if (response == 'true') {
                            // Login successful, you can redirect or perform other actions
                            //$("#login_form").fadeOut("normal");
                          setTimeout('window.location.href = "./doc/index.html";',1000);
                       } else {
                           // Login failed, show error message
                          $("#error-message").addClass("alert-danger");
                          $("#error-message").text(response);
                          $("#error-message").show();
                          //$('#login_form').find('input').val('')
                       }
                    },
        
                    error: function(xhr, status, error) {
                       $("#error-message").addClass("alert-danger");
                       $("#error-message").text("Error connecting to server. Please try again later.");
                       $("#error-message").show();
        
                     }
                 });
                
                 return false;
            }
        });

     });

}


