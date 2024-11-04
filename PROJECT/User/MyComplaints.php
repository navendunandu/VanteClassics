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
<title>Untitled Document</title>
<style>
        /* General form container styling */
        .complaint-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
            min-height: 80vh;
        }

        /* Card styling */
        .card {
            width: 100%;
            max-width: 1000px; /* Limits the table width */
            padding: 20px;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Slight shadow for elevation */
        }

        /* Table styling */
        .table-responsive {
            margin-top: 20px;
        }

        .table {
            width: 100%;
        }

        .table img {
            width: 100px;
            height: auto;
        }

        /* Heading styling */
        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>
<div class="container complaint-container">
    <div class="card">
        <h2>Complaint List</h2>
        <form id="form1" name="form1" method="post" action="">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">Complaint</th>
                            <th scope="col">Product</th>
                            <th scope="col">File</th>
                            <th scope="col">Reply</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $selQry = "select * from tbl_complaint c inner join tbl_product p on c.product_id=p.product_id where c.user_id=" . $_SESSION['uid'];
                        $result = $Con->query($selQry);
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                        ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row['complaint_content'] ?></td>
                                <td><?php echo $row['product_name'] ?></td>
                                <td><img src="../Assets/Files/User/Complaint/<?php echo $row['complaint_file']; ?>" alt="Complaint File"/></td>
                                <td>
                                    <?php
                                    if ($row['complaint_status'] == 0) {
                                        echo "Your complaint is not reviewed yet";
                                    } else if ($row['complaint_status'] == 1) {
                                        echo $row['complaint_reply'];
                                    }
                                    ?>
                                </td>
                                <td><?php echo $row['complaint_date'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>