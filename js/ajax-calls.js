/**
 * Generic all purpose call to index.php
 * Handles Shuffle, Step, and Play. If anything else is passed in the 'else'
 * statement will take over and just return resulting in nothing occurring.
 * Created by Alex on 7/13/2016.
 */

function ajaxCall(operation){
    $.ajax({
        type: "POST",
        url: "index.php",
        data: { operation: operation }
    }).done(function(result){
        console.log(result);
        $(".bubblesort-container").empty();
        $(".bubblesort-container").append(result);
    });

}
