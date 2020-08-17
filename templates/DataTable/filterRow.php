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



        // !window.myFunction
        // would not found, the below getScript doesn't seem to be found in global scope but should be
        // anyway browsers alone handle not duplicated functions or they are not because of not being in global scope
        // and the function has singleton call check
        // if (typeof myFunction=="undefined") {
        //     alert('dsad');
        // }

        //$(document).ready(function () {
        //        //alert('xzx');
        //        $.getScript('<?php //echo  $assetsHandler->getAssetsDir("", '').'/assets/js/helpers.js' ?>//', function () {
        //            if (typeof regSelectComboWidgetHandlers != "undefined") {
        //                regSelectComboWidgetHandlers();
        //            } else {
        //                // alert('none')
        //            }
        //            ;
        //        });
        //
        //
        //        //window.myFunction();
        //        //myFunction();
        //    }
        //);




    </script>


    <th>
        <?php
        /**
         * @var ConfigObject $config
         */
        if (!empty($columnsDefinition[$columnName]->filter) || $config->getAllFilterable()) {
            //for debug
            echo '';
    ?>
            <script>
                //reg();
            </script>

    <?php

            $filterName = $filterConf['filterField']['name'];
            $idsField = $filterConf['filterField']['ids'];
            $valuesField = $filterConf['filterField']['values'];

            //(new \fantomx1\datatables\customWidgets\selectFilterWidget\SelectFilterWidget())
            (new \fantomx1\lightweightUntypableCombobox\lightweightUntypableCombobox())
                ->appendCustomHtml('<input type=submit value="filter" name="doFilter" class="button">')
                ->run(
                        $columnName,
                        [
                            '1' => 'aaa',
                            '2' => 'bbb',
                            '3' => 'ccc',
                        ],
//                    "filter",
                    $filterName,
                        $filterConf['filtering'][$valuesField][$columnName] ?? '',
                    $filterConf['filtering'][$idsField][$columnName] ?? ''
                );
        }
    ?>





    </th>

    <?php


}


?>


