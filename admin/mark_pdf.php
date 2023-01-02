<?php include "db.php"; ?>

<?php
if (isset($_GET['view'])) {

    $id = $_GET['view'];
}
$mentorInfo = "SELECT * FROM users WHERE class = '$id'";
$mntrinfo = mysqli_query($db, $mentorInfo);

while ($row = mysqli_fetch_assoc($mntrinfo)) {

    $name = $row['name'];
    $roll = $row['roll'];
    $username = $row['username'];
}

$mentorInfo1 = "SELECT count(*) as t_count FROM users WHERE class = '$id'";
$mntrinfo1 = mysqli_query($db, $mentorInfo1);
while ($row = mysqli_fetch_assoc($mntrinfo1)) {

    $t_count = $row['t_count'];
}

?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="../student/assets/css/bootstrap.min.css" rel="stylesheet">

    <title>Esikkha</title>
    <style>
         @media print {
	 @page {
		 margin: 0;
		 size: 240mm;
		 /*width: 240mm;*/

		 
	}
	 * {
		 -webkit-print-color-adjust: exact;
		 color-adjust: exact;
	}
	#printPageButton {
    display: none;
  	}
}
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4 ">
                <h1 class="text-center bg-dribbble"><u>Welcome to Esikkha</u></h1>

                <h3 class="text-center bg-dribbble">Your overall mark sheet</h3>
                <h4 class="text-center bg-dribbble">Class: <?php echo $id; ?></h4>
                <h5 class="text-center bg-dribbble">Total student: <?php echo $t_count; ?></h5>

             
                 <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Position</th>
                            <th scope="col">Username</th>
                            <th scope="col">Roll</th>
                            <th scope="col">Totak mark</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $j = 1;
                        $usermark = mysqli_query($db, "select username,roll, sum(mark) as total from mark where class='$id' group by username order by total desc;");
                        while ($row = mysqli_fetch_assoc($usermark)) {
                        ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['roll']; ?></td>
                                <td><?php echo $row['total']; ?></td>
                            </tr>
                        <?php

                            $j++;
                        }

                        ?>
                    </tbody>
                </table>
                </div>
         </div>
    </div>
 
    <script src="../student/assets/js/bootstrap.js"></script>

    <center><button type="button" style="height:50px;  padding: 10px; width: 250px; opacity: 0.9; font-weight:bold;" class="printPageButton" id="printPageButton" onclick="window.print()">Download As PDF</button></center>
 
</body>

</html>