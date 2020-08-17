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


// @TODO: add common iterator collection to always list the common number without _prefix and
// the same number of cells in data if the header would have different number of items eg count col, etc
// even when it is omitted
foreach ($header as $columnName => $column) {

    if (strpos($columnName,'_') === 0) {
        continue;
    }

    ?>

    <th>
        <?php
        /**
         * @var ConfigObject $config
         */
        if (!empty($columnsDefinition[$columnName]->filter) || $config->getAllFilterable()) {
            //for debug
            echo '';



            switch ($columnsDefinition[$columnName]->filter->type) {


                case 'select':

    ?>


    <?php

                    $filterName  = $filterConf['filterField']['name'];
                    $idsField    = $filterConf['filterField']['ids'];
                    $valuesField = $filterConf['filterField']['values'];

                    //(new \fantomx1\datatables\customWidgets\selectFilterWidget\SelectFilterWidget())
                    (new \fantomx1\lightweightUntypableCombobox\lightweightUntypableCombobox())
                        ->appendCustomHtml('<input type=submit value="filter" name="doFilter" class="button">')
                        ->run(
                                $columnName,
                                $columnsDefinition[$columnName]->filter->getData()
                                ,
        //                    "filter",
                            $filterName,
                                $filterConf['filtering'][$valuesField][$columnName] ?? '',
                            $filterConf['filtering'][$idsField][$columnName] ?? ''
                        );

                    break;


                case 'text':


                    // @TODO:
                    ?>

                    <input type="text">

                    <?php


                    break;
            }





        }
    ?>





    </th>

    <?php


}


?>


