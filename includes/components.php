<?
    function cartElement($prodImg,$prodName,$prodPrice){
        $element = "
        
        <form action="cart.php" method="get" class="cart-items">
        <div class="border rounded">
            <div class="row bg-white">
                <div class="col-md-3">
                    <img src="images/$prodImg" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h5 class="pt-2">$prodName</h5>
                    <small class="text-secondary">Brand</small>
                    <h5 class="pt-2">$prodPrice</h5>
                     <button type="submit" class="btn btn-warning">Save for Later</button>
                    <button type="submit" class="btn btn-danger mx-2" name="remove">Remove</button>
                </div> 
                <div class="col-md-3 py-5">
                    <div>
                        <button type="button" class="btn bg-light border rounder-circle"><i class="fas fa-minus"></i></button>
                        <input type="text" value="1" class="form-control w-25 d-inline">
                        <button type="button" class="btn bg-light border rounder-circle"><i class="fas fa-plus"></i></button>
                    </div>
                 </div>
            </div>
        </div>
        </form>
        ";

        echo $element;
    };
    
?>