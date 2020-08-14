<script type="text/javascript">


    $(document).ready(function () {
            //alert('xzx');
            $.getScript('<?php echo  (new \fantomx1\PackagesAssetsSupport())->getAssetsDir("", '')
                .'/customWidgets/selectFilterWidget/assets/js/helpers.js' ?>', function () {
                if (typeof regSelectComboWidgetHandlers != "undefined") {
                    regSelectComboWidgetHandlers();
                } else {
                    // alert('none')
                };
            });


            //window.myFunction();
            //myFunction();
        }
    );


</script>


<input type="text" readonly data-column="<?php echo $groupId; ?>" class="filter" name="<?php echo $name ?>[values][<?php echo $groupId; ?>]">
<!--<input type="text" readonly data-column="--><?php //echo $columnName; ?><!--" class="filterHidden disabled" name="filter[ids][--><?php //echo $columnName; ?><!--]" size=10-->
<input type="text" readonly data-column="<?php echo $groupId; ?>" class="filterHidden disabled" name="<?php echo $name ?>[ids][<?php echo $groupId; ?>]" size=10
       style="visibility: hidden"
>

<br>

<div style="position: relative">
    <select size=4" multiple=1
            style="visibility:hidden; position: absolute; top: 0px"
            name="selectSubmenu"
            data-column="<?php echo $groupId; ?>"
            class="filterSelect"
    >

        <?php

            foreach ($data as $index => $value) {
                ?>
                <option value="<?php echo $index ?>"><?php echo $value ?></option>
                <?php
            }
        ?>
    </select>
</div>

<input type="hidden" name="filter" class="select">
