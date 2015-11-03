var preArray = [1, 1, 2, 2, 3, 3, 4, 4, 5, 5, 6, 6, 7, 7, 8, 8];
var mainArray = [[1, 1, 2, 2], [3, 3, 4, 4], [5, 5, 6, 6], [7, 7, 8, 8]];
var index = 0;
var numTries = 0;
var indexFirst = "";
var indexSec = "";

Array.prototype.shuffle = function() {

	for (var i = preArray.length - 1; i > 0; i--)
	{
		var randomInd = Math.floor(Math.random() * (i+1));
		var itemAtIndex = preArray[randomInd];
		preArray[randomInd] = preArray[i];
		preArray[i] = itemAtIndex;
	}
	return preArray;
}

function insertingTable(){
    preArray.shuffle();
	for(var i = 0; i < 4; i++){
		for (var j = 0; j < 4; j++) {
			mainArray[i][j] = preArray[index];
			index++;
		}
	}
}

var click = 0;
var first_value;

function clicking(event) {
	var elt = event.currentTarget.id;
	var i = elt[1];
	var j = elt[2];
	var currentID = "m" + i.toString() + j.toString();
	var str = mainArray[i][j];
	document.getElementById("checkCode").value = document.getElementById(currentID).value;
	document.getElementById(currentID).value= str;
	//var item = document.getElementById(currentID).firstChild;
	$ ("#" + event.id).fadeTo(500, 1);

	//var txtnode = document.createTextNode(str);
	//var first_p = document.createElement('p');
	//first_p.innerHTML = str;
	//first_p.appendChild(txtnode);
	//var item = document.getElementById(currentID).childNodes[0];
	//var item = document.getElementById(currentID).childNodes[0];
	//item.appendChild(first_p);
	//item.appendChild(txtnode);


	//item.replaceChild(first_p, item.childNodes[0]);
	//.firstChild.data 
	document.getElementById("checkCode").value = document.getElementById(currentID).firstChild;
	click += 1;
    if (indexFirst.length == 0)
    {
    	indexFirst = currentID;
    	//if (click % 2 == 1){
		//	$ (document).ready(function() {
		//		$ ("#"+indexFirst+" p").fadeOut(3000);
		//});
			//indexFirst = "";
			first_value = str;
    	//}
	}
	else
    {
    	//document.getElementById("checkCode").value = first_value+" "+str;
    	indexSec = currentID;
    	checkMatching(indexFirst,indexSec,first_value,str);
    	indexFirst = "";
    	indexSec = "";
    	click = 0;
    }

}

function checkMatching(a, b, first_value, second_value) {
	document.getElementById("checkCode").value = a + b + first_value + second_value;
	
	var x1 = a[1];
	var y1 = a[2];
	var x2 = b[1];
	var y2 = b[2];

	if (mainArray[x1][y1] != mainArray[x2][y2])
	{
		$ (document).ready(function() {
			$ ("#"+a+" p").fadeOut(3000);
			$ ("#"+b+" p").fadeOut(3000);
		});



		//document.getElementById("checkCode").value = document.getElementById(a).firstChild;
		//var txtnode1 = document.createTextNode(first_value);
		//var txtnode2 = document.createTextNode(second_value);
		//document.getElementById(a).childNodes[0].appendChild(txtnode1);
		//document.getElementById(b).childNodes[0].appendChild(txtnode2);
		//var item = document.getElementById(a).childNodes[0];
		//var item = document.getElementById(b).childNodes[0];
		document.getElementById("checkCode").value = document.getElementById(a).innerHTML;
		//var first_p = document.createElement('p');
		//var second_p = document.createElement('p');
		//first_p.innerHTML = "";
		//second_p.innerHTML = "";
		//document.getElementById(a).appendChild(first_p);
		//document.getElementById(b).appendChild(second_p);
	}
}