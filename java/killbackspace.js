// JavaScript Document
function killBackSpace(e){
e = e? e : window.event;
var k = e.keyCode? e.keyCode : e.which? e.which : null;
if (k == 8){
if (e.preventDefault)
e.preventDefault();
return false;
};
return true;
};
if(typeof document.addEventListener!='undefined')
document.addEventListener('keydown', killBackSpace, false);
else if(typeof document.attachEvent!='undefined')
document.attachEvent('onkeydown', killBackSpace);
else{
if(document.onkeydown!=null){
var oldOnkeydown=document.onkeydown;
document.onkeydown=function(e){
oldOnkeydown(e);
killBackSpace(e);
};}
else
document.onkeydown=killBackSpace;
}