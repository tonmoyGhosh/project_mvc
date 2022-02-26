<?php
    require_once 'view/layouts/header.php'; 
?>

    <br><br>
    
    <form id="form">
        
        <div class="container">

            <div class="col-sm-12">

                <a href="<?= Base_url ?>" type="button" class="btn btn-default pull-right">Back To List</a>

                <h2>Add Submission</h2>  
                <br>

                <div class="col-sm-6">

                    <div class="form-group">
                        <label>Buyer<span style="color: red">*</span></label>
                        <input type="text" name="buyer" class="form-control" id="buyer">
                        <p style="color: red" id="buyer_msg"></p>
                    </div>

                    <div class="form-group">
                        <label>Buyer Email<span style="color: red">*</span></label>
                        <input type="email" name="buyer_email" class="form-control" id="buyer_email">
                        <p style="color: red" id="buyer_email_msg"></p>
                    </div>

                    <div class="form-group">
                        <label>Receipt Id<span style="color: red">*</span></label>
                        <input type="text" name="receipt_id" class="form-control" id="receipt_id">
                        <p style="color: red" id="receipt_id_msg"></p>
                    </div>

                    <div class="form-group">
                        <label>Amount<span style="color: red">*</span></label>
                        <input type="text" name="amount" class="form-control" id="amount">
                        <p style="color: red" id="amount_msg"></p>
                    </div>

                    <div class="form-group">
                        <label>City<span style="color: red">*</span></label>
                        <input type="text" name="city" class="form-control" id="city">
                        <p style="color: red" id="city_msg"></p>
                    </div>

                    <div class="form-group">
                        <label>Phone<span style="color: red">*</span></label>
                        <input type="text" name="phone" class="form-control" id="phone">
                        <p style="color: red" id="phone_msg"></p>
                    </div>

                </div>

                <div class="col-sm-6">

                    <div class="form-group">
                        <label>Items<span style="color: red">*</span></label>
                        <textarea type="text" name="items" class="form-control" rows="4" id="items"></textarea>
                        <p style="color: red" id="items_msg"></p>
                    </div>

                    <div class="form-group">
                        <label>Note<span style="color: red">*</span></label>
                        <textarea type="text" name="note" class="form-control" rows="5" id="note"></textarea>
                        <p style="color: red" id="note_msg"></p>
                    </div>

                    <div class="form-group">
                        <label>Entry By<span style="color: red">*</span></label>
                        <input type="text" name="entry_by" class="form-control" id="entry_by">
                        <p style="color: red" id="entry_by_msg"></p>
                    </div>

                    <button type="submit" class="btn btn-default pull-right">Submit</button>

                </div>

            </div>

        </div>

    </form>

<?php
    require_once 'view/layouts/footer.php'; 
?>

<script>
    
    $('#phone').val('880');

    $("#form").submit(function(event)
    {
        event.preventDefault();
        var $form = $(this);
        var inputData = $form.serialize();

        var value = $('#phone').val();
        var valueLength = value.length;

        if($('#buyer').val() == '')
        {
            $('#buyer_msg').text('Buyer field is required');
            return false;
        }
        else if($('#buyer_email').val() == '')
        {
            $('#buyer_email_msg').text('Buyer email field is required');
            return false;
        }
        else if($('#receipt_id').val() == '')
        {
            $('#receipt_id_msg').text('Receipt id field is required');
            return false;
        }
        else if($('#amount').val() == '')
        {
            $('#amount_msg').text('Amount field is required');
            return false;
        }
        else if($('#city').val() == '')
        {
            $('#city_msg').text('City field is required');
            return false;
        }
        else if($('#phone').val() == '')
        {
            $('#phone_msg').text('Phone field is required');
            return false;
        }
        else if($('#items').val() == '')
        {
            $('#items_msg').text('Items field is required');
            return false;
        }
        else if($('#note').val() == '')
        {
            $('#note_msg').text('Note field is required');
            return false;
        }
        else if($('#entry_by').val() == '')
        {
            $('#entry_by_msg').text('Entry by field is required');
            return false;
        }
        else if(valueLength != 13)
        {
            $('#phone_msg').text('Phone no is not valid');
            return false;
        }
        else
        {   
            $.ajax({
            url: '<?= Base_url ?>/submission/store',
            type: "POST",
            data: inputData,
            dataType: 'json',
            encode: true,
            success: function(response)
            {      
                $('#amount_msg').text('');
                $('#buyer_msg').text('');
                $('#buyer_email_msg').text('');
                $('#receipt_id_msg').text('');
                $('#city_msg').text('');
                $('#phone_msg').text('');
                $('#items_msg').text('');
                $('#note_msg').text('');
                $('#entry_by_msg').text('');

                if(response['validateStatus'] == true)
                {
                    if(response['amount_msg'] != '')
                    {
                        $('#amount_msg').text(response['amount_msg']);
                    }
                    if(response['buyer_msg'] != '')
                    {
                        $('#buyer_msg').text(response['buyer_msg']);
                    }
                    if(response['buyer_email_msg'] != '')
                    {
                        $('#buyer_email_msg').text(response['buyer_email_msg']);
                    }
                    if(response['receipt_id_msg'] != '')
                    {
                        $('#receipt_id_msg').text(response['receipt_id_msg']);
                    }
                    if(response['city_msg'] != '')
                    {
                        $('#city_msg').text(response['city_msg']);
                    }
                    if(response['phone_msg'] != '')
                    {
                        $('#phone_msg').text(response['phone_msg']);
                    }
                    if(response['items_msg'] != '')
                    {
                        $('#items_msg').text(response['items_msg']);
                    }
                    if(response['note_msg'] != '')
                    {
                        $('#note_msg').text(response['note_msg']);
                    }
                    if(response['entry_by_msg'] != '')
                    {
                        $('#entry_by_msg').text(response['entry_by_msg']);
                    }
                }
                else if(response.status == true)
                {
                    alert(response.msg);
                    window.location = '<?= Base_url ?>';
                }
                else
                {
                    alert(response.msg);
                    location.reload();
                }

            },
            error: function(response)
            {
                alert('Something went wrong, please try again!');
            }
            
        });

        }

    });

</script>