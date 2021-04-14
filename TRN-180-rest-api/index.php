<?php

require 'display.php';


$display = new Display_Data();
$output = $display->display();

$img_1 = $display->get_img_url($output['data']['15']['relationships']['field_image']['links']['related']['href']);
$img_2 = $display->get_img_url($output['data']['12']['relationships']['field_image']['links']['related']['href']);
$img_3 = $display->get_img_url($output['data']['13']['relationships']['field_image']['links']['related']['href']);
$img_4 = $display->get_img_url($output['data']['14']['relationships']['field_image']['links']['related']['href']);

$icon_list_1 = $display->get_icon_urls($output['data']['15']['relationships']['field_service_icon']['links']['related']['href']);
$icon_list_2 = $display->get_icon_urls($output['data']['12']['relationships']['field_service_icon']['links']['related']['href']);
$icon_list_3 = $display->get_icon_urls($output['data']['13']['relationships']['field_service_icon']['links']['related']['href']);
$icon_list_4 = $display->get_icon_urls($output['data']['15']['relationships']['field_service_icon']['links']['related']['href']);



?>

<!DOCTYPE html>
<html>
<head>
    <title>Data</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>

    <div class="section-1">
        <div class="left">
            <img src="<?php echo $img_1; ?>" alt="img-1" width="<?php echo $output['data']['15']['relationships']['field_image']['data']['meta']['width'];?>" height="<?php echo $output['data']['15']['relationships']['field_image']['data']['meta']['height'];?>">
        </div>
        <div class="right">
            <div class="text">
                <h1><?php echo $output['data']['15']['attributes']['title'];?> </h1>
                <div class="icon">
                    <?php
                        foreach ($icon_list_1 as $k => $v) {
                            echo "<img src=" . $v . " height='60'>";
                        }
                    ?>
                </div>
                <ul>
                    <li><?php echo $output['data']['2']['attributes']['title'];?></li>
                </ul>
                <button>Explore More</button>
            </div>

        </div>
    </div>



    <div class="section-2">
        <div class="left">
            <div class="text">
                <h1><?php echo $output['data']['12']['attributes']['title'];?> </h1>
                <div class="icon">
                    <?php
                        foreach ($icon_list_2 as $k => $v) {
                            echo "<img src=" . $v . " height='60'>";
                        }
                    ?>
                </div>
                <ul>
                    <li><?php echo $output['data']['0']['attributes']['title'];?></li>
                    <li><?php echo $output['data']['7']['attributes']['title'];?></li>
                    <li><?php echo $output['data']['11']['attributes']['title'];?></li>
                </ul>
                <button>Explore More</button>
            </div>
        </div>
        <div class="right">
            <img src="<?php echo $img_2; ?>" alt="img-2" width="<?php echo $output['data']['12']['relationships']['field_image']['data']['meta']['width'];?>" height="<?php echo $output['data']['12']['relationships']['field_image']['data']['meta']['height'];?>">
        </div>
    </div>



    <div class="section-3">
        <div class="left">
            <img src="<?php echo $img_3; ?>" alt="img-3" width="<?php echo $output['data']['13']['relationships']['field_image']['data']['meta']['width'];?>" height="<?php echo $output['data']['13']['relationships']['field_image']['data']['meta']['height'];?>">
        </div>
        <div class="right">
            <div class="text">
                <h1><?php echo $output['data']['13']['attributes']['title'];?> </h1>
                <div class="icon">
                    <?php
                        foreach ($icon_list_3 as $k => $v) {
                            echo "<img src=" . $v . " height='60'>";
                        }
                    ?>
                </div>
                <ul>
                    <li><?php echo $output['data']['1']['attributes']['title'];?></li>
                    <li><?php echo $output['data']['3']['attributes']['title'];?></li>
                    <li><?php echo $output['data']['8']['attributes']['title'];?></li>
                    <li><?php echo $output['data']['9']['attributes']['title'];?></li>
                </ul>
                <button>Explore More</button>
            </div>
        </div>
    </div>



    <div class="section-4">
        <div class="left">
            <div class="text">
                <h1><?php echo $output['data']['14']['attributes']['title'];?> </h1>
                <div class="icon">
                    <?php
                        foreach ($icon_list_4 as $k => $v) {
                            echo "<img src=" . $v . " height='60'>";
                        }
                    ?>
                </div>
                <ul>
                    <li><?php echo $output['data']['5']['attributes']['title'];?></li>
                    <li><?php echo $output['data']['6']['attributes']['title'];?></li>
                    <li><?php echo $output['data']['10']['attributes']['title'];?></li>
                    <li><?php echo $output['data']['4']['attributes']['title'];?></li>
                </ul>
                <button>Explore More</button>
            </div>
        </div>
        <div class="right">
            <img src="<?php echo $img_4; ?>" alt="img-4" width="<?php echo $output['data']['14']['relationships']['field_image']['data']['meta']['width'];?>" height="<?php echo $output['data']['14']['relationships']['field_image']['data']['meta']['height'];?>">
        </div>
    </div>

</body>
</html>
