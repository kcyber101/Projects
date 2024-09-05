$(document).ready(function() {    
    $.ajax({
        type: "GET",
        url: "../admin/category_management.php",
        data: {
            //csrf_token: $("#csrf_token").val()
        },
        success: function(response) {
            $("#categorytableContainer").html(response);
        },
        error: function(xhr, status, error) {
            $("#error-message").addClass("alert-danger");
            $("#error-message").text("Error connecting to server. Please try again later.");
            $("#error-message").show();
        }   
    });
});

// Create a new category using AJAX
function saveItem() {
    Swal.fire({
        title: "Save",
        text: "Bạn chắc chắn muốn lưu chủ đề?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes"
      }).then((result) => {
        if (result.isConfirmed) {
        //   Swal.fire({
        //     title: "Done!",
        //     text: "Đã gửi yêu cầu phê duyệt",
        //     icon: "success"
        //   });
          // Send AJAX request to create a new category
          $.ajax({
                type: "POST",
                url: "../admin/create_category.php",
                data: {
                    name: $("#catogoryname").val(),
                    description: $("#description").val(),
                    //csrf_token: $("#csrf_token").val()
                },
                success: function(response) {
                    Swal.fire({ 
                        title: "Done!",
                        icon: "success"
                    });
                    setTimeout(function(){location.reload(); },1000);
                    // swal("Đã phê duyệt!", {
                    //     icon: "success",
                    // });
                    //setTimeout(function(){location.reload(); }, 000);
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

function selectEditItem(category_id) {
    Swal.fire({
        title: "Edit",
        text: "Bạn muốn chỉnh sửa chủ đề?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes"
      }).then((result) => {
        if (result.isConfirmed) {
        window.location.href = "../doc/form-edit-chu-de.html?category_id=" + category_id +"&action=edit";           
            }
      });
}


function editItembyId(category_id) {    
    $.ajax({
        type: "POST",
        url: "../admin/edit_category.php",
        data: {
            category_id: category_id,
            name: $("#catogoryname").val(),
            description: $("#description").val(),
            //csrf_token: $("#csrf_token").val()
        },
        success: function(response) {
            //
        },
        error: function(xhr, status, error) {
            $("#error-message").addClass("alert-danger");
            $("#error-message").text("Error connecting to server. Please try again later.");
            $("#error-message").show();
        }   
    });

}


function deleteItem(category_id) {
    Swal.fire({
        title: "Xóa chủ đề",
        text: "Bạn muốn xóa chủ đề này?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                type: "POST",
                url: "../admin/delete_category.php",
                data: {
                    category_id : category_id
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
