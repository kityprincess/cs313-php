$(function() {
  $('.button').mouseover(function() {
    $(this).animate({opacity:1},200);
  })
  .mouseleave(function() {
    $(this).animate({opacity:.6},200);
  });
  $('.disp_item').click(function() {
    var itemid = $(this).attr("id");
    var location = "browse.php?action=additem&itemid="+itemid;
    window.location.href = location;
  });
  $('.disp_item').mouseover(function() {
    $(this).css("background-color","#CCC");
  })
  .mouseleave(function() {
    $(this).css("background-color","transparent");
  });
  $('#clearcart').click(function() {
    window.location.href= "browse.php?action=clearcart";
  });
  $('#cart').click(function() {
    window.location.href= "cart.php";
  });
});