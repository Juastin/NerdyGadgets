<?php
$Image = 1;
if ($Image != null) {
    ?>
    <div id="ImageFrame"
         style="background-image: url('Public/StockItemIMG/<?php
         print ($Image);
         ?>'); background-size: 300px; background-repeat: no-repeat; background-position: center;">
    </div>
    <?php
    // Prints backup image when there is no picture available.
} else {
    ?>
    <div id="ImageFrame"
         style="background-image: url('Public/StockGroupIMG/<?php
         print ($Image);
         ?>'); background-size: 300px; background-repeat: no-repeat; background-position: center;">
    </div>
<?php } ?>