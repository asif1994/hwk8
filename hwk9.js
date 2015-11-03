 var box;
 var random_nums = [1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8]
 var index = 0;
 
Array.prototype.shuffle = function() {

	for (var x = random_nums.length - 1; x > 0; x--)
	{
		var rndmnum = Math.floor(Math.random() * (x+1));
		var item = random_nums[rndmnum];
		random_nums[rndmnum] = random_nums[x];
		random_nums[x] = item;
	}
	return random_nums;
}

function assign_num(){
    random_nums.shuffle();
	for(var i = 0; i < 4; i++){
		for (var j = 0; j < 4; j++) {
 			box = document.getElementById("b"+i.toString()+j.toString());
 			box.value = random_nums[index];
	  		index += 1;
		}
	}
}

