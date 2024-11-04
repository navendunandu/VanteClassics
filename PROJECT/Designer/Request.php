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
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border: 1px solid #dee2e6;
        }

        th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
        }

        td img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer; /* Change cursor to indicate clickable */
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: #6c7ae0;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .table-container {
            padding: 20px;
        }

        /* Adjust modal size */
        .modal-dialog {
            max-width: 600px; /* Smaller max-width for the modal */
            width: 80%; /* Make it responsive */
            margin: auto; /* Center modal */
        }

        /* Adjust modal image size */
        .modal-body img {
            max-width: 100%; /* Ensure it fits inside modal */
            height: auto; /* Maintain aspect ratio */
        }

        /* Reduce modal header size */
        .modal-header {
            padding: 5px 5px; /* Less padding for a smaller header */
        }

        /* Add margin to modal body */
        .modal-body {
            padding: none; /* Less padding around the image */
            margin-right: 0px;
            margin-top: 5px; /* Add space above the image */
        }

        /* Adjust modal max height and overflow */
        .modal-content {
            max-height: 500px; /* Set max height to reduce overall height */
            overflow-y: auto; /* Allow scrolling if content exceeds height */
        }

        /* Make modal overlay above other elements */
        .modal-backdrop {
            z-index: 1040 !important; /* Ensure backdrop is above header */
        }

        .modal {
            z-index: 1050 !important; /* Ensure modal is above header */
        }
    </style>
</head>

<body>

<div class="container mt-5 table-container">
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Sl No.</th>
                <th>Date</th>
                <th>Material</th>
                <th>Color</th>
                <th>Category</th>
                <th>Custom Message</th>
                <th>Photo</th>
                <th>Feedback</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $SelQry = "select * from tbl_request r inner join tbl_assign a on r.request_id=a.request_id inner join tbl_material m on r.material_id=m.material_id inner join tbl_color c on r.color_id=c.color_id inner join tbl_category ct on r.category_id=ct.category_id where a.designer_id=" . $_SESSION['did'];
        $result = $Con->query($SelQry);
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['assign_date'] ?></td>
                <td><?php echo $row['material_name'] ?></td>
                <td><?php echo $row['color_name'] ?></td>
                <td><?php echo $row['category_name'] ?></td>
                <td><?php echo $row['request_content'] ?></td>
                <td>
                    <img src="../Assets/Files/User/CustomDesign/<?php echo $row['request_file']; ?>" alt="Custom Design" data-toggle="modal" data-target="#photoModal<?php echo $i; ?>"/>
                </td>
                <td><?php echo $row['assign_msg'] ?></td>
                <td>
                    <?php if ($row['assign_status'] == 0) { ?>
                        <a href="AddImage.php?aid=<?php echo $row['assign_id'] ?>">Add Design</a>
                    <?php } elseif ($row['assign_status'] == 3) { ?>
                        <a href="AddImage.php?aid=<?php echo $row['assign_id'] ?>">Add Revised Design</a>
                    <?php } elseif ($row['assign_status'] >= 1) { ?>
                        <img src="../Assets/Files/Designer/Custom/<?php echo $row['assign_image'] ?>" alt="Design Image" width="100" height="100"/>
                    <?php } ?>
                </td>
            </tr>

            <!-- Modal for enlarged photo -->
            <div class="modal fade" id="photoModal<?php echo $i; ?>" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered"> <!-- Added class for vertical centering -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="../Assets/Files/User/CustomDesign/<?php echo $row['request_file']; ?>" alt="Custom Design" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>