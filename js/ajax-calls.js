/**
 * Generic all purpose call to index.php
 * Handles Shuffle, Step, and Play. If anything else is passed in the 'else'
 * statement will take over and just return resulting in nothing occurring.
 * Created by Alex on 7/13/2016.
 */

function ajaxCall(operation) {
    var done_yet = false; // Testing variable to see if we are done sorting
    //Enable elements since initialized has been pressed if we are here
    document.getElementById("step").disabled = false;
    document.getElementById("play").disabled = false;

    //If 'play' was pressed run the algorithm to completion else run one step
    if (operation == "play") {
        for(var x=0; x<100; x++){
            done_yet = setTimeout(bubbleSortCall("step"), 10000000);
            if(done_yet == true){
                break;
            }
        }
    }
    else if (operation == "step" || operation == "shuffle" ){
        bubbleSortCall(operation);
    }
}

function bubbleSortCall(operation){
    $.ajax({
        type: "POST",
        url: "index.php",
        data: { operation: operation }
    }).done(function(result) {
        //Fix for the program attempting to output the rest of HTML from the index.php file whenever the AJAX result is appended
        //A more elegant solution is needed because this will not guarantee 100% compatibility on all machines.
        var doctored_output = result.split("<link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css\">");
        var trimmed_result = doctored_output[0].toString();
        trimmed_result = trimmed_result.trim();
        console.log(trimmed_result);
        if(trimmed_result == "disable"){
            document.getElementById("step").disabled = true;
            document.getElementById("play").disabled = true;
            return false;
        }
        else{
            $(".bubblesort-container").empty().append(trimmed_result);
        }
    });
}
