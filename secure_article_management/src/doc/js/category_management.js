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
          Swal.fire({
            title: "Done!",
            text: "Đã gửi yêu cầu phê duyệt",
            icon: "success"
          });
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
                    swal("Đã phê duyệt!", {
                        icon: "success",
                    });
                    setTimeout(function(){location.reload(); }, 5000);
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
        //   Swal.fire({
        //     title: "Done!",
        //     text: "Đã gửi yêu cầu phê duyệt",
        //     icon: "success"
        //   });
        window.location.href = "../doc/form-edit-chu-de.html?category_id=" + category_id +"&action=edit";
        //alert(1);
          // Send AJAX request to create a new category
        //   $.ajax({
        //         type: "POST",
        //         url: "../admin/edit_category.php",
        //         data: {
        //             name: $("#catogoryname").val(),
        //             description: $("#description").val(),
        //             //csrf_token: $("#csrf_token").val()
        //         },
        //         success: function(response) {
        //             //$("#categorytableContainer").html(response);
                    
        //         },
        //         error: function(xhr, status, error) {
        //             $("#error-message").addClass("alert-danger");
        //             $("#error-message").text("Error connecting to server. Please try again later.");
        //             $("#error-message").show();
        //         }   
        //     });
            
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