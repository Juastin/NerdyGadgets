<?php
// Gets information from db of product by passing $id as parameter
function GetResult($Connection, $id)
{
    $Query = " 
           SELECT SI.StockItemID, 
            (RecommendedRetailPrice*(1+(TaxRate/100))) AS SellPrice, 
            StockItemName,
            CONCAT('Voorraad: ',QuantityOnHand)AS QuantityOnHand,
            SearchDetails, 
            (CASE WHEN (RecommendedRetailPrice*(1+(TaxRate/100))) > 50 THEN 0 ELSE 6.95 END) AS SendCosts, MarketingComments, CustomFields, SI.Video,
            (SELECT ImagePath FROM stockgroups JOIN stockitemstockgroups USING(StockGroupID) WHERE StockItemID = SI.StockItemID LIMIT 1) as BackupImagePath   
            FROM stockitems SI 
            JOIN stockitemholdings SIH USING(stockitemid)
            JOIN stockitemstockgroups ON SI.StockItemID = stockitemstockgroups.StockItemID
            JOIN stockgroups USING(StockGroupID)
            WHERE SI.stockitemid = ?
            GROUP BY StockItemID";
    $Statement = mysqli_prepare($Connection, $Query);
    mysqli_stmt_bind_param($Statement, "i", $id);
    mysqli_stmt_execute($Statement);
    $ReturnableResult = mysqli_stmt_get_result($Statement);
    if ($ReturnableResult && mysqli_num_rows($ReturnableResult) == 1) {
        return $Result = mysqli_fetch_all($ReturnableResult, MYSQLI_ASSOC)[0];
    } else {
        return $Result = null;
    }
}

// Aanpassen van voorraad bij afronden bestelling
function UpdateVoorraad($Connection, $quantity, $id)
{
    print($quantity . " " . $id);
    $Query = "
                UPDATE stockitemholdings 
                SET QuantityOnHand = QuantityOnHand - ".$quantity." 
                WHERE StockItemID=".$id.";";
    $Statement = mysqli_prepare($Connection, $Query);
    mysqli_stmt_execute($Statement);
}

// Gets Images from db of product by using $_GET['id']
function GetImages($Connection)
{
    $Query = "
                    SELECT ImagePath
                    FROM stockitemimages 
                    WHERE StockItemID = ?";
    $Statement = mysqli_prepare($Connection, $Query);
    mysqli_stmt_bind_param($Statement, "i", $_GET['id']);
    mysqli_stmt_execute($Statement);
    $R = mysqli_stmt_get_result($Statement);
    $R = mysqli_fetch_all($R, MYSQLI_ASSOC);
    if ($R) {
        return $Images = $R;
    }
}

// Gets single image from db of product by passing $id as productID as parameter.
function GetSingleImage($Connection, $id)
{
    $Query = "
                    SELECT ImagePath
                    FROM stockitemimages 
                    WHERE StockItemID = ?";
    $Statement = mysqli_prepare($Connection, $Query);
    mysqli_stmt_bind_param($Statement, "i", $id);
    mysqli_stmt_execute($Statement);
    $R = mysqli_stmt_get_result($Statement);
    $R = mysqli_fetch_all($R, MYSQLI_ASSOC);
    if (isset($R[0]['ImagePath'])) {
        return $R[0]['ImagePath'];
    } else {
        return null;
    }
}
