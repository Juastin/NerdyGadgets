<?php
function GetSingleImage ($Connection, $id) {
    $Query = "
    SELECT ImagePath
    FROM stockitemimages
    WHERE StockItemID = ?";
    $Statement = mysqli_prepare($Connection, $Query);
    mysqli_stmt_bind_param($Statement, "i", $id);
    mysqli_stmt_execute($Statement);
}