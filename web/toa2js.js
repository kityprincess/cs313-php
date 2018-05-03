function clicked() {
  alert("Clicked!");
}

function changeColor(textColor) {
	//var textColor = document.getElementById("textColor").value;
	//var backColor = document.getElementById("backColor").value;

	var textColor = $("#textColor").val();
	var backColor = $("#backColor").val();

	$(".one").css("color", textColor);
	$(".one").css("background-color", backColor);
	//document.getElementById("one").style.color = textColor;
	//document.getElementById("one").style.background = backColor;
}

function fade() {
	$(".three").hide(3000).show(3000);
}