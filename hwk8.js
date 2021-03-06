var images1 = ["./images1/img1-1.jpg", "./images1/img1-2.jpg",
               "./images1/img1-3.jpg", "./images1/img1-4.jpg",
               "./images1/img1-5.jpg", "./images1/img1-6.jpg",
               "./images1/img1-7.jpg", "./images1/img1-8.jpg",
               "./images1/img1-9.jpg", "./images1/img1-10.jpg",
               "./images1/img1-11.jpg", "./images1/img1-12.jpg"];

var images2 = ["./images2/img2-1.jpg", "./images2/img2-2.jpg",
               "./images2/img2-3.jpg", "./images2/img2-4.jpg",
               "./images2/img2-5.jpg", "./images2/img2-6.jpg",
               "./images2/img2-7.jpg", "./images2/img2-8.jpg",
               "./images2/img2-9.jpg", "./images2/img2-10.jpg",
               "./images2/img2-11.jpg", "./images2/img2-12.jpg"];

var images3 = ["./images3/img3-1.jpg", "./images3/img3-2.jpg",
               "./images3/img3-3.jpg", "./images3/img3-4.jpg",
               "./images3/img3-5.jpg", "./images3/img3-6.jpg",
               "./images3/img3-7.jpg", "./images3/img3-8.jpg",
               "./images3/img3-9.jpg", "./images3/img3-10.jpg",
               "./images3/img3-11.jpg", "./images3/img3-12.jpg"];

function assign_img() {
	var img_sets = [images1, images2, images3];
	var img_index = Math.floor((Math.random() * 3));
	var i = 0;
	var checking = [0,0,0,0,0,0,0,0,0,0,0,0];
	while (i<12){
		var index = Math.floor((Math.random() * 12));
		if (checking[index] == 0){
			checking[index] = 1;
			var s = document.getElementById("d" + i.toString());
			s.src = img_sets[img_index][index];
			i+=1;
		}
	}
}

var recording = true;
var elapsed = 0;
var minutes = 0;
var second = 0;
var stringMin = "";
var stringSec = "";

function Timer() {
  setInterval("countTime()",1000);
}

function countTime() {
  if (recording == true) {
    minutes = Math.floor(elapsed/60);
    second = elapsed - minutes*60;}
    if (minutes < 10) { stringMin = "0" + minutes.toString()} else {stringMin = minutes.toString()}
    if (second < 10) { stringSec = "0" + second.toString()} else {stringSec = second.toString()}
    document.getElementById("timer").innerHTML = stringMin + ":" + stringSec;
    elapsed++;
}

function stop() {
  recording = false;
  document.getElementById("txt").value = "The time it took you to finish the puzzle is: " 
  + stringMin + " minutes " + stringSec + " seconds";
}


var diffX, diffY, theElement;

function grabber(event) {

  theElement = event.currentTarget;

  var posX = parseInt(theElement.style.left);
  var posY = parseInt(theElement.style.top);

  diffX = event.clientX - posX;
  diffY = event.clientY - posY;

  document.addEventListener("mousemove", mover, true);
  document.addEventListener("mouseup", dropper, true);

  event.stopPropagation();
  event.preventDefault();

}

function mover(event) {

  theElement.style.left = (event.clientX - diffX) + "px";
  theElement.style.top = (event.clientY - diffY) + "px";

  event.stopPropagation();
}

function dropper(event) {
  placing(event);

  document.removeEventListener("mouseup", dropper, true);
  document.removeEventListener("mousemove", mover, true);

  event.stopPropagation();
}

function placing(event) {
    if ((event.clientY > 50) && (event.clientY < 350) && (event.clientX > 500) && (event.clientX < 900)) {
        theElement.style.left = (Math.floor(event.clientX / 100) * 100) + "px";
        theElement.style.top = ((Math.floor((event.clientY - 50) / 100) * 100) + 50) + "px";
    }
}