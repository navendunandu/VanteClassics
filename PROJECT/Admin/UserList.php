<?php
include("../Assets/Connection/connection.php");
ob_start();
include("Head.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Table Card -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">User List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Sl No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Place</th>
                                            <th>District</th>
                                            <th>Photo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $SelQry = "SELECT * FROM tbl_user u 
                                                       INNER JOIN tbl_place p ON u.place_id=p.place_id 
                                                       INNER JOIN tbl_district d ON p.district_id=d.district_id";
                                            $result = $Con->query($SelQry);
                                            $i = 0;
                                            while ($row = $result->fetch_assoc()) {
                                                $i++;
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['user_email']); ?></td>
                                            <td><?php echo htmlspecialchars($row['user_contact']); ?></td>
                                            <td><?php echo htmlspecialchars($row['user_address']); ?></td>
                                            <td><?php echo htmlspecialchars($row['place_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['district_name']); ?></td>
                                            <td>
                                                <img src="../Assets/Files/User/Photo/<?php echo $row['user_photo']; ?>" 
                                                     alt="User Photo" class="img-fluid" style="max-width: 100px;"/>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
            include("Foot.php");
            ob_flush();
            ?>