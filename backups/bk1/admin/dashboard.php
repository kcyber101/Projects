<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            background-color: #343a40;
            padding: 15px;
            height: 100vh;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 10px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
            text-decoration: none;
        }
        .content {
            padding: 20px;
            margin-left: 500px;
            # tự động căn lền với sidebar
            margin-top: 60px;

            }
        .card {
            margin-bottom: 20px;
        }
        .nav-tabs .nav-link.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

    </style>
</head>
<body>

<div class="d-flex">
    <div class="sidebar">
        <h4 class="text-white">Admin Dashboard</h4>
        <a href="#" id="userListLink">Manage Users</a>
        <div id="userManagement">
            <a href="#" class="pl-3" id="userListSubLink">User List</a>
            <a href="#roleManagement" class="pl-3">Role Management</a>
        </div>
        <a href="#topicManagement" data-toggle="collapse">Manage Topics</a>
        <div id="topicManagement" class="collapse">
            <a href="#topicList" class="pl-3">Topic List</a>
            <a href="#articleStats" class="pl-3">Article Stats by Topic</a>
        </div>
        <a href="#articleManagement" data-toggle="collapse">Manage Articles</a>
        <div id="articleManagement" class="collapse">
            <a href="#createArticle" class="pl-3">Create Article</a>
            <a href="#articleList" class="pl-3">Article List</a>
            <a href="#approveArticle" class="pl-3">Approve Articles</a>
        </div>
    </div>

    <div class="content">
        <h2>Welcome to the Admin Dashboard</h2>

        <!-- User List Content -->
        <div id="userListContent" class="card">
            <div class="card-header">User List</div>
            <div class="card-body">
                <div id="userTable"></div>
            </div>
        </div>

        <!-- Other Content Sections -->
        <!-- Add other sections as needed -->
    </div>
    
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle User List Click
        $('#userListSubLink').click(function(e) {
            e.preventDefault();
            $('#userListContent').show();
            
            $.ajax({
                url: 'fetch_users.php',
                method: 'GET',
                success: function(data) {
                    $('#userTable').html(data);
                },
                error: function() {
                    $('#userTable').html('<p>An error occurred while fetching user data.</p>');
                }
            });
        });
    });
</script>

</body>
</html>
