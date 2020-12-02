<?php
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets");
mysqli_set_charset($Connection, 'latin1');
include __DIR__ . "/header.php";
include "viewFunctions.php";
include 'CartFuncties.php';
$ShowStockLevel = 1000;
$Result = GetResult($Connection, $_GET['id']);
GetImages($Connection);

?>
<div id="CenteredContent">
    <?php
    if ($Result != null) {
        ?>
        <?php
        if (isset($Result['Video'])) {
            ?>
            <div id="VideoFrame">
                <?php print $Result['Video']; ?>
            </div>
        <?php }
        ?>


        <div id="ArticleHeader">
            <?php
            if (isset($Images)) {
                // print Single
                if (count($Images) == 1) {
                    ?>
                    <div id="ImageFrame"
                         style="background-image: url('Public/StockItemIMG/<?php print $Images[0]['ImagePath']; ?>'); background-size: 300px; background-repeat: no-repeat; background-position: center;"></div>
                    <?php
                } else if (count($Images) >= 2) { ?>
                    <div id="ImageFrame">
                        <div id="ImageCarousel" class="carousel slide" data-interval="false">
                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                                <?php for ($i = 0; $i < count($Images); $i++) {
                                    ?>
                                    <li data-target="#ImageCarousel"
                                        data-slide-to="<?php print $i ?>" <?php print (($i == 0) ? 'class="active"' : ''); ?>></li>
                                    <?php
                                } ?>
                            </ul>

                            <!-- The slideshow -->
                            <div class="carousel-inner" >
                                <?php for ($i = 0; $i < count($Images); $i++) {
                                    ?>
                                    <div class="carousel-item <?php print ($i == 0) ? 'active' : ''; ?>">
                                        <img src="Public/StockItemIMG/<?php print $Images[$i]['ImagePath'] ?>">
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Left and right controls -->
                            <a class="carousel-control-prev" href="#ImageCarousel" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#ImageCarousel" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div id="ImageFrame"
                     style="background-image: url('Public/StockGroupIMG/<?php print $Result['BackupImagePath']; ?>'); background-size: cover;"></div>
                <?php
            }
            ?>


            <h1 class="StockItemID">Artikelnummer: <?php print $Result["StockItemID"]; ?></h1>
            <h2 class="StockItemNameViewSize StockItemName">
                <?php print $Result['StockItemName']; ?>
            </h2>
            <div class="QuantityText"><?php print $Result['QuantityOnHand']; ?></div>
            <div id="StockItemHeaderLeft">
                <div class="CenterPriceLeft">
                    <div class="CenterPriceLeftChild">
                        <p class="StockItemPriceText"><b><?php print sprintf("€ %.2f", $Result['SellPrice']); ?></b></p>
                        <h6><b>Inclusief BTW</b></h6>
                        <h10> Gratis Verzending </h10>
                        <form method="post">
                            <input type="number" value='<?php print($Result["StockItemID"]) ?>' name="stockItemID" hidden>
                            <input type="submit" class="btn btn-primary btn-outline-dark addToCartButton" name="submit" value="Toevoegen aan winkelmand">
                        </form>
                        <?php
                        if (isset($_POST['submit'])){
                            AddProductToCart($_POST['stockItemID']);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="StockItemDescription" >
            <h3 ><b>Product Informatie</b></h3>
            <?php print $Result['SearchDetails'];?></p>
            <table>
                <tr>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Etiam a facilisis turpis. In a nulla vestibulum, porttitor eros sit amet, lobortis leo.
                    Nam malesuada faucibus velit, eu ultrices sapien condimentum vitae.</tr>

                    <br>
                    <br>

                <tr>Sed ut libero euismod, vulputate risus id, hendrerit nibh. Maecenas auctor est in tellus ullamcorper venenatis.
                    Aenean vestibulum velit vel laoreet bibendum.</tr>

                    <br>
                    <br>

                <hd><b>Plus- en minpunten</b></hd>

                <br>

                <tr><i class="fas fa-plus-circle" style="color:green"></i></tr>
                <tr>Donec pellentesque odio in nulla mollis, id convallis elit molestie. Nulla facilisi.</tr>

                <br>

                <tr><i class="fas fa-minus-circle" style="color:#ff0000"></i></tr>
                <tr>Maecenas auctor est in tellus ullamcorper venenatis.
                Aenean vestibulum velit vel laoreet bibendum.</tr>

                <br>
                <br>

                <tr><b>Verzending</b><br>Verzending bij alle producten is gratis. Daarbij duurt verwerking en verzending van producten zo'n 2-4 dagen.</tr>
            </table>
        </div>

    <div>
        <div id="StockItemSpecifications">
            <h3><b>Artikel specificaties</b></h3>
            <?php
            $CustomFields = json_decode($Result['CustomFields'], true);
            if (is_array($CustomFields)) { ?>
                <table>

                <td><hd><b>Name</b></hd></td>
                <td><hd><b>Data</b></hd></td>

                <?php
                foreach ($CustomFields as $SpecName => $SpecText) { ?>
                    <tr>
                        <td>
                            <?php print $SpecName; ?>
                        </td>
                        <td>
                            <?php
                            if (is_array($SpecText)) {
                                foreach ($SpecText as $SubText) {
                                    print $SubText . " ";
                                }
                            } else {
                                print $SpecText;
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                </table><?php
            } else { ?>

                <p><?php print $Result['CustomFields']; ?>.</p>
                <?php
            }
            ?>
        </div>
    </div>
        <?php
    } else {
        ?><h2 id="ProductNotFound">Het opgevraagde product is niet gevonden.</h2><?php
    } ?>
</div>
