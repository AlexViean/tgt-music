var ajax={getHTTPObject:function(){var a=false;if(typeof ActiveXObject!='undefined'){try{a=new ActiveXObject("Msxml2.XMLHTTP")}catch(e){try{a=new ActiveXObject("Microsoft.XMLHTTP")}catch(E){a=false}}}else if(window.XMLHttpRequest){try{a=new XMLHttpRequest()}catch(e){a=false}}return a},load:function(b,c,d,e,f){var g=this.init();if(!g||!b)return;if(g.overrideMimeType)g.overrideMimeType('text/xml');if(!e)e="GET";if(!d)d="text";if(!f)f={};d=d.toLowerCase();e=e.toUpperCase();var h="uid="+new Date().getTime();b+=(b.indexOf("?")+1)?"&":"?";b+=h;var i=null;if(e=="POST"){var j=b.split("\?");b=j[0];i=j[1]}g.open(e,b,true);if(e=="POST"){g.setRequestHeader("Content-type","application/x-www-form-urlencoded")}var k=this;if(f.handler){g.onreadystatechange=function(){f.handler(g)}}else{g.onreadystatechange=function(){if(g.readyState==4){if(g.status==200){var a="";if(g.responseText)a=g.responseText;if(d.charAt(0)=="j"){a=a.replace(/[\n\r]/g,"");a=eval('('+a+')')}else if(d.charAt(0)=="x"){a=g.responseXML}if(c)c(a)}else{if(f.loadingIndicator)document.getElementsByTagName("body")[0].removeChild(f.loadingIndicator);if(f.loading)document.getElementById(f.loading).style.display="none";if(error)error(g.status)}}}}g.send(i)},bind:function(b){var c={'url':'','onSuccess':false,'onError':false,'format':"text",'method':"GET",'update':"",'loading':"",'loadingIndicator':""};for(var d in c){if(b[d]){c[d]=b[d]}}if(!c.url)return;var e=false;if(c.loadingIndicator){e=document.createElement("div");e.setAttribute("style","position:absolute;top:0px;left:0px;");e.setAttribute("class","loading-indicator");e.innerHTML=c.loadingIndicator;document.getElementsByTagName("body")[0].appendChild(e);this.opt.loadingIndicator=e}if(c.loading)document.getElementById(c.loading).style.display="block";this.load(c.url,function(a){if(c.onSuccess)c.onSuccess(a);if(c.update)document.getElementById(c.update).innerHTML=a;if(e)document.getElementsByTagName("body")[0].removeChild(e);if(c.loading)document.getElementById(c.loading).style.display="none"},c.format,c.method,c)},init:function(){return this.getHTTPObject()}};