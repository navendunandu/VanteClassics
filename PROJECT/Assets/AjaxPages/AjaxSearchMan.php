<table class="table table-borderless" align="center">
    <tr>
        <?php
        include('../Connection/Connection.php');
        $txt = $_GET['txt'];
        $dis = $_GET['dis'];
        $place = $_GET['place'];

        $selQry = "SELECT * FROM tbl_manufacturer m 
                   INNER JOIN tbl_place p ON m.place_id = p.place_id 
                   INNER JOIN tbl_district d ON p.district_id = d.district_id";
        if ($txt != "") {
            $selQry .= " AND manufacturer_name LIKE '%$txt%'";
        }
        if ($dis != "") {
            $selQry .= " AND d.district_id = " . $dis;
        }
        if ($place != "") {
            $selQry .= " AND p.place_id = " . $place;
        }
        $result = $Con->query($selQry);
        $i = 0;
        while ($data = $result->fetch_assoc()) {
            $i++;
        ?>
        <td class="text-center p-4" style="border: 1px solid #ced4da; border-radius: 8px; background-color: #ffffff; margin: 10px; transition: transform 0.2s;">
            <div class="product-card" style="padding: 15px; margin: 10px;">
                <img src="../Assets/Files/Manufacturer/Logo/<?php echo $data['manufacturer_logo']; ?>" 
                     class="img-fluid img-thumbnail" 
                     width="250" 
                     height="300" 
                     alt="<?php echo $data['manufacturer_name']; ?>" 
                     style="border:1px solid #ced4da;border-radius: 8px;">

                <h5 class="my-3"><?php echo $data['manufacturer_name']; ?></h5>

                <p>
                    <a href="../User/Customization.php?mid=<?php echo $data['manufacturer_id']; ?>" 
                       class="btn btn-primary" 
                       style="border: 1px solid #6c7ae0; background-color: #6c7ae0; color: #fff; padding: 8px 15px; border-radius: 5px;">
                       Customize
                    </a>
                </p>
            </div>
        </td>
        <?php } ?>
    </tr>
</table>


<?php
if($i%4==0)
{
	echo "</tr><tr>";
}

?>
