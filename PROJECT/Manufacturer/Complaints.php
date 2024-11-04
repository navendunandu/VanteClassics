<?php
include("../Assets/Connection/connection.php");
session_start();
ob_start();
include("Head.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <style>
        /* Styling the table container */
        .complaint-table-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        /* Styling the table */
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px; /* Rounded corners */
            overflow: hidden; /* Rounded corners effect */
        }

        /* Table header styling */
        th {
            background-color: #6c7ae0;
            color: white;
            text-align: center;
        }

        /* Table cell padding */
        td, th {
            padding: 15px;
            text-align: center;
        }

        /* Image styling */
        .complaint-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }

        /* Link styling */
        a {
            color: #6c7ae0;
        }

        /* Hover effect on rows */
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<div class="container complaint-table-container">
    <h2 class="text-center mb-4">Complaints Table</h2>
    <form id="form1" name="form1" method="post" action="">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Sl No.</th>
                        <th>Date</th>
                        <th>User</th>
                        <th>Product</th>
                        <th>File</th>
                        <th>Description</th>
                        <th>Reply</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=0;
                    $selQry="select*from tbl_manufacturer m inner join tbl_product p on m.manufacturer_id=p.manufacturer_id inner join tbl_complaint c on c.product_id=p.product_id inner join tbl_user u on c.user_id=u.user_id where m.manufacturer_id=".$_SESSION['mid'];
                    $result=$Con->query($selQry);
                    while($row=$result->fetch_assoc()) {
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row['complaint_date'] ?></td>
                        <td><?php echo $row['user_name'] ?></td>
                        <td><?php echo $row['product_name'] ?></td>
                        <td><img src="../Assets/Files/User/Complaint/<?php echo $row['complaint_file'];?>" class="complaint-img" /></td>
                        <td><?php echo $row['complaint_content'] ?></td>
                        <td><a href="Reply.php?cid=<?php echo $row['complaint_id'] ?>">Reply</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>