 var box;
 var random_nums = [1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8]
 var numbers = [[1,1],[2,2],[3,3],[4,4],[5,5],[6,6],[7,7],[8,8]];
 var index = 0;
 random_nums.sort(function() { return 0.5 - Math.random() });		

 function assign_num() {
 	for (var i=0; i<1; i++) {
 		for (var j=0; j<4; j++) {
 			box = document.getElementById("b"+i.toString()+j.toString());
 			box.value = random_nums[index];
	  		index += 1;
	  		
	  	}
	  }
	}

