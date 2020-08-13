<?php



/*<script type="text/javascript" src="<?php echo $assetsHandler->getAssetsDir($rootDir, 'components/jquery').'/jquery.js'; ?>">*/
//</script>
//
//
/*<script type="text/javascript" src="<?php echo $assetsHandler->getAssetsDir($rootDir, 'components/jqueryui').'/jquery-ui.js'; ?>">*/
//</script>


?>


<script type="text/javascript" src="<?php

//echo $assetsHandler->getAssetsDir($rootDir, '') . '/assets/js/kokot.js'; ?>">

</script>


<script type="text/javascript" src="<?php echo $assetsHandler->getAssetsDir("", 'components/jquery').'/jquery.js'; ?>">
</script>


<script type="text/javascript" src="<?php echo $assetsHandler->getAssetsDir("", 'components/jqueryui').'/jquery-ui.js'; ?>">
</script>


<!--<script type="text/javascript" src="--><?php //echo $assetsHandler->getAssetsDir("", '').'/assets/js/helpers.js'; ?><!--">-->
<!--</script>-->
<!---->


<?php



//for debug
echo '';

foreach ($header as $columnName => $column) {

    ?>

    <script>

        <?php

            $helpers = $assetsHandler->getAssetsDir("", '').'/assets/js/helpers.js';

         ?>

        // !window.myFunction
        // would not found, the below getScript doesn't seem to be found in global scope but should be
        // anyway browsers alone handle not duplicated functions or they are not because of not being in global scope
        // and the function has singleton call check
        // if (typeof myFunction=="undefined") {
        //     alert('dsad');
        // }

        $(document).ready(function () {
                //alert('xzx');
                $.getScript('<?php echo $helpers ?>', function () {
                    if (typeof regSelectComboWidgetHandlers != "undefined") {
                        regSelectComboWidgetHandlers();
                    } else {
                        // alert('none')
                    }
                    ;
                });


                //window.myFunction();
                //myFunction();
            }
        );




    </script>


    <th>
        <?php
        /**
         * @var ConfigObject $config
         */
        if (isset($columnsDefinition[$columnName]['filter']) || $config->getAllFilterable()) {
            //for debug
            echo '';
    ?>
            <script>
                //reg();
            </script>

            <input type="text" readonly data-column="<?php echo $columnName; ?>" class="filter" >
            <input type="text" readonly data-column="<?php echo $columnName; ?>" class="filterHidden disabled" name="filter[ids][<?php echo $columnName; ?>]" size=10
            style="visibility: hidden"
            >

            <br>

            <div style="position: relative">
                <select size=4" multiple=1
                        style="visibility:hidden; position: absolute; top: 0px"
                        name="selectSubmenu"
                        data-column="<?php echo $columnName; ?>"
                        class="filterSelect"
                >
                    <option value="1">aaa</option>
                     <option value="2">bbb</option>
                    <option value=3>  ccc</option>
                </select>
            </div>

            <input type="hidden" name="filter" class="select">

    <?php
        }
    ?>





    </th>

    <?php


}


?>


