/**
* Kaar3l 18.03.2017.
*/
var spheres = document.getElementsByClassName("bead");
console.log(spheres);
window.onload = function(){
	for (var i = 0; i < spheres.length; i++) {
		spheres[i].onclick = function () {

		console.log(i);

		if (window.getComputedStyle(this).getPropertyValue("float") == "right"){
			this.style.cssFloat = "left";
		} else {
			this.style.cssFloat = "right";
		}

	}
	}
}
