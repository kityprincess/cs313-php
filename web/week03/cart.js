$(function() {
  $('.button').mouseover(function() {
    $(this).animate({opacity:1},200);
  })
  .mouseleave(function() {
    $(this).animate({opacity:.6},200);
  });
  $('#clearcart').click(function() {
    window.location.href= "browse.php?action=clearcart";
  });
  $('#checkout').click(function() {
    window.location.href= "checkout.php";
  });
  $('#browse').click(function() {
    window.location.href= "browse.php";
  });                 
  $('.rem_item').click(function() {
    var itemid = $(this).attr("id");
    var location = "cart.php?action=remitem&itemid="+itemid;
    window.location.href = location;
  });
  $('.rem_item').mouseover(function() {
   $(this).css("background-color","#CCC");
  })                                 
  .mouseleave(function() {
	$(this).css("background-color","transparent");
  });                    
});