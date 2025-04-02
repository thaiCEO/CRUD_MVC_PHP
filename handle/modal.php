<?php

function alertdelete()
{
?>
    <!-- Modal -->
    <div class="modal fade" id="deleteproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <p>Do you want to delete this product ?</p>
                </div>
                <form action="main.php" method="POST">
                    <div class="modal-footer">
                        <!-- Hidden input to store product ID -->
                        <input type="text" id="deletealert" name="deleteproductid" value="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- Submit button to delete the product -->
                        <button type="submit" class="btn btn-primary" name="deleteProduct">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}

?>