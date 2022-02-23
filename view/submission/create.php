<?php
    require_once 'view/layouts/header.php'; 
?>

    <br><br>
    
    <form action="<?= Base_url ?>/submission/store" method="POST">
        
        <div class="container">

            <div class="col-sm-6">

                <a href="<?= Base_url ?>" type="button" class="btn btn-default pull-right">Back To List</a>
            
                <h2>Add Submission</h2>  
                <br>

                <div class="form-group">
                    <label>Amount<span style="color: red">*</span></label>
                    <input type="text" name="amount" class="form-control" id="amount">
                </div>

                <div class="form-group">
                    <label>Buyer<span style="color: red">*</span></label>
                    <input type="text" name="buyer" class="form-control" id="buyer">
                </div>
                
                <button type="submit" class="btn btn-default">Submit</button>

            </div>
        
        </div>

    </form>

<?php
    require_once 'view/layouts/footer.php'; 
?>