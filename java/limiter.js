// JavaScript Document
var count = "70";
function limiter(){
var tex = document.myform.name.value;
var len = tex.length;
if(len > count){
        tex = tex.substring(0,count);
        document.myform.name.value =tex;
        return false;
}
document.myform.limit.value = count-len;
}

var count2 = "50";
function limiter2(){
var tex2 = document.myform.author.value;
var len2 = tex2.length;
if(len2 > count2){
        tex2 = tex2.substring(0,count2);
        document.myform.author.value =tex2;
        return false;
}
document.myform.limit2.value = count2-len2;
}
