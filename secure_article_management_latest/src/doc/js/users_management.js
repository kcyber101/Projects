$(document).ready(function() {    
        $.ajax({
            type: "GET",
            url: "../admin/user_management.php",
            data: {
                //csrf_token: $("#csrf_token").val()
            },
            success: function(response) {
                $("#usertableContainer").html(response);
            },
            error: function(xhr, status, error) {
                $("#error-message").addClass("alert-danger");
                $("#error-message").text("Error connecting to server. Please try again later.");
                $("#error-message").show();
            }   
        });
    });

function deleteItem(user_id) {
    Swal.fire({
        title: "Xóa tài khoản",
        text: "Bạn muốn xóa tài khoản này?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "../admin/delete_user.php",
            data: {
              user_id : user_id,
              csrf_token: $("#csrf_token").val()
            },
            success: function(response) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.onmouseenter = Swal.stopTimer;
                      toast.onmouseleave = Swal.resumeTimer;
                    }
                  });
                  Toast.fire({
                    icon: "success",
                    title: "Deleted successfully"
                  });                   

                setTimeout(function(){location.reload(); }, 1000);                 
            },
            error: function(xhr, status, error) {
                $("#error-message").addClass("alert-danger");
                $("#error-message").text("Error connecting to server. Please try again later.");
                $("#error-message").show();
            }   
        });
        }
      });
 
}


function approveItem(user_id) {
    Swal.fire({
        title: "Phê duyệt",
        text: "Cho phép người dùng này hoạt động",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Đồng ý"
      }).then((result) => {
        if (result.isConfirmed) {

              $.ajax({
                type: "POST",
                url: "../admin/approve_user.php",
                data: {
                  user_id: user_id,
                  csrf_token: $("#csrf_token").val()
                },
                success: function(response) {
                  const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.onmouseenter = Swal.stopTimer;
                      toast.onmouseleave = Swal.resumeTimer;
                    }
                  });
                  Toast.fire({
                    icon: "success",
                    title: "Approved successfully"
                  }); 
                    setTimeout(function(){location.reload(); }, 1000);
                },
                error: function(xhr, status, error) {
                    $("#error-message").addClass("alert-danger");
                    $("#error-message").text("Error connecting to server. Please try again later.");
                    $("#error-message").show();
                }   
            });
            
            }
          });
    // wait for 5 secs(2) then reload the page.(3)
    //setTimeout(function(){location.reload(); }, 5000);
}

function editItem(userid) {
    (async () => {
        const { value: role } = await Swal.fire({
          title: "Phân quyền",
          input: "select",
          inputOptions: {
            editor: "Biên tập viên",
            admin: "Quản trị",
            author: "Tác giả"
          },
          inputPlaceholder: "Select a role",
          showCancelButton: true,
          inputValidator: (value) => {
            return new Promise((resolve) => {
              if (getCookie('role') === 'admin') {
                // Send AJAX request update to role of user with userid 
                // and role
                // then reload the page
                // and show a success message
                // else show an error message
                $.ajax({
                    type: "POST",
                    url: "../admin/edit_role.php",
                    data: {
                        user_id: userid,
                        role: value,
                        csrf_token: $("#csrf_token").val(),
                    },
                    success: function(response) {
                        if (response === "true") {
                            Swal.fire({
                                title: "Thành công",
                                text: "Phân quyền thành công",
                                icon: "success"
                              });
                              setTimeout(function(){location.reload(); }, 3000);
                        } else {
                            Swal.fire({
                                title: "Thất bại",
                                text: " Phân quyền thất bại",
                                icon: "error"
                              });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: "Thất bại",
                            text: "",
                            icon: "error"
                          });
                    }
                });

                resolve();
              } else {
                resolve("Bạn cần quyền quản trị viên :)");
              }
            });
          }
        });
      })();
}



function getCookie(cname) {
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}