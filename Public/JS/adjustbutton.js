
/*function addOne(amount,item){
    amount++
    item = item.toString()
    document.getElementById(item).value = amount
    console.log(amount);
    console.log(item);
}

function substractOne(amount,item){
    if(amount > 0){
        amount--
        item = item.toString()
        document.getElementById(item).value = amount
        console.log(amount);
        console.log(item);
    }
}
function input(item){
    document.getElementById('item').value = item
    console.log(item);
}*/
$('.add').click(function () {
    $(this).prev().val(+$(this).prev().val() + 1);
    this.form.submit();
});
$('.sub').click(function () {
    if ($(this).next().val() > 0) $(this).next().val(+$(this).next().val() - 1);
    this.form.submit();
});
/*$('.sub').click(function(){
    quantityField = $(this).next();
    if (quantityField.val() != 0) {
        quantityField.val(parseInt(quantityField.val(), 10) - 1);
        this.form.submit()
    }
});
$('.add').click(function(){
    quantityField = $(this).prev();
    quantityField.val(parseInt(quantityField.val(), 10) + 1);
    this.form.submit()
});*/
