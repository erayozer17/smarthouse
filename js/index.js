(function(){
var dialog = document.querySelector('dialog');
var local;

document.querySelector('#Garage').onclick = function() {
	local = 1;
  dialog.showModal();
};

document.querySelector('#Kitchen').onclick = function() {
	local = 2;
  dialog.showModal();
};

document.querySelector('#Livingroom').onclick = function() {
	local = 3;
  dialog.showModal();
};
document.querySelector('#Hall').onclick = function() {
	local = 4;
  dialog.showModal();
};
document.querySelector('#Bedroom').onclick = function() {
	local = 5;
  dialog.showModal();
};
document.querySelector('#Playroom').onclick = function() {
	local = 6;
  dialog.showModal();
};
document.querySelector('#Bathroom').onclick = function() {
	local = 7;
  dialog.showModal();
};
document.querySelector('#close').onclick = function() {
  	dialog.close();
};
})();