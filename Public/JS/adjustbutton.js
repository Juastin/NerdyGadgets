
function addOne(amount){
    amount++
   document.getElementById('amount').value = amount
    console.log(amount);
}

function substractOne(amount){
    if(amount > 0){
        amount--
        document.getElementById('amount').value = amount
        console.log(amount);
    }
}