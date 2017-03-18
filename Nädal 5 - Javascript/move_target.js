/**
* Kaar3l 18.03.2017.
*/
window.onload = function(){
	var m2rk = document.getElementById('kogu');
	//Märk hüppab kogu ekraani 80% ulatuses, kuna muidu võib juhtuda, et märk hüppab 100% peale ja peitu.
	//10% ekraani igast servast märk ei hüppa.
	var posy=Math.floor(Math.random()*80+10);
	var posx=Math.floor(Math.random()*80+10);
	m2rk.addEventListener('click', function(){m2rk.style.top=posy+'%',m2rk.style.left=posx+'%' },false );
 	console.log(posy);
	console.log(posx);
}
