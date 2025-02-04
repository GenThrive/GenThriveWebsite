jQuery(document).ready(function() {

  var winwidth = jQuery( window ).width();

  let menuHight = jQuery("#stickyBar").height();

  gsap.set("#headerHero", {paddingTop:menuHight});

  //Begin Sticky Header
  let sticky_tl = gsap.timeline({
    paused: true,
    scrollTrigger: {
      trigger: "#heroWrapper",
      toggleActions: "play none reverse none",
      start: "top bottom+10",
      end: "+=5"
    }
  });

  sticky_tl.to(".headLogos", {height: "40px"}, 0)
  .to("#stickyBar", {backgroundColor: "#fff"}, 0)
  .to("#userNav", {autoAlpha: 0 }, 0)
  .to(".hasFeature #jr_head_logo_white", {autoAlpha:0, display:"none"}, 0)
  .to(".hasFeature #jr_head_logo", {autoAlpha:1, display:"block"}, 0)
  .to(".standard_nav .stand_menu_ul > .menu-item > a, .stand_menu_ul .menu-item-has-children span", {paddingTop: ".5rem", paddingBottom: ".5rem"}, 0)
  .to(".hasFeature .standard_nav .stand_menu_ul > .menu-item > a, .hasFeature .stand_menu_ul .menu-item-has-children span, .hasFeature #jr_menu_mobile.hamMenuWrapper .fas", {color: "#252525", textShadow: "none"}, 0);


  //Begin Standard Navigation
  jQuery.each(jQuery(".stand_menu_ul>.menu-item-has-children"), function(index, element) {
	var subMenu = jQuery(element).children('ul'),
  tl;

	if(subMenu.length != 0) {
		tl = new TimelineLite({paused:true});

		tl.from(subMenu, .2, {height:0, autoAlpha: 0});

		element.subMenuAnimation = tl;

		jQuery(element).hover(menuItemOver, menuItemOut);
	}
});

function menuItemOver(e) {
  this.subMenuAnimation.play();
}

function menuItemOut(e) {
	this.subMenuAnimation.reverse();
}

    //   //begin fancy mobile menu
    //   if (winwidth < 576 ) {
    //
    //     let mobile_menu = gsap.timeline({
    //       scrollTrigger: {
    //         trigger: "#site_content",
    //         toggleActions: "play none none none",
    //         start: "top top",
    //         end: "bottom bottom",
    //         onUpdate: (self) => {
    //             if(self.direction == -1){
    //               mobile_menu.reverse();
    //             } else if (self.direction == 1){
    //               mobile_menu.play();
    //             }
    //         }
    //
    //       }
    //     });
    //
    //     mobile_menu.to("#menu_items", { duration: 1, bottom: -400 });
    //
    // }//end width check

    var mm1 = new TimelineMax();
        mm1.set(jQuery('body'), {overflow: 'hidden'})
        mm1.set(jQuery('#mobile_jr_menu'), {display: 'flex'})
        mm1.from(jQuery('.inner_jr_mobile'), .75, {x:'+=400'});
        mm1.pause();


    jQuery( ".links_mm_1" ).each(function( index, element ) {
      var activeout = gsap.timeline({paused:true});
          activeout.to(jQuery( this ).find( '.active' ), .5, {autoAlpha:1})
          .to(jQuery( this ).find( '.img_collapsed' ), .5, {autoAlpha:0}, 0);

          element.animation = activeout;
        });

    jQuery( ".links_mm_1" ).click(function() {


      if ( jQuery( this ).hasClass( "collapsed" ) ) {


          jQuery( ".links_mm_1" ).each(function( ) {
                this.animation.reverse();
              });

          this.animation.play();

        } else {

          this.animation.reverse();

        }

      });

    jQuery("#mobile_jr_menu").click
    (
    function(e) {
      if(jQuery(e.target).closest('.inner_jr_mobile').length == 0) {
      {
        mm1.reverse();
      }
    }});

    jQuery("#menu_front").click( function () {
      open_menu.play();
    });

    jQuery("#menu_back").click( function () {
      open_menu.reverse();
    });


    jQuery('#jr_menu_mobile').click(function() {
          mm1.play();
        });

    jQuery("#mobile_m_close").click(function(e) {
        mm1.reverse();
    });

//end fancy mobile menu

  });
