<?php
    require_once 'view/layouts/header.php'; 
?>

    <br><br><br><br>
    <div class="container">

        <a href="<?= Base_url ?>/submission/create" type="button" class="btn btn-default pull-right">Add Submission</a>
        <br>
        <h2>All Submission List</h2>  

        <table class="table">
            
            <thead>
                <tr>
                    <th>Amount</th>
                    <th>Buyer</th>
                    <th>Receipt Id</th>
                    <th>Items</th>
                    <th>Buyer Email</th>
                    <th>Note</th>
                    <th>City</th>
                    <th>Phone</th>
                    <th>Entry At</th>
                </tr>
            </thead>

            <tbody>

                <?php

                    if($data['submissionsList']->num_rows > 0) 
                    {   
                        while($row = $data['submissionsList']->fetch_assoc()) 
                        {
                            echo "<tr>
                                    <td>".$row['amount']."</td>
                                    <td>".$row['buyer']."</td>
                                    <td>".$row['receipt_id']."</td>
                                    <td>".$row['items']."</td>
                                    <td>".$row['buyer_email']."</td>
                                    <td>".$row['note']."</td>
                                    <td>".$row['city']."</td>
                                    <td>".$row['phone']."</td>
                                    <td>".date('d M Y', strtotime($row['entry_at']))."</td>
                                </tr>";
                        }
                    } 
                    else 
                    {
                        echo "<tr><td></td><td></td><td></td><td></td><td>No results found</td></tr>";
                    }
                ?>

                
            </tbody>

        </table>

    </div>

<?php
    require_once 'view/layouts/footer.php'; 
?>