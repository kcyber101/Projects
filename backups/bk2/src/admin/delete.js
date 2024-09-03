
document.addEventListener('DOMContentLoaded', function () {
    const deleteLinks = document.querySelectorAll('a[href*="delete_"]');
    
    deleteLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            if (!confirm('Bạn có chắc chắn muốn xoá không?')) {
                event.preventDefault();
            }
        });
    });
});

