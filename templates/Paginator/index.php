<style>
    div.pagination div.pagination-item {padding: 2px; float: left}
</style>

<script>

//     window.onload = function(){
//         // Code. . .
//
//
//         jQuery( ".onPageSelect" ).change(function() {
//
//             //alert(window.location);
//             //var url = new URL('http://demourl.com/path?id=100&topic=main');
//             var url = new URL(window.location);
//             var search_params = url.searchParams;
//
// // new value of "id" is set to "101"
//             search_params.set('perPage', jQuery(this).val());
//
// // change the search property of the main url
//             url.search = search_params.toString();
//
// // the new url string
//             var new_url = url.toString();
//
// // output : http://demourl.com/path?id=101&topic=main
//             console.log(new_url);
//
//             // alert(new_url);
//             //
//             // alert(jQuery(this).val());
//             // alert( "Handler for .change() called." );
//
//             window.location.href = new_url;a
//         });
//     }
//
//

</script>

Per page:

<?php


    include "onPageDropdownElement.php";

?>



<div class="pagination">
    <?php
    for ($i = 1; $i<=$pages; $i++) {

        $class = $i == $page ? 'btn-info':'btn-danger';
        ?>
        <a href="?page=<?php echo $i ?>">
            <div class="<?php echo $class; ?> pagination-item">

                <?php echo $i; ?>.&nbsp;


            </div>
        </a>
        &nbsp;&nbsp;

        <?php
    }
    ?>

</div>
