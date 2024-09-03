$(document).ready(function() {    
    $.ajax({
        type: "GET",
        url: "../admin/article_management.php",
        data: {
            //csrf_token: $("#csrf_token").val()
        },
        success: function(response) {
            $("#articletableContainer").html(response);
            $('#sampleTable').DataTable();
        },
        error: function(xhr, status, error) {
            $("#error-message").addClass("alert-danger");
            $("#error-message").text("Error connecting to server. Please try again later.");
            $("#error-message").show();
        }   
    });
});

function approveItem(article_id) {
    Swal.fire({
        title: "Phê duyệt",
        text: "Bạn đã kiểm duyệt nội dung này",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Đồng ý"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Approved!",
            text: "Bài viết này đã được phê duyệt",
            icon: "success"
          });
              $.ajax({
                type: "POST",
                url: "../admin/approve_article.php",
                data: {
                    article_id: article_id,
                    csrf_token: $("#csrf_token").val()
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
    // wait for 5 secs(2) then reload the page.(3)
    //setTimeout(function(){location.reload(); }, 5000);
}


function saveItem(article_id) {
    Swal.fire({
        title: "Save",
        text: "Bạn chắc chắn muốn lưu bài viết?",
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
                url: "../admin/edit_article.php",
                data: {
                    article_id: article_id,
                    title: $("#titleArticle").val(),
                    content: CKEDITOR.instances.mota.getData(),
                    category_id: $('select option').filter(':selected').val(), 
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

function selectEditItem(article_id) {
    Swal.fire({
        title: "Edit",
        text: "Bạn muốn chỉnh sửa bài viết?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes"
      }).then((result) => {
        if (result.isConfirmed) {
                window.location.href = "../doc/form-edit-bai-viet.html?article_id=" + article_id +"&action=edit_article";            
            }
      });
}