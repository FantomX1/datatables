<?php

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



