function ClearCookies(name){
	var expires = new Date();
	expires.setTime(expires.getTime()-1);
	document.cookie=name+"=;expires= "+expires.toGMTString();
	// console.log('document.cookie');
}