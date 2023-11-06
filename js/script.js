$(document).ready(function () {

    

    // event handler click 
    $('a.delete').click(function () {
        var sure = confirm("Do you want to delete?");
            if (!sure) {
                event.preventDefault();
                // for prevent events
            }
    });





    // check if password = confirm password
    $('form#password').submit(function() {
        var newpass = $('#new').val();
        var confpass = $('#confirm').val();
        if (newpass != confpass) {
            alert("Password and confirm password is not the same!");
            event.preventDefault();
        }
    });




    // calculate totalprice 
    // $("#quantity").blur(() => {
    //         var quantity = parseFloat($('#quantity').val());
    //         var unitprice = parseFloat($('#unitprice').val());
    //         var totalprice = (quantity * unitprice);
    //         $('#totalprice').val( totalprice);
    //     });
    // $("#unitprice").blur(() => {
    //         var quantity = parseFloat($('#quantity').val());
    //         var unitprice = parseFloat($('#unitprice').val());
    //         var totalprice = (quantity * unitprice);
    //         $('#totalprice').val(totalprice);

    //     });






    // const newLocal = '#product_id';
        // sales-add page 
        // calculate discount and totalamount
        $('#product_id').change(function() {
            var product_id = $(this).val();
            // alert(product_id);
            if (product_id != 0) {
                // fetch the data from the database --> product--> unitprice 
                // Ajax   --> Asynchronous 
                var xmlhttp = new XMLHttpRequest();   //xmlhttp.open()   xmlhttp.send()
                // $_post(url, data, callback function)   $_get(url, data, callback function)
                $.post('product-find-price.php', 'p_id='+product_id, function(data) {
                    $('#unitprice').val(data);
                }); 
            }
        });





    //   // sales-add page   calculate totalamount     
        $('#discount').blur(function() {
            var discount = parseFloat($(this).val());
            var totalprice = parseFloat($('#totalprice').val());
            var total = (discount * totalprice / 100);
             $('#totalamount').val(totalprice - total);
        });


// sales-add.php
    function calculateTotal() {
        var quantity = parseFloat($('#quantity').val());
        var unitprice = parseFloat($('#unitprice').val());
        var totalprice = (quantity * unitprice);
        $('#totalprice').val(totalprice);
        var discount = parseInt(('#quantity').val());
        var totalprice = parseInt($('#totalprice').val());
        var total = parseInt(discount * totalprice / 100);
        var totalamount = parseInt(totalprice - total);
         $('#totalamount').val(totalamount);
    }

        $('#quantity').blur(function() {
            calculateTotal();
        });

        $('#unitprice').blur(function() {
            calculateTotal();
        });
    
        $('#discount').blur(function() {
                calculateTotal();
        });






        // to print the specific data --> buy-detail.php
        // print 
        $('#print_btn').click(function() {
            //window.open(url, name, specification.width.height);
            var printWindow = window.open("", "printWindow", "");
            var data = $('#printArea').html();

            printWindow.document.write("<html><head><link href='css/bootstrap.min.css' rel='stylesheet'><link href='css/font-awesome.min.css' rel='stylesheet'><link href='css/datepicker3.css' rel='stylesheet'><link href='css/styles.css' rel='stylesheet'></head><body>"+ data + "</body></html>");
            printWindow.print();
            printWindow.close();


        });



// check password and confirnation password
        $('#changepassword').submit(function () {
                var pass = $('#newpassword').val();
                var confirmpass = $('#confirmpassword').val();

                if (pass !== confirmpass) {
                    $('#confirmpassword').focus();
                    alert('New Password and Confirm Password field does not match');
                    return false;
                }
                return true;
            });





        


});



