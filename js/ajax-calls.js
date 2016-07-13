/**
 * Created by Alex on 7/13/2016.
 */

function ajaxCall(operation){
    $.ajax({
        type: "POST",
        url: "index.php",
        data: { operation: operation }
    });
}
