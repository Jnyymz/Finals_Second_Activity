<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
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
        <h1>All Users of PH Hospital's System:</h1>
		<table >
		<tr>
			<th style="background-color: #FAD5D5;">Username</th>
			<th style="background-color: #FAD5D5;">User ID</th>
		</tr>
			<?php $getAllUsers = getAllUsers($pdo); ?>
			<?php foreach ($getAllUsers as $row) { ?>
			<tr>
				<td><?php echo $row['username']; ?></td>
				<td><?php echo $row['user_id']; ?></td>
			</tr>
			<?php } ?>
		</table>
</body>
</html>