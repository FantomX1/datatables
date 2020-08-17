<?php


?>


<style>

    table.datatable th, td {padding: 5px}

</style>

<form>
<table class="datatable" border="1">


    <tr>

        <?php



        foreach ($header as $columnName => $column) {

            if (strpos($columnName,'_')===0) {
                continue;
            }

            ?>

            <th>

            <?php

            $showLink = empty($columnsDefinition) ||
            !empty($columnsDefinition[$columnName]->orderable);
            // !empty($columnsDefinition[$columnName]->orderable ?? '');



                $name = $columnName;


                // maybe not only undefined index not even definiton as isset
                if (!empty($columnsDefinition[$columnName]->caption )) {
                    $name = $columnsDefinition[$columnName]->caption;
                }

                $link = '<a href="?sortBy='.$columnName.'">'.$name.'</a>';


                if ($showLink) {
                    echo $link;
                } else {
                    echo $name;
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
