
function addOne(amount){
    amount++
    document.getElementById(item).value = amount
    console.log(amount);
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
}
