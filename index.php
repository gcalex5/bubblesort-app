<?php
/**
 * Front page of bubble sort app
 * User: Alex
 * Date: 7/13/2016
 * Time: 9:28 AM
 */

//Initial requirements list
//TODO: Application should visually display the algorithm for a vector of 10 integers
//TODO: Two buttons are required Shuffle and Step
//TODO: Shuffle -> Initialize array with 10 random integers between 0 and 100
//TODO: Step -> Step performs one step of the algorithm and displays it on the page
//TODO: Display array as table with 10 rows
//TODO: Each row will contain a colored rectangle corresponding to the number
//TODO: When step is pressed the two numbers being compared should be highlighted with a different color
//TODO: Continually pressing step with sort the numbers from largest(top of page) to smalled(bottom of page)
//TODO: When sort is finished hide or disable the button
//TODO: All processing needs to be done on the server
//TODO: BONUS: Play button that simulates steps, reloads the table using AJAX calls
//TODO: BONUS: Drupal module: configurable, dedicated path, etc.

if(isset($_POST['operation']) && !empty($_POST['operation'])){
  if($_POST['operation'] == 'shuffle'){
    initialize();
  }
  else if($_POST['operation'] == 'step'){
    step();
  }
  else if($_POST['operation'] == 'play'){
    play();
  }
  else{
    echo 'Critical Error';
  }
}

/**
 * Initialize an array of ten random integers.
 * Will also need to clear out any data we're holding in the session
 */
function initialize(){

}

/**
 * Run one round of the bubble sort algorithm
 */
function step(){
}

/**
 * Run bubble sort to completion at one second steps
 */
function play(){
}

/**
 * Bubble sort algorithm
 */
function bubble_sort(){
}

?>
<!-- Import Jquery via CDN -->
<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/ajax-calls.js"></script>
<div class="container">
  <div class="hero">
    <h1>Bubble Sort Coding Challenge</h1>
  </div>
  <button id="shuffle" type="button" onclick="ajaxCall('shuffle')">Shuffle</button>
  <button id="step" type="button" onclick="ajaxCall('step')">Step</button>
  <button id="play" type="play" onclick="ajaxCall('play')">Play</button>

  <div class="bubblesort-display">
    <table>
      <thead>
      <tr>
        <th>Bubble Sort!</th>
      </tr>
      </thead>
      <tr>
        <td>Empty At The Moment</td>
      </tr>
    </table>
  </div>
</div>
