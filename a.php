<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "rzp_test_iQetFg6HIBdhuT",
        "amount": 50000,
        "currency": "INR",
        "name": "SportsSpot",
        "image": "./assets/wb.png",
        "handler": function(response) {
            var transaction_id = response.razorpay_payment_id;
            console.log(transaction_id);
            console.log(response.razorpay_payment_method);
            $.ajax({
                type: 'post',
                url: 'payment.php',
                data: {
                    'transaction_id': response.razorpay_payment_id
                },
                success: function(result) {
                    window.location.href = "payment_ty.php";
                }
            });
        }
    };

    $(document).ready(function() {
        var rzp1 = new Razorpay(options);
        rzp1.open();
    });
</script>
