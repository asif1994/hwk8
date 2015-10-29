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

var checkTable = [[0,0,0,0],[0,0,0,0],[0,0,0,0]];
function allowDrop(event) {
    event.preventDefault();
}

function drag(event) {
    event.dataTransfer.setData("image", event.target.id);
}

function drop(event) {
    event.preventDefault();
    var data = event.dataTransfer.getData("image");
    var str = event.currentTarget.id;
    var i = parseInt(str[1]);
    var j = parseInt(str[2]);

    if (checkTable[i][j] == 0){
      event.currentTarget.appendChild(document.getElementById(data));
      checkTable[i][j] = 1;
      document.getElementById("works").value = checkTable;
    } else {
      
      event.currentTarget.replaceChild(document.getElementById(data), document.getElementById(event.currentTarget).id.src);
      document.getElementById("works").value = event.currentTarget.id;
    /*event.currentTarget.appendChild(document.getElementById(data));*/

  }
}