/**
 * ajax-calls.js handles making the AJAX calls to 'index.php'
 * Whenever the 'shuffle/step/play buttons are pushed it will relay that to the server
 * Which will then handle generating the necessary data.
 * 
 * Created by Alex on 7/13/2016.
 */

/**
 * This function is in charge of determining if we are done with the sort.
 * As well as enabling the Step/Play buttons and making the AJAX call the appropriate amount of times
 *
 * @param operation -> The operation that we are passing into 'index.php'
 */
//var timeoutVar = 0; //Timeout variable for 'play' option.
var done_yet = false; //Tester variable to see if we are done sorting.
function ajaxCall(operation) {
    document.getElementById("step").disabled = false;
    document.getElementById("play").disabled = false;

    //If 'play' was pressed run the algorithm to completion
    if (operation == "play") {
        document.getElementById("step").disabled = true;
        document.getElementById("play").disabled = true;
        for(var x=0; x<100; x++){
            bubbleSortCall("step");
            if(done_yet == true){
                break;
            }
        }
    }
    else if (operation == "step" || operation == "shuffle" ){
        bubbleSortCall(operation);
    }
}

//TODO: Experiment with this code everything appears to be executing in batches
/**
 * Special handler for 'Play' to slow it down a little

function playCalls(){
    timeoutVar = setTimeout(playCalls, 500);
    bubbleSortCall("step"); // Testing variable to see if we are done sorting
    if(done_yet == undefined || done_yet == false){
        console.log(timeoutVar + " " + done_yet);
    }
    else if(done_yet == true){
        stopPlayCalls();
    }

}

/**
 * Stop the infinite loop created with setTimeout()

function stopPlayCalls(){
    clearTimeout(timeoutVar);
}
**/
/**
 * Calls the Bubble Sort Algorithm
 *
 * Result will either be an HTML table for us to append to the bubblesort-container DIV or it will return
 * 'disable' to trigger a 'win/finished condition'
 *
 * @param operation -> The operation that we are passing into 'index.php'
 */


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
        if(trimmed_result.toString() == "disable"){
            document.getElementById("step").disabled = true;
            document.getElementById("play").disabled = true;
            done_yet = true;
        }
        else{
            $(".bubblesort-container").empty().append(trimmed_result);
            done_yet = false;
        }
    });
}