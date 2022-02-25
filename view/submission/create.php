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
                    </div>

                    <div class="form-group">
                        <label>Buyer Email<span style="color: red">*</span></label>
                        <input type="email" name="buyer_email" class="form-control" id="buyer_email">
                    </div>

                    <div class="form-group">
                        <label>Receipt Id<span style="color: red">*</span></label>
                        <input type="text" name="receipt_id" class="form-control" id="receipt_id">
                    </div>

                    <div class="form-group">
                        <label>Amount<span style="color: red">*</span></label>
                        <input type="text" name="amount" class="form-control" id="amount">
                    </div>

                    <div class="form-group">
                        <label>City<span style="color: red">*</span></label>
                        <input type="text" name="city" class="form-control" id="city">
                    </div>

                    <div class="form-group">
                        <label>Phone<span style="color: red">*</span></label>
                        <input type="text" name="phone" class="form-control" id="phone">
                    </div>

                </div>

                <div class="col-sm-6">

                    <div class="form-group">
                        <label>Items<span style="color: red">*</span></label>
                        <textarea type="text" name="items" class="form-control" rows="4" id="items"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Note<span style="color: red">*</span></label>
                        <textarea type="text" name="note" class="form-control" rows="5" id="note"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Entry By<span style="color: red">*</span></label>
                        <input type="text" name="entry_by" class="form-control" id="entry_by">
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
    
    $("#form").submit(function(event)
    {
        event.preventDefault();
        var $form = $(this);
        var inputData = $form.serialize();

        $.ajax({
            url: '<?= Base_url ?>/submission/store',
            type: "POST",
            data: inputData,
            dataType: 'json',
            encode: true,
            success: function(response)
            {   
                if(response.status == true)
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

    });

</script>