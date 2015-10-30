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

/*
 Define variables for the values computed by the grabber event 
 handler but needed by mover event handler
*/
var diffX, diffY, theElement;


<<<<<<< HEAD
// The event handler function for grabbing the word
function grabber(event) {

// Set the global variable for the element to be moved

  theElement = event.currentTarget;

// Determine the position of the word to be grabbed,
//  first removing the units from left and top

  var posX = parseInt(theElement.style.left);
  var posY = parseInt(theElement.style.top);

// Compute the difference between where it is and
// where the mouse click occurred

  diffX = event.clientX - posX;
  diffY = event.clientY - posY;

// Now register the event handlers for moving and
// dropping the word

  document.addEventListener("mousemove", mover, true);
  document.addEventListener("mouseup", dropper, true);

// Stop propagation of the event and stop any default
// browser action

  event.stopPropagation();
  event.preventDefault();

}  //** end of grabber

// *******************************************************

// The event handler function for moving the word

function mover(event) {
// Compute the new position, add the units, and move the word

  theElement.style.left = (event.clientX - diffX) + "px";
  theElement.style.top = (event.clientY - diffY) + "px";

// Prevent propagation of the event

  event.stopPropagation();
}  //** end of mover

// *********************************************************
// The event handler function for dropping the word

function dropper(event) {

// Unregister the event handlers for mouseup and mousemove

  document.removeEventListener("mouseup", dropper, true);
  document.removeEventListener("mousemove", mover, true);

// Prevent propagation of the event

  event.stopPropagation();
}  //** end of dropper
=======
function drop(event) {
    event.preventDefault();
    var data = event.dataTransfer.getData("image");
    var str = event.currentTarget.id;
    var i = parseInt(str[1]);
    var j = parseInt(str[2]);

    if (checkTable[i][j] == 0){
      /*event.currentTarget.appendChild(document.getElementById(data));*/
      event.currentTarget.src = event.currentTarget.appendChild(document.getElementById(data));
      checkTable[i][j] = 1;
      document.getElementById("works").value = "if";
    } else {
      var old_img = event.currentTarget.src;
      event.currentTarget.replaceChild(document.getElementById(data), event.currentTarget.src);
      
      document.getElementById("works").value =document.getElementById("d0");
     document.getElementById("d0") = old_img;
      
    /*event.currentTarget.appendChild(document.getElementById(data));*/

  }
}
>>>>>>> d4e5caf99a946962087ab52c13021e2c327eba5d
