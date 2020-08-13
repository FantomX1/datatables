

// window.myFunction=function() {
//     alert('asdasd');
// }

function regSelectComboWidgetHandlers(){

     //alert('asdsa');

    // allow executing only once
    if( typeof regSelectComboWidgetHandlers.was == 'undefined' ) {
        regSelectComboWidgetHandlers.was = 0;
    }


    if (regSelectComboWidgetHandlers.was) {
        return;
    }

    regSelectComboWidgetHandlers.was =1;

    $('html').on('click',
        function(event){
            //console.log();
            //console.log($(this));



            var par = $(event.target).parent();
            //alert(par[0].classList);
            // alert(
            //     !$(event.target).parent().hasClass('filterSelect')
            // );

            if (!par.hasClass('filterSelect')) {
                $('select.filterSelect').css('visibility', 'hidden');
            }
        }
    );

    //$('input[type=text].filter').each(function() {
    $('input[type=text].filter').click(function(event) {
            //alert($(this).data('column'))
            //alert($('select[data-column='+$(this).data('column')));
            // data could go as well as a class

            event.stopPropagation(); // not to bubble to html

            //alert( $('select[data-column='+$(this).data('column')));
            var el = $('select.filterSelect[data-column='+$(this).data('column'));
            // console.log(
            //     el
            // );
            //alert(el);
            el.css('visibility', 'visible');
            //$('select[data-column='+$(this).data('column')).attr('size',4);
            //$('select[data-column='+$(this).data('column')).click();

        }
    );



    $('select.filterSelect').change(function() {
        //alert('dasd');

        //$(this).find(":selected").each(function(){alert($(this))});
        //$(this).find(":selected").each(function(){alert($(this))});
        //alert($(this).find(":selected").each);

        //
        var allText = $(this).find(":selected").map(function(){
                return $(this).text();
            }).get(),
            allText = allText.join(',');

        var allTextHidden = $(this).find(":selected").map(function(){
                return $(this).val();
            }).get(),
            allTextHidden = allTextHidden.join(',');


        // var allTextPrior $(this).find(":selected").map(function(){
        //     return $(this).text();
        // }).get();
        //
        // var allText = allTextPrior.join(',');

        //alert(allText);

        //$('select[data-column='+$(this).data('column'));
        $('input.filter[data-column='+$(this).data('column')).val(allText);
        $('input.filterHidden[data-column='+$(this).data('column')).val(allTextHidden);
        //alert('dasd');
        // alert(
        //     $('input.filter[data-column='+$(this).data('column'))
        // );


    });


    // alert($(document));
}

//window.myFunction();

//myFunction();
// if (!window.myFunction) {
//     window.myFunction = function() {
//         //...
//         alert('helpers');
//     }
// }

