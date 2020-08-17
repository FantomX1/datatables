<?php


?>


<style>

    table.datatable th, td {padding: 5px}

</style>

<form>
<table class="datatable" border="1">


    <tr>

        <?php



        foreach ($header as $columnName => $colum) {

            ?>

            <th>

            <?php

            $showLink = empty($columnsDefinition) ||
            !empty($columnsDefinition[$columnName]->orderable ?? '');

                $link = '<a href="?sortBy='.$columnName.'">'.$columnName.'</a>';



                if ($showLink) {

                    echo $link;

                } else {


                    echo $columnName;


                }


            ?>
            </th>

            <?php



        }

        ?>


    </tr>



    <tr>

        <?php

            $enableFilter = false;
            foreach($columnsDefinition as $column) {
                if (!empty($column->filter)) {
                    $enableFilter = true;
                }
            }

            if ($enableFilter) {
                include "filterRow.php";
            }


        ?>


    </tr>



    <?php

        foreach ($data as $row) {

        ?>

        <tr>

            <?php

                foreach ($row as $column) {

                    ?>

                    <td>

                        <?php

                        echo $column;

                        ?>
                    </td>

                    <?php
                }


        ?>

        <tr>

        <?php






        }



    ?>


</table>

</form>

<?php

$paginator->run();

?>
