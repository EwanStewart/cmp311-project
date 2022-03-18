 <?php
            // Variables will need to be changed
    echo '
        <div class="card container justify-content-center p-4">
            <div class="row">
                <div class="col-4">
                    <div><img class="shadow-sm w-75 rounded" src="../image/'. $basket[0]->image .'"/></div> 
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-6">
                            <h1 class="font-weight-bold">'. $basket[0]->name .'</h1>
                        </div>
                        <div class="col-6">
                            <a href="../controller/emptyBasket.php" class="btn btn-outline-success"><i class="bi-x"></i> Remove from Basket</a>
                        </div>
                        <div class="col-6">
                            <h3>£'. $basket[0]->price .'</h3>
                        </div>
                        <div class="col-6">
                            <a href="details.php" class="btn btn-lg btn-outline-success">Purchase</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
?>