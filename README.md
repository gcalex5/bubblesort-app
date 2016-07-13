# bubblesort-app
Single-Page Bubblesort App

Basic bubblesort coding challenge
Single page webapp that displays a bubble sort of 10 integers between 0 and 100.

Instructions:
3 buttons are displayed whenever you navigate to wherever you place the application.
Shuffle: Initializes an array of 10 integers, draws the table, and enables the 'Step' and 'Play' buttons.
Step: Does one comparison and then redraws the table.
Play: Runs the sort to completion, redraws the table after each step.

Installation:
1: Download the zipped directory and decompress in an empty directory to ensure no conflicts.
2: Navigate to url/directory_containing_the_files/index.php

Known Issues: 
1:Dependent upon your environment clicking the buttons may cause them to 'lag' or not fuction, to resolve this wait at least half a second inbetween button clicks.
2:The echo'ed code that is used via AJAX call to redraw the table is accompanied by the rest of the HTML present in 'index.php', my current workaround is to just snip it at the first <link> tag that immediately follows the <table> markup
