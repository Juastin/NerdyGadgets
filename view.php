<?php
$Connection = mysqli_connect("localhost", "root", "", "nerdygadgets");
$Connection2 = mysqli_connect("localhost", "root", "", "nerdygadgets_simple");
mysqli_set_charset($Connection, 'latin1');
mysqli_set_charset($Connection2, 'latin1');
include __DIR__ . "/header.php";
include "viewFunctions.php";
include 'CartFuncties.php';
include 'accountFunctions.php';
$ShowStockLevel = 1000;
$Result = GetResult($Connection, $_GET['id']);

If (isset($_SESSION['user'])) {
    $ResultUser = getInformation($Connection2, $_SESSION['user']);
}
$ResultReviewers= ViewReview($Connection2, $Result["StockItemID"]);
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
                            <div class="carousel-inner">
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
                        <h6> Inclusief BTW </h6>
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
</div></div></div></div>


        <div class="row">
            <div class ="CenteredContent2">
            <div class= "col-6" id="StockItemDescription">
            <h3>Artikel beschrijving</h3>
            <p><?php print $Result['SearchDetails']; ?></p>
             </div>

            <div class= "col-6" id="StockItemSpecifications">
            <h3>Artikel specificaties</h3>
            <?php
            $CustomFields = json_decode($Result['CustomFields'], true);
            if (is_array($CustomFields)) { ?>
                <table>
                <thead>
                <th>Naam</th>
                <th>Data</th>
                </thead>
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
        <?php
    } else {
        ?><h2 id="ProductNotFound">Het opgevraagde product is niet gevonden.</h2><?php
    } ?>
            </div>
        </div>


<div class="row">
    <div class="col-12">
    <div class="CenteredContent2">
<div class="reviewsArea">

    <div>
    <h3>Reviews</h3>
    <br>
    </div>

   <div>
       <div>
           <?php  if ($ResultReviewers == null) { ?>
              <div class="noReviewsYet"> <?php print("Er zijn nog geen reviews over dit product geschreven. Wees de eerste!"); ?> </div>
        <?php   }
           else {?>

           <?php foreach ($ResultReviewers as $reviewer) { ?>
               <i class="far fa-user-circle ProfileImage "></i>
               <span class="nameReviewer"> <?php print($reviewer['firstName'] . " " . $reviewer['middleName'] . " " . $reviewer['lastName'] . " " )?> <i class="dateTime"><?php print($reviewer['date']) ?> </i> <?php print("<br>")?></span>
          <div class= "writeAReview ">
           <textarea readonly="readonly" disabled="disabled" rows="3" cols="80"> <?php print($reviewer['review']) ?> </textarea>
          </div>
               <hr class="breakLine">
               <?php
           }}?>
       </div>
   </div>

<?php if(isset($_SESSION['user'])) {?>
    <div>
        <div>
        <i class="far fa-user-circle ProfileImage "></i>
        <span class="nameReviewer"><?php print($ResultUser['firstName'] . " " . $ResultUser['middleName'] . " " .$ResultUser['lastName'])?> </span>
    </div>
        <div class="writeAReview">
            <form method="post">
                <textarea maxlength="10000" rows="5" cols="80" placeholder="Schrijf hier uw review" name="review"></textarea>
                <input type="number" value='<?php print($ResultUser['userId']) ?>' name="reviewer" hidden>
                <input type="number" value='<?php print($Result["StockItemID"]) ?>' name="stockitemid" hidden>
                <input type="submit" class="btn btn-primary btn-outline-dark addReviewButton" value="Review plaatsen" name="submit3">
           <?php if(isset($_POST['submit3'])) {
               PlaceReview($Connection2, $_POST['reviewer'], $_POST['review'], $_POST['stockitemid']); ?>
               <script> window.location.href = 'view.php?id=<?php print($Result["StockItemID"])?>'; </script>
         <?php  }?>
            </form>
        </div>
    </div>
    <?php } ?>

</div>
    </div>
    </div>
</div>

<?php if(!isset($_SESSION['user'])) { ?>
    <div class="row">
            <div class="CenteredContent2">
                <div class="col-12">
                    <form>
                        <a href="login.php" class="btn btn-primary btn-outline-dark writeReviewButton" role="button">Ik wil een review schrijven <i class="fas fa-pen-fancy"></i></a>
                    </form>
                </div>
            </div>
        </div>
<?php } ?>
