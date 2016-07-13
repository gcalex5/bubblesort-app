<?php
/**
 *
 */
//Initial requirements list
//TODO: Application should visually display the algorithm for a vector of 10 integers
//TODO: Step -> Step performs one step of the algorithm and displays it on the page
//TODO: Display array as table with 10 rows
//TODO: Each row will contain a colored rectangle corresponding to the number
//TODO: When step is pressed the two numbers being compared should be highlighted with a different color
//TODO: Continually pressing step will sort the numbers from largest(top of page) to smalled(bottom of page)
//TODO: When sort is finished hide or disable the button
//TODO: All processing needs to be done on the server
//TODO: BONUS: Play button that simulates steps, reloads the table using AJAX calls
//TODO: BONUS: Drupal module: configurable, dedicated path, etc.
//TODO: Documentation cleanup

//Open/Resume a session so we can access the $_SESSION
session_start();
//See what the enduser has requested of us
if(isset($_POST['operation']) && !empty($_POST['operation'])){
  //Create or grab an instance of the app and execute the requested function
  if($_POST['operation'] == 'shuffle'){
    $bubble_instance = new BubbleSortApp;
    $bubble_instance->initialize();
    //TODO: Enable Step/Play buttons
  }
  else if($_POST['operation'] == 'step'){
    $bubble_instance = $_SESSION['bubble_sort_app'];
    $bubble_instance->step();
  }
  else if($_POST['operation'] == 'play'){
    $bubble_instance = $_SESSION['bubble_sort_app'];
    $bubble_instance->play();
  }
  //If we get anything but one of those three operations something shady is going on
  else{
    return;
  }

  //Store our instance of the app in the $_SESSION variable for the next AJAX call
  if(isset($bubble_instance)){
    $_SESSION['bubble_sort_app'] = $bubble_instance;
  }
}

class BubbleSortApp {
  protected $integer_array = array(); //Array holding 10 integers to be sorted
  protected $cur_pos; //Current position we are at in the array

  /**
   * Initialize an array of ten random integers.
   * Will also need to clear out any data we're holding in the session
   */
  function initialize(){
    //TODO: Enable Step/Play Buttons
    $this->setCurPos(0);
    $local_array = $this->getIntegerArray();
    for($x=0; $x<10; $x++){
      $local_array[$x] = rand(0, 100);
    }
    $this->setIntegerArray($local_array);
    $this->redraw_table();
  }

  /**
   * Run bubble sort to completion at one second steps
   */
  function play(){
    //TODO: Disable Step/Play after hitting play
  }

  /**
   * Run one round of the bubble sort algorithm
   *
   * Use the $cur_pos variable to compare the two values in the array.
   * Swap if the lower value is higher. Call the function we are using to draw the table
   * in order to update it.
   */
  function step(){
    $local_array = $this->getIntegerArray();
    if($this->getCurPos()+1 != 10){
      if($local_array[$this->getCurPos()] > $local_array[$this->getCurPos()+1]){
        $a = $local_array[$this->getCurPos()];
        $b = $local_array[$this->getCurPos()+1];
        $local_array[$this->getCurPos()] = $b;
        $local_array[$this->getCurPos()+1] = $a;
        $this->setIntegerArray($local_array);
      }
    }
    $this->redraw_table();
    //TODO: Add an 'win condition'
    //TODO: After 'win condition' disable Step/Play
  }

  function redraw_table(){
    if(sizeof($this->getIntegerArray())>0){
      $tmp='<table><thead><th>BUBBLE SORT</th></thead><tbody>';
      for ($x=0; $x<10; $x++) {
        if ($x == $this->getCurPos() || $x == ($this->getCurPos() + 1)){
          $tmp .= '<tr class="highlighted-row"><td>' . $this->getIntegerArray()[$x] . '</td></tr>';
        }
        else{
          $tmp .= '<tr><td>' . $this->getIntegerArray()[$x] . '</td></tr>';
        }
      }

      $tmp.='</tbody></table>';
      echo $tmp;
      if($this->getCurPos() == 9){
        $this->setCurPos(0);
      }
      else{
        $this->setCurPos($this->getCurPos()+ 1);
      }
    }
    //Otherwise go back where we came from
    else{
      return;
    }
  }

  /**
   * @return array
   */
  public function getIntegerArray()
  {
    return $this->integer_array;
  }

  /**
   * @return mixed
   */
  public function getCurPos()
  {
    return $this->cur_pos;
  }

  /**
   * @param array $integer_array
   */
  public function setIntegerArray($integer_array)
  {
    $this->integer_array = $integer_array;
  }

  /**
   * @param mixed $cur_pos
   */
  public function setCurPos($cur_pos)
  {
    $this->cur_pos = $cur_pos;
  }


}
?>

<link rel="stylesheet" type="text/css" href="css/style.css">
<!-- Import Jquery via CDN -->
<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/ajax-calls.js"></script>
<div class="container">
  <div class="hero">
    <h1>Bubble Sort Coding Challenge</h1>
  </div>
  <div class="button-container">
    <button id="shuffle" type="button" onclick="ajaxCall('shuffle')">Shuffle</button>
    <button id="step" type="button" onclick="ajaxCall('step')">Step</button>
    <button id="play" type="play" onclick="ajaxCall('play')">Play</button>
  </div>
  <div class="bubblesort-container">
  </div>
</div>
