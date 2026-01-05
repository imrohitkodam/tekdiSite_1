jQuery(document).ready(function () {
  
  
    var ypos = window.pageYOffset;
    if (ypos > 110) {
      jQuery('header').css({
        'height': 'auto',
        'padding': '0.875rem 0 0.5rem 0',
        'background': 'transparent'
      });
      jQuery('header').addClass("scrolled");
    }
    else {
      jQuery('header').css({
        'height': 105 + 'px',
        'padding': '1rem',
        'background': 'linear-gradient(180deg, rgba(4, 28, 59, 0.9) 10%, rgb(40 57 78 / 50%) 70%, rgba(12, 54, 109, 0) 100%)',
        'box-shadow': 'none',
      });
      jQuery('header').removeClass("scrolled");
    }

    window.addEventListener('scroll', customScroll);
    function customScroll() {
      var ypos = window.pageYOffset;
      if (ypos > 110) {
        jQuery('header').css({
          'height': 'auto',
          'padding': '0.875rem 0 0.5rem 0',
          'background': 'transparent'
        });
        jQuery('header').addClass("scrolled");
      }
      else {
        jQuery('header').css({
          'height': 105 + 'px',
          'padding': '1rem',
          'background': 'linear-gradient(180deg, rgba(4, 28, 59, 0.9) 10%, rgb(40 57 78 / 50%) 70%, rgba(12, 54, 109, 0) 100%)',
          'box-shadow': 'none',
        });
        jQuery('header').removeClass("scrolled");
      }
    }
  
  $(".item-123 .dropdown-menu li").click(function () {
    setTimeout(closehamburger, 150);

  });
  setTimeout(resourcesMessage, 150);
  function closehamburger() {
    $(".hamburger-toggle-block").removeClass("open");
    $(".hamburger-toggle-btn").removeClass("is-active");

  }
  function resourcesMessage() {
    var resourseheaderheight = $("#header").outerHeight();
    var resourcefixedbarheight = $(".fixed-top-bar").outerHeight();
    var systemmsg = $("#system-message-container").outerHeight();
    var systemmsgval = systemmsg + 42;
    console.log("systemmsg" + systemmsg);
    $("#system-message-container").css("top", resourcefixedbarheight + 48);

    $(".libary-article-content").css("margin-top", systemmsgval);

  }
  $(".joomla-alert--close").click(function () {
    $(".libary-article-content").css("margin-top", "42px");

  });

//   jQuery(".sppb-flipbox-panel").each(function() {
//     var $panel = jQuery(this);
//     var originalHeight = $panel.height(); // usually 280px
    
//     $panel.hover(
//         function () {
//             $panel.css({
//                 "height": "380px",
//                 "border": "none"
//             });
//         },
//         function () {
//             $panel.css({
//                 "height": originalHeight + "px",
                
//             });
//         }
//     );
// });

});
// jQuery(document).ready(function () {
//     function setStickyOffset() {
//         var bannerHeight = jQuery('#header').outerHeight();
//         console.log("Banner height:", bannerHeight); 
//         jQuery('#apply-now-section').css({
//             'position': 'sticky',
//             'top': bannerHeight + 'px',
//             'z-index' : '9'
//         });
//     }
    
//     setStickyOffset();
//     jQuery(window).resize(function () {
//         setStickyOffset();
//     });});


