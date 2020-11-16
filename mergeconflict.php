<?php
function GetImages ($Connection) {
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
function GetSingleImage ($Connection, $id) {
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
    }
    else {
        return null;
    }
}