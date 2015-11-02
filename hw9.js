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

function clicking(event) {
	var elt = event.currentTarget.id;
	var i = elt[1];
	var j = elt[2];
	var currentID = "m" + i.toString() + j.toString();
	var str = mainArray[i][j].toString();
	document.getElementById(currentID).innerHTML = str;
    if (indexFirst.length == 0)
    {
    	indexFirst = currentID;
    }
    else
    {
    	indexSec = currentID;
    	checkMatching(indexFirst,indexSec);
    	indexFirst = "";
    	indexSec = "";
    }
}

function checkMatching(a, b) {
	var x1 = a[1];
	var y1 = a[2];
	var x2 = b[1];
	var y2 = b[2];
	if (mainArray[x1][y1] != mainArray[x2][y2])
	{
		$ (document).ready(function() {
			$ ("#"+a).fadeOut(3000);
			$ ("#"+b).fadeOut(3000);
		});
	}
}

function myTimer() {
	var i = indexFirst[1];
	var j = indexFirst[2];
	var str = mainArray[i][j].toString();
    document.getElementById(indexFirst).innerHTML = str;
}