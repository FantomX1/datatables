<div class="pageLimit">

    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
        <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle btn-info " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $onPage ?>
            </button>



            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                <?php

                foreach ($perPageSettings as $item) {


                    ?>


                    <a class="dropdown-item " href="?onPage=<?php echo $item ?>">Change to <?php echo $item ?> rows</a> <br>

                    <?php

                }
                ?>


            </div>
        </div>
    </div>

</div>
