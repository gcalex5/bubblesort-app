<?php
/**
 * 'index.php' Contains the logic required to run the single-page Bubble Sort web app
 * It is loaded whenever an end user navigates to the root directory of a web server or <root>/index.php
 * It is also called form 'js/ajax-calls.js'
 *
 * Created by Alex on 7/13/2016.
 */

//Open/Resume a session then instantiate/grab our instance of 'BubbleSortApp' and run the requested function(s).
//Then finally storing the data back in teh '$_SESSION' variable for the next operation
session_start();

if(isset($_POST['operation']) && !empty($_POST['operation'])){
  if($_POST['operation'] == 'shuffle'){
    $bubble_instance = new BubbleSortApp;
    $bubble_instance->initialize();
  }
  else if($_POST['operation'] == 'step'){
    $bubble_instance = $_SESSION['bubble_sort_app'];
    $bubble_instance->step();
  }
  else if($_POST['operation'] == 'play'){
    $bubble_instance = $_SESSION['bubble_sort_app'];
    $bubble_instance->play();
  }

  //If we get anything but one of those three operations something shady is going on so just return
  else{
    return;
  }

  if(isset($bubble_instance)){
    $_SESSION['bubble_sort_app'] = $bubble_instance;
  }
}

/**
 * Class BubbleSortApp
 *
 * The BubbleSortApp encapsulates all data tied to the Bubble Sort algorithm as well as echo'ing out the appropriate data
 * for 'js/ajax-calls.js' to redraw the table.
 * Known Bug: when echo'ing data back to the front-end we are sending ALL of the HTML contained in this file not just the
 * string we are attempting to output. A temporary workaround is in 'js/ajax-calls.js
 */
class BubbleSortApp {

  //Declaration of protected globals
  protected $integer_array = array(); //Array holding 10 integers to be sorted
  protected $cur_pos; //Current position we are at in the array
  protected $swap_counter=0; //Counter variable to determine if we've made a full pass

  /**
   * Initialize the data needed to run the sort
   */
  function initialize(){
    $this->setCurPos(0);
    $local_array = $this->getIntegerArray();
    for($x=0; $x<10; $x++){
      $local_array[$x] = rand(0, 100);
    }
    $this->setIntegerArray($local_array);
    $this->redraw_table();
  }

  /**
   * Run one round of the bubble sort algorithm
   *
   * Use the $cur_pos variable to compare the two values in the array.
   * Swap if the first value is higher. Call the function we are using to draw the table
   * in order to update it. Or call sort_finished to exit out of the algorithm.
   */
  function step(){
    $local_array = $this->getIntegerArray();
    $temp_counter = $this->getSwapCounter();
    if($this->getCurPos()+1 != 10){
      if($local_array[$this->getCurPos()] > $local_array[$this->getCurPos()+1]){
        $temp_counter++;
        $a = $local_array[$this->getCurPos()];
        $b = $local_array[$this->getCurPos()+1];
        $local_array[$this->getCurPos()] = $b;
        $local_array[$this->getCurPos()+1] = $a;
        $this->setIntegerArray($local_array);
        $this->setSwapCounter($temp_counter);
      }
    }
    //We are at the end of the array is 'step_counter' = 0? If not reset to 0 and try again.
    else{
      if($this->getSwapCounter() == 0){
        $this->sort_finished();
        return;
      }
      else{
        $this->setSwapCounter(0);
      }
    }
    $this->redraw_table();
  }

  /**
   *
   */
  function redraw_table(){
    if(sizeof($this->getIntegerArray())>0){
      $tmp='<table><thead><th>Bubble Sort Table</th></thead><tbody>';
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
   *
   */
  function sort_finished(){
    echo 'disable';
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

  /**
   * @return int
   */
  public function getSwapCounter()
  {
    return $this->swap_counter;
  }

  /**
   * @param int $swap_counter
   */
  public function setSwapCounter($swap_counter)
  {
    $this->swap_counter = $swap_counter;
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
  <div class="content">
    <div class="button-container">
      <button id="shuffle" type="button" onclick="ajaxCall('shuffle')">Shuffle</button>
      <button id="step" type="button" onclick="ajaxCall('step')" disabled="true">Step</button>
      <button id="play" type="play" onclick="ajaxCall('play')" disabled="true">Play</button>
    </div>
    <div class="bubblesort-container">
    </div>
  </div>

</div>
