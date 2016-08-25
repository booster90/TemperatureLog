/* 
 * 
 * Just simple timer in js
 * 
 */

//get element for timer..
var timer = document.getElementById('timer');
setInterval("showTime(timer)", 1000);

function showTime(object) {
    var date = new Date();
    object.innerHTML = date.toTimeString().substr(0, 8);
}