var domain = document.domain;
if(domain == "127.0.0.1"){
  domain = "http://"+domain+":8000/";
}
else if(domain == "localhost")
  domain = 'http://'+domain+'/';
else{
  domain = "http://"+domain+"/";
}
String.prototype.trimLeft = function(charlist) {
	if (charlist === undefined) charlist = "\s";
	return this.replace(new RegExp("^[" + charlist + "]+"), "");
};
String.prototype.trimRight = function(charlist) {
	if (charlist === undefined) charlist = "\s";
	return this.replace(new RegExp("[" + charlist + "]+$"), "");
};
Array.prototype.sortBy = function(p) {
  return this.slice(0).sort(function(a,b) {
    return (a[p] > b[p]) ? 1 : (a[p] < b[p]) ? -1 : 0;
  });
}
var _token=$('meta[name="csrf-token"]').attr('content');
var _lang_local = $("html").attr("lang");
// _lang_local = "vi";
var config_site;
$.ajax({
  url:'asset/lang/'+_lang_local+'.json',
  async:false,
  cache:false,
  type:"GET",
  dataType:"json",
  success:function(data){
    config_site = data;
  }
});