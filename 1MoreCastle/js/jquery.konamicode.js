/**
 * @author Andrew Carreiro
 */
var KonamiCode = function(linkedfn){
	var sequence = new Array(38,38,40,40,37,39,37,39,66,65,13);
	var position = 0;
	window.onkeydown = function(e){
		if(sequence[position] == e.keyCode){
			position ++;
			if(position >= sequence.length){
				linkedfn();
				position = 0;
			}
		}else{
			position = 0;
		}
	}
};