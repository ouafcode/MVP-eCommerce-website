$('.counter-plus').click(function (e){
    let qty = $(e.currentTarget).siblings('#qty')
    let qtyValue = parseInt(qty.val())+1
    qty.val(qtyValue)
});

$('.counter-moins').click(function (e){
    let qty = $(e.currentTarget).siblings('#qty')
    let qtyValue = parseInt(qty.val())-1
    if(qtyValue < 0){
        qtyValue = 0
    }
    qty.val(qtyValue)
});