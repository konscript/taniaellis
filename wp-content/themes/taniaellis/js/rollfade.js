/*
* Version: 1.0
*/

function rollFade(container, element, hidden, delay, duration) {

  // Start out by hiding all the elements if this is not done in the stylesheet.
  if(!hidden) {
    $(container).find(element).css('display', 'none');
  }

  // Find the first element and display it
  var firstElement = $(container).find(element).first();
  firstElement.css('display', 'block');

  // Define the inner function that does the fading
  function do_rollFade(fadeElement) {
    fadeElement.delay(delay).fadeOut(duration, function() {    // Fade out the element and call anonymous function
      var nextElement = fadeElement.next(element);  // find the next element
      if(nextElement.length == 0) {                 // If current element is last in the list, set next to first
        nextElement = firstElement;
      }
      nextElement.fadeIn(duration);                         // Fade in the next element
      do_rollFade(nextElement);                     // Call function recursively on next element.
    });
  }

  // Start roll fade. CONTINUES FOR EVAAAH!
  do_rollFade(firstElement);
}        
