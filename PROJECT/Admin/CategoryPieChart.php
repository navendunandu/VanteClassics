<?php
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../Assets/JQ/jQuery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Document</title>
</head>
<body>
<div class="row">
<div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Filter Bookings by Date</h4>
                        </div>
                        <div class="card-body">
                            <form id="form1" name="form1" method="post" action="">
                                <div class="form-group row">
                                    <label for="txt_start" class="col-sm-2 col-form-label">Start Date</label>
                                    <div class="col-sm-4">
                                    <input type="date" class="form-control" name="txt_start" max="<?php echo Date('Y-m-d') ?>" id="txt_start">
                                    </div>
                                    <label for="txt_end" class="col-sm-2 col-form-label">End Date</label>
                                    <div class="col-sm-4">
                                    <input type="date" class="form-control" name="txt_end" max="<?php echo Date('Y-m-d')?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 text-right">
                                        <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                $xValues = [];
                $yValues = [];
if(isset($_POST['btn_submit'])){
    // Fetch category names
$selX = "SELECT * FROM tbl_category";
$resX = $Con->query($selX);
while ($dataX = $resX->fetch_assoc()) {
    $xValues[] = $dataX['category_name'];

    // Fetch count of items in cart per category
 $selY = "SELECT COUNT(*) as count 
             FROM tbl_cart c 
             INNER JOIN tbl_product p ON p.product_id = c.product_id 
             INNER JOIN tbl_subcategory s ON s.subcat_id = p.subcategory_id 
             INNER JOIN tbl_booking b on b.booking_id=c.booking_id
             WHERE booking_date BETWEEN '".$_POST['txt_start']."' AND '".$_POST['txt_end']."' AND
             s.category_id = " . $dataX['category_id'] . " 
             AND cart_status BETWEEN 0 AND 5";
    $resY = $Con->query($selY);
    $dataY = $resY->fetch_assoc();
    $yValues[] = $dataY['count'];
}

// Encode PHP arrays to JSON for use in JavaScript
$xValuesJson = json_encode($xValues);
$yValuesJson = json_encode($yValues);
                ?>
    <div align="center" class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pie Chart</h4>
                <div class="chart_area" style="display:flex;justify-content: center;">
            <div class="chart_box" style="height:450px;width:450px;">
        <canvas id="categoryPieChart"></canvas>
        </div></div>

            </div>
        </div>
    </div>
    <?php
}

    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const xValues = <?php echo $xValuesJson; ?>;
    const yValues = <?php echo $yValuesJson; ?>;

    function generatePastelBrightColorPalettes(numColors) {
        const fillColors = [];
        const borderColors = [];
        const colorStep = 360 / numColors;

        for (let i = 0; i < numColors; i++) {
            const hue = Math.round(i * colorStep);

            // Generate pastel RGB values for bright colors
            const saturation = 50 + Math.random() * 30; // Adjust the saturation range
            const lightness = 65 + Math.random() * 30;  // Adjust the lightness for pastel effect

            const fillColor = `hsla(${hue}, ${saturation}%, ${lightness}%, 0.65)`; // 0.65 alpha value for fill
            const borderColor = `hsla(${hue}, ${saturation}%, ${lightness}%, 1)`;  // 1 alpha value for border

            fillColors.push(fillColor);
            borderColors.push(borderColor);
        }

        return { fillColors, borderColors };
    }

    const colorPalettes = generatePastelBrightColorPalettes(xValues.length);

    // Create the chart
    const ctx = document.getElementById('categoryPieChart').getContext('2d');
    const categoryPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: xValues, // Category names
            datasets: [{
                label: 'Items in Cart per Category',
                data: yValues, // Count of items in cart
                backgroundColor: colorPalettes.fillColors, // Generated pastel fill colors
                borderColor: colorPalettes.borderColors, // Generated pastel border colors
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    enabled: true,
                    mode: 'index'
                }
            }
        }
    });
</script>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>