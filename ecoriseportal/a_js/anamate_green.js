jQuery( document ).ready(function() {

  gsap.registerPlugin(ScrollTrigger);

  if (jQuery(".green_none").length) {
  gsap.set('.green_none', {visibility:'visible'});
  }
  
  var winwidth = jQuery( window ).width();

}); //end jQuery onLoad
