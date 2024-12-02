<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #b3d9ff; /* Light blue background */
            display: block;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 3%;
            }
        table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #ddd;
        }

        th, td {
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
        }

        th {
            text-align: center;
            background-color: #ffcc80;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;   
        }

        td:nth-child(2),
        td:nth-child(3),
        td:nth-child(4) 
        {
            padding-left: 20px;
            padding-right: 20px;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    
    <div class="tableClass">
        <a href="index.php">Back</a>
        <h1>Search History:</h1>
        <table style="width:100%; margin-top: 30px; text-align: center; background-color: #F1EBDA;">
            <tr>
                <th style="background-color: #FAD5D5;">Search History ID</th>
                <th style="background-color: #FAD5D5;">Search Query</th>
                <th style="background-color: #FAD5D5;">Username</th>
                <th style="background-color: #FAD5D5;">Date Searched</th>
            </tr>
            <?php 
            $getSearchHistory = getSearchHistory($pdo); 
            foreach ($getSearchHistory as $row) { ?>
            <tr>
                <td><?php echo $row['search_id']; ?></td>
                <td><?php echo $row['keyword']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['date_searched']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>