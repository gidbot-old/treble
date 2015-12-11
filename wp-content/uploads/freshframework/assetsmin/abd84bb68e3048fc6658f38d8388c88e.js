Number.isNaN=Number.isNaN||function(value){return typeof value==="number"&&value!==value};var frslib=frslib||{};frslib.global=this;frslib.isDef=function(val){return val!==undefined};frslib.exportPath_=function(name,opt_object,opt_objectToExportTo){var parts=name.split('.'),cur=opt_objectToExportTo||frslib.global;if(!(parts[0]in cur)&&cur.execScript)cur.execScript('var '+parts[0]);for(var part;parts.length&&(part=parts.shift());)if(!parts.length&&frslib.isDef(opt_object)){cur[part]=opt_object}else if(cur[part]){cur=cur[part]}else cur=cur[part]={}};frslib.provide=function(name){return frslib.exportPath_(name)};frslib.provide('frslib.htmlforms');(function($){frslib.htmlforms.writeValueToCode=function($selector){$selector.find('input').each(function(){var val=$(this).val();$(this).attr('value',val);if($(this).attr('type')=='checkbox'){var checked=$(this).is(':checked');if(checked){$(this).attr('checked','checked')}else{$(this).prop('checked',false);$(this).removeAttr('checked')}}})}})(jQuery);frslib.provide('frslib.callbacks');(function($){frslib.callbacks.functions=new Array();frslib.callbacks.addCallback=function(eventName,callback){frslib.provide('frslib.callbacks.functions.'+eventName);frslib.callbacks.functions[eventName]=new Array();frslib.callbacks.functions[eventName].push(callback)};frslib.callbacks.doCallback=function(eventName){if(!(eventName in frslib.callbacks.functions))return false;var newArguments=new Array();for(var argumentsKey in arguments)if(!Number.isNaN(argumentsKey)&&argumentsKey>0)newArguments[argumentsKey-1]=arguments[argumentsKey];var output={};for(var key in frslib.callbacks.functions[eventName])output[key]=frslib.callbacks.functions[eventName][key].apply(this,newArguments);return output};frslib.callbacks.callAllFunctionsFromArray=function(arrayOfFunctions){var newArguments=Array();for(var argumentsKey in arguments)if(!Number.isNaN(argumentsKey)&&argumentsKey>0)newArguments[argumentsKey-1]=arguments[argumentsKey];var oneFunction;if(arrayOfFunctions)for(oneFunction in arrayOfFunctions)if(arrayOfFunctions[oneFunction])arrayOfFunctions[oneFunction].apply(this,newArguments)}})(jQuery);frslib.provide('frslib.colors');frslib.provide('frslib.colors.convert');frslib.provide('frslib.colors.type');(function($){frslib.colors.convert.hexToRgb=function(hex){var result=/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);return result?{r:parseInt(result[1],16),g:parseInt(result[2],16),b:parseInt(result[3],16)}:null};frslib.colors.convert.hslToRgb=function(h,s,l){var r,g,b,m,c,x;if(!isFinite(h))h=0;if(!isFinite(s))s=0;if(!isFinite(l))l=0;h/=60;if(h<0)h=6-(-h%6);h%=6;s=Math.max(0,Math.min(1,s/100));l=Math.max(0,Math.min(1,l/100));c=(1-Math.abs((2*l)-1))*s;x=c*(1-Math.abs((h%2)-1));if(h<1){r=c;g=x;b=0}else if(h<2){r=x;g=c;b=0}else if(h<3){r=0;g=c;b=x}else if(h<4){r=0;g=x;b=c}else if(h<5){r=x;g=0;b=c}else{r=c;g=0;b=x};m=l-c/2;r=Math.round((r+m)*255);g=Math.round((g+m)*255);b=Math.round((b+m)*255);return{r:r,g:g,b:b}};frslib.colors.convert.rgbToHsl=function(r,g,b){r/=255,g/=255,b/=255;var max=Math.max(r,g,b),min=Math.min(r,g,b),h,s,l=(max+min)/2;if(max==min){h=s=0}else{var d=max-min;s=l>0.5?d/(2-max-min):d/(max+min);switch(max){case r:h=(g-b)/d+(g<b?6:0);break;case g:h=(b-r)/d+2;break;case b:h=(r-g)/d+4;break};h/=6};return{h:Math.floor(h*360),s:Math.floor(s*100),b:Math.floor(l*100)}};frslib.colors.convert.invalid='color-is-invalid';frslib.colors.convert.toArray=function(color){var cache,p=parseInt,color=color.replace(/\s\s*/g,''),rgbaType=0;if(cache=/^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})/.exec(color)){cache=[p(cache[1],16),p(cache[2],16),p(cache[3],16)]}else if(cache=/^#([\da-fA-F])([\da-fA-F])([\da-fA-F])/.exec(color)){cache=[p(cache[1],16)*17,p(cache[2],16)*17,p(cache[3],16)*17]}else if(cache=/^rgba\(([\d]+),([\d]+),([\d]+),([\d]+|[\d]*.[\d]+)\)/.exec(color)){cache=[+cache[1],+cache[2],+cache[3],+cache[4]];rgbaType=1}else if(cache=/^rgb\(([\d]+),([\d]+),([\d]+)\)/.exec(color)){cache=[+cache[1],+cache[2],+cache[3]]}else return frslib.colors.convert.invalid;isNaN(cache[3])&&(cache[3]=1);var parsedColor=cache.slice(0,3+rgbaType),toReturn={};toReturn.r=parsedColor[0];toReturn.g=parsedColor[1];toReturn.b=parsedColor[2];if(rgbaType==1){toReturn.a=parsedColor[3]}else toReturn.a=1;return toReturn};frslib.colors.type.rgba='rgba';frslib.colors.type.rgb='rgb';frslib.colors.type.hex='hex';frslib.colors.type.identify=function(colorValue){if(colorValue.toLowerCase().indexOf('rgba')!=-1){return frslib.colors.type.rgba}else if(colorValue.toLowerCase().indexOf('rgb')!=-1){return frslib.colors.type.rgb}else if(colorValue.indexOf('#')!=-1)return frslib.colors.type.hex};frslib.colors.convert.rgbToHex=function(r,g,b){var rgb=b|(g<<8)|(r<<16);return'#'+(0x1000000+rgb).toString(16).slice(1)}})(jQuery);frslib.provide('frslib.ajax');(function($){frslib.ajax.frameworkRequest=function(owner,specification,data,callback){$.post(ajaxurl,{action:'ff_ajax',owner:owner,specification:specification,data:data},callback)};frslib.ajax.adminScreenRequest=function(specification,data,callback){var adminScreenName=$('.ff-view-identification').find('.admin-screen-name').html(),adminViewName=$('.ff-view-identification').find('.admin-view-name').html(),data={adminScreenName:adminScreenName,adminViewName:adminViewName,specification:specification,action:'ff_ajax_admin',data:data};$.post(ajaxurl,data,callback)}})(jQuery);frslib.provide('frslib.validator');(function($){frslib.validator.email=function(value){var filter=/^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;return filter.test(value)}})(jQuery);frslib.provide('frslib.text');(function($){$.fn.findButNotInside=function(selector){var origElement=$(this);return origElement.find(selector).filter(function(){var nearestMatch=$(this).parent().closest(selector);return nearestMatch.length==0||origElement.find(nearestMatch).length==0})}})(jQuery);(function($){frslib.text.onlyAlphaNumeric=function(toReplace){return toReplace.replace(/[^a-z0-9 ]/gi,'')}})(jQuery);(function($){var b64="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/",a256='',r64=[256],r256=[256],i=0,UTF8={encode:function(strUni){var strUtf=strUni.replace(/[\u0080-\u07ff]/g,function(c){var cc=c.charCodeAt(0);return String.fromCharCode(0xc0|cc>>6,0x80|cc&0x3f)}).replace(/[\u0800-\uffff]/g,function(c){var cc=c.charCodeAt(0);return String.fromCharCode(0xe0|cc>>12,0x80|cc>>6&0x3F,0x80|cc&0x3f)});return strUtf},decode:function(strUtf){var strUni=strUtf.replace(/[\u00e0-\u00ef][\u0080-\u00bf][\u0080-\u00bf]/g,function(c){var cc=((c.charCodeAt(0)&0x0f)<<12)|((c.charCodeAt(1)&0x3f)<<6)|(c.charCodeAt(2)&0x3f);return String.fromCharCode(cc)}).replace(/[\u00c0-\u00df][\u0080-\u00bf]/g,function(c){var cc=(c.charCodeAt(0)&0x1f)<<6|c.charCodeAt(1)&0x3f;return String.fromCharCode(cc)});return strUni}};while(i<256){var c=String.fromCharCode(i);a256+=c;r256[i]=i;r64[i]=b64.indexOf(c);++i}
function code(s,discard,alpha,beta,w1,w2){s=String(s);var buffer=0,i=0,length=s.length,result='',bitsInBuffer=0;while(i<length){var c=s.charCodeAt(i);c=c<256?alpha[c]:-1;buffer=(buffer<<w1)+c;bitsInBuffer+=w1;while(bitsInBuffer>=w2){bitsInBuffer-=w2;var tmp=buffer>>bitsInBuffer;result+=beta.charAt(tmp);buffer^=tmp<<bitsInBuffer};++i};if(!discard&&bitsInBuffer>0)result+=beta.charAt(buffer<<(w2-bitsInBuffer));return result};var Plugin=$.base64=function(dir,input,encode){return input?Plugin[dir](input,encode):dir?null:this};Plugin.btoa=Plugin.encode=function(plain,utf8encode){plain=Plugin.raw===false||Plugin.utf8encode||utf8encode?UTF8.encode(plain):plain;plain=code(plain,false,r256,b64,8,6);return plain+'===='.slice((plain.length%4)||4)};Plugin.atob=Plugin.decode=function(coded,utf8decode){coded=coded.replace(/[^A-Za-z0-9\+\/\=]/g,"");coded=String(coded).split('=');var i=coded.length;do{--i;coded[i]=code(coded[i],true,r64,a256,6,8)}while(i>0);coded=coded.join('');return Plugin.raw===false||Plugin.utf8decode||utf8decode?UTF8.decode(coded):coded}}(jQuery));jQuery.fn.serializeObject=function(){var json={};jQuery.map(jQuery(this).serializeArray(),function(n,i){var _=n.name.indexOf('[');if(_>-1){var o=json,_name=n.name.replace(/\]/gi,'').split('[');for(var i=0,len=_name.length;i<len;i++)if(i==len-1){if(o[_name[i]]){if(typeof o[_name[i]]=='string')o[_name[i]]=[o[_name[i]]];o[_name[i]].push(n.value)}else o[_name[i]]=n.value||''}else o=o[_name[i]]=o[_name[i]]||{}}else if(json[n.name]!==undefined){if(!json[n.name].push)json[n.name]=[json[n.name]];json[n.name].push(n.value||'')}else json[n.name]=n.value||''});return json};(function($){var splitVersion=$.fn.jquery.split("."),major=parseInt(splitVersion[0]),minor=parseInt(splitVersion[1]),JQ_LT_17=(major<1)||(major==1&&minor<7)
function eventsData($el){return JQ_LT_17?$el.data('events'):$._data($el[0]).events}
function moveHandlerToTop($el,eventName,isDelegated){var data=eventsData($el),events=data[eventName];if(!JQ_LT_17){var handler=isDelegated?events.splice(events.delegateCount-1,1)[0]:events.pop();events.splice(isDelegated?0:(events.delegateCount||0),0,handler);return};if(isDelegated){data.live.unshift(data.live.pop())}else events.unshift(events.pop())}
function moveEventHandlers($elems,eventsString,isDelegate){var events=eventsString.split(/\s+/);$elems.each(function(){for(var i=0;i<events.length;++i){var pureEventName=$.trim(events[i]).match(/[^\.]+/i)[0];moveHandlerToTop($(this),pureEventName,isDelegate)}})}
function makeMethod(methodName){$.fn[methodName+'First']=function(){var args=$.makeArray(arguments),eventsString=args.shift();if(eventsString){$.fn[methodName].apply(this,arguments);moveEventHandlers(this,eventsString)};return this}};makeMethod('bind');makeMethod('one');$.fn.delegateFirst=function(){var args=$.makeArray(arguments),eventsString=args[1];if(eventsString){args.splice(0,2);$.fn.delegate.apply(this,arguments);moveEventHandlers(this,eventsString,true)};return this};$.fn.liveFirst=function(){var args=$.makeArray(arguments);args.unshift(this.selector);$.fn.delegateFirst.apply($(document),args);return this};if(!JQ_LT_17)$.fn.onFirst=function(types,selector){var $el=$(this),isDelegated=typeof selector==='string';$.fn.on.apply($el,arguments);if(typeof types==='object'){for(type in types)if(types.hasOwnProperty(type))moveEventHandlers($el,type,isDelegated)}else if(typeof types==='string')moveEventHandlers($el,types,isDelegated);return $el}})(jQuery);(function(){function e(){}
function t(e,t){for(var n=e.length;n--;)if(e[n].listener===t)return n;return-1}
function n(e){return function(){return this[e].apply(this,arguments)}};var i=e.prototype,r=this,o=r.EventEmitter;i.getListeners=function(e){var t,n,i=this._getEvents();if("object"==typeof e){t={};for(n in i)i.hasOwnProperty(n)&&e.test(n)&&(t[n]=i[n])}else t=i[e]||(i[e]=[]);return t},i.flattenListeners=function(e){var t,n=[];for(t=0;e.length>t;t+=1)n.push(e[t].listener);return n},i.getListenersAsObject=function(e){var t,n=this.getListeners(e);return n instanceof Array&&(t={},t[e]=n),t||n},i.addListener=function(e,n){var i,r=this.getListenersAsObject(e),o="object"==typeof n;for(i in r)r.hasOwnProperty(i)&&-1===t(r[i],n)&&r[i].push(o?n:{listener:n,once:!1});return this},i.on=n("addListener"),i.addOnceListener=function(e,t){return this.addListener(e,{listener:t,once:!0})},i.once=n("addOnceListener"),i.defineEvent=function(e){return this.getListeners(e),this},i.defineEvents=function(e){for(var t=0;e.length>t;t+=1)this.defineEvent(e[t]);return this},i.removeListener=function(e,n){var i,r,o=this.getListenersAsObject(e);for(r in o)o.hasOwnProperty(r)&&(i=t(o[r],n),-1!==i&&o[r].splice(i,1));return this},i.off=n("removeListener"),i.addListeners=function(e,t){return this.manipulateListeners(!1,e,t)},i.removeListeners=function(e,t){return this.manipulateListeners(!0,e,t)},i.manipulateListeners=function(e,t,n){var i,r,o=e?this.removeListener:this.addListener,s=e?this.removeListeners:this.addListeners;if("object"!=typeof t||t instanceof RegExp){for(i=n.length;i--;)o.call(this,t,n[i])}else for(i in t)t.hasOwnProperty(i)&&(r=t[i])&&("function"==typeof r?o.call(this,i,r):s.call(this,i,r));return this},i.removeEvent=function(e){var t,n=typeof e,i=this._getEvents();if("string"===n){delete i[e]}else if("object"===n){for(t in i)i.hasOwnProperty(t)&&e.test(t)&&delete i[t]}else delete this._events;return this},i.removeAllListeners=n("removeEvent"),i.emitEvent=function(e,t){var n,i,r,o,s=this.getListenersAsObject(e);for(r in s)if(s.hasOwnProperty(r))for(i=s[r].length;i--;)n=s[r][i],n.once===!0&&this.removeListener(e,n.listener),o=n.listener.apply(this,t||[]),o===this._getOnceReturnValue()&&this.removeListener(e,n.listener);return this},i.trigger=n("emitEvent"),i.emit=function(e){var t=Array.prototype.slice.call(arguments,1);return this.emitEvent(e,t)},i.setOnceReturnValue=function(e){return this._onceReturnValue=e,this},i._getOnceReturnValue=function(){return this.hasOwnProperty("_onceReturnValue")?this._onceReturnValue:!0},i._getEvents=function(){return this._events||(this._events={})},e.noConflict=function(){return r.EventEmitter=o,e},"function"==typeof define&&define.amd?define("eventEmitter/EventEmitter",[],function(){return e}):"object"==typeof module&&module.exports?module.exports=e:this.EventEmitter=e}).call(this),function(e){function t(t){var n=e.event;return n.target=n.target||n.srcElement||t,n};var n=document.documentElement,i=function(){};n.addEventListener?i=function(e,t,n){e.addEventListener(t,n,!1)}:n.attachEvent&&(i=function(e,n,i){e[n+i]=i.handleEvent?function(){var n=t(e);i.handleEvent.call(i,n)}:function(){var n=t(e);i.call(e,n)},e.attachEvent("on"+n,e[n+i])});var r=function(){};n.removeEventListener?r=function(e,t,n){e.removeEventListener(t,n,!1)}:n.detachEvent&&(r=function(e,t,n){e.detachEvent("on"+t,e[t+n]);try{delete e[t+n]}catch(i){e[t+n]=void(0)}});var o={bind:i,unbind:r};"function"==typeof define&&define.amd?define("eventie/eventie",o):e.eventie=o}(this),function(e,t){"function"==typeof define&&define.amd?define(["eventEmitter/EventEmitter","eventie/eventie"],function(n,i){return t(e,n,i)}):"object"==typeof exports?module.exports=t(e,require("wolfy87-eventemitter"),require("eventie")):e.imagesLoaded=t(e,e.EventEmitter,e.eventie)}(window,function(e,t,n){function i(e,t){for(var n in t)e[n]=t[n];return e}
function r(e){return"[object Array]"===d.call(e)}
function o(e){var t=[];if(r(e)){t=e}else if("number"==typeof e.length){for(var n=0,i=e.length;i>n;n++)t.push(e[n])}else t.push(e);return t}
function s(e,t,n){if(!(this instanceof s))return new s(e,t);"string"==typeof e&&(e=document.querySelectorAll(e)),this.elements=o(e),this.options=i({},this.options),"function"==typeof t?n=t:i(this.options,t),n&&this.on("always",n),this.getImages(),a&&(this.jqDeferred=new a.Deferred());var r=this;setTimeout(function(){r.check()})}
function f(e){this.img=e}
function c(e){this.src=e,v[e]=this};var a=e.jQuery,u=e.console,h=u!==void(0),d=Object.prototype.toString;s.prototype=new t(),s.prototype.options={},s.prototype.getImages=function(){this.images=[];for(var e=0,t=this.elements.length;t>e;e++){var n=this.elements[e];"IMG"===n.nodeName&&this.addImage(n);var i=n.nodeType;if(i&&(1===i||9===i||11===i))for(var r=n.querySelectorAll("img"),o=0,s=r.length;s>o;o++){var f=r[o];this.addImage(f)}}},s.prototype.addImage=function(e){var t=new f(e);this.images.push(t)},s.prototype.check=function(){function e(e,r){return t.options.debug&&h&&u.log("confirm",e,r),t.progress(e),n++,n===i&&t.complete(),!0};var t=this,n=0,i=this.images.length;if(this.hasAnyBroken=!1,!i)return this.complete(),void(0);for(var r=0;i>r;r++){var o=this.images[r];o.on("confirm",e),o.check()}},s.prototype.progress=function(e){this.hasAnyBroken=this.hasAnyBroken||!e.isLoaded;var t=this;setTimeout(function(){t.emit("progress",t,e),t.jqDeferred&&t.jqDeferred.notify&&t.jqDeferred.notify(t,e)})},s.prototype.complete=function(){var e=this.hasAnyBroken?"fail":"done";this.isComplete=!0;var t=this;setTimeout(function(){if(t.emit(e,t),t.emit("always",t),t.jqDeferred){var n=t.hasAnyBroken?"reject":"resolve";t.jqDeferred[n](t)}})},a&&(a.fn.imagesLoaded=function(e,t){var n=new s(this,e,t);return n.jqDeferred.promise(a(this))}),f.prototype=new t(),f.prototype.check=function(){var e=v[this.img.src]||new c(this.img.src);if(e.isConfirmed)return this.confirm(e.isLoaded,"cached was confirmed"),void(0);if(this.img.complete&&void(0)!==this.img.naturalWidth)return this.confirm(0!==this.img.naturalWidth,"naturalWidth"),void(0);var t=this;e.on("confirm",function(e,n){return t.confirm(e.isLoaded,n),!0}),e.check()},f.prototype.confirm=function(e,t){this.isLoaded=e,this.emit("confirm",this,t)};var v={};return c.prototype=new t(),c.prototype.check=function(){if(!this.isChecked){var e=new Image();n.bind(e,"load",this),n.bind(e,"error",this),e.src=this.src,this.isChecked=!0}},c.prototype.handleEvent=function(e){var t="on"+e.type;this[t]&&this[t](e)},c.prototype.onload=function(e){this.confirm(!0,"onload"),this.unbindProxyEvents(e)},c.prototype.onerror=function(e){this.confirm(!1,"onerror"),this.unbindProxyEvents(e)},c.prototype.confirm=function(e,t){this.isConfirmed=!0,this.isLoaded=e,this.emit("confirm",this,t)},c.prototype.unbindProxyEvents=function(e){n.unbind(e.target,"load",this),n.unbind(e.target,"error",this)},s});!function(a,b){"function"==typeof define&&define.amd?define(b):a.BackgroundCheck=b(a)}(this,function(){
function a(a){if(void(0)===a||void(0)===a.targets)throw"Missing attributes";H.debug=d(a.debug,!1),H.debugOverlay=d(a.debugOverlay,!1),H.targets=g(a.targets),H.images=g(a.images||"img",!0),H.changeParent=d(a.changeParent,!1),H.threshold=d(a.threshold,50),H.minComplexity=d(a.minComplexity,30),H.minOverlap=d(a.minOverlap,50),H.windowEvents=d(a.windowEvents,!0),H.maxDuration=d(a.maxDuration,500),H.mask=d(a.mask,{r:0,g:255,b:0}),H.classes=d(a.classes,{dark:"background--dark",light:"background--light",complex:"background--complex"}),void(0)===B&&(h(),B&&(C.style.position="fixed",C.style.top="0px",C.style.left="0px",C.style.width="100%",C.style.height="100%",window.addEventListener(G,x.bind(null,function(){k(),w()})),window.addEventListener("scroll",x.bind(null,w)),k(),w()))}
function b(){B=null,C=null,D=null,H={},E&&clearTimeout(E)}
function c(a){z("debug")&&console.log(a)}
function d(a,b){return e(a,typeof b),void(0)===a?b:a}
function e(a,b){if(void(0)!==a&&typeof a!==b)throw"Incorrect attribute type"}
function f(a){for(var b,d,e=[],f=0;f<a.length;f++)if(b=a[f],e.push(b),"IMG"!==b.tagName){if(d=window.getComputedStyle(b).backgroundImage,d.split(/,url|, url/).length>1)throw"Multiple backgrounds are not supported";if(!d||"none"===d)throw"Element is not an <img> but does not have a background-image";e[f]={img:new Image(),el:e[f]},d=d.slice(4,-1),d=d.replace(/"/g,""),e[f].img.src=d,c("CSS Image - "+d)};return e}
function g(a,b){var c=a;if("string"==typeof a?c=document.querySelectorAll(a):a&&1===a.nodeType&&(c=[a]),!c||0===c.length||void(0)===c.length)1;return b&&(c=f(c)),c=Array.prototype.slice.call(c)}
function h(){C=document.createElement("canvas"),C&&C.getContext?(D=C.getContext("2d"),B=!0):B=!1,i()}
function i(){z("debugOverlay")?(C.style.opacity=.5,C.style.pointerEvents="none",document.body.appendChild(C)):C.parentNode&&C.parentNode.removeChild(C)}
function j(a){var d=(new Date()).getTime()-a;c("Duration: "+d+"ms"),d>z("maxDuration")&&(console.log("BackgroundCheck - Killed"),q(),b())}
function k(){F={left:0,top:0,right:document.body.clientWidth,bottom:window.innerHeight},C.width=document.body.clientWidth,C.height=window.innerHeight}
function l(a,b,c){var d,e;return-1!==a.indexOf("px")?d=parseFloat(a):-1!==a.indexOf("%")?(d=parseFloat(a),e=d/100,d=e*b,c&&(d-=c*e)):d=b,d}
function m(a){var b=window.getComputedStyle(a.el);a.el.style.backgroundRepeat="no-repeat",a.el.style.backgroundOrigin="padding-box";var c=b.backgroundSize.split(" "),d=c[0],e=void(0)===c[1]?"auto":c[1],f=a.el.clientWidth/a.el.clientHeight,g=a.img.naturalWidth/a.img.naturalHeight;"cover"===d?f>=g?(d="100%",e="auto"):(d="auto",c[0]="auto",e="100%"):"contain"===d&&(1/g>1/f?(d="auto",c[0]="auto",e="100%"):(d="100%",e="auto")),d="auto"===d?a.img.naturalWidth:l(d,a.el.clientWidth),e="auto"===e?d/a.img.naturalWidth*a.img.naturalHeight:l(e,a.el.clientHeight),"auto"===c[0]&&"auto"!==c[1]&&(d=e/a.img.naturalHeight*a.img.naturalWidth);var h=b.backgroundPosition;"top"===h?h="50% 0%":"left"===h?h="0% 50%":"right"===h?h="100% 50%":"bottom"===h?h="50% 100%":"center"===h&&(h="50% 50%"),h=h.split(" ");var i,j;return 4===h.length?(i=h[1],j=h[3]):(i=h[0],j=h[1]),j=j||"50%",i=l(i,a.el.clientWidth,d),j=l(j,a.el.clientHeight,e),4===h.length&&("right"===h[0]&&(i=a.el.clientWidth-a.img.naturalWidth-i),"bottom"===h[2]&&(j=a.el.clientHeight-a.img.naturalHeight-j)),i+=a.el.getBoundingClientRect().left,j+=a.el.getBoundingClientRect().top,{left:Math.floor(i),right:Math.floor(i+d),top:Math.floor(j),bottom:Math.floor(j+e),width:Math.floor(d),height:Math.floor(e)}}
function n(a){var b,c,d;if(a.nodeType){var e=a.getBoundingClientRect();b={left:e.left,right:e.right,top:e.top,bottom:e.bottom,width:e.width,height:e.height},d=a.parentNode,c=a}else b=m(a),d=a.el,c=a.img;d=d.getBoundingClientRect(),b.imageTop=0,b.imageLeft=0,b.imageWidth=c.naturalWidth,b.imageHeight=c.naturalHeight;var f,g=b.imageHeight/b.height;return b.top<d.top&&(f=d.top-b.top,b.imageTop=g*f,b.imageHeight-=g*f,b.top+=f,b.height-=f),b.left<d.left&&(f=d.left-b.left,b.imageLeft+=g*f,b.imageWidth-=g*f,b.width-=f,b.left+=f),b.bottom>d.bottom&&(f=b.bottom-d.bottom,b.imageHeight-=g*f,b.height-=f),b.right>d.right&&(f=b.right-d.right,b.imageWidth-=g*f,b.width-=f),b.imageTop=Math.floor(b.imageTop),b.imageLeft=Math.floor(b.imageLeft),b.imageHeight=Math.floor(b.imageHeight),b.imageWidth=Math.floor(b.imageWidth),b}
function o(a){var b=n(a);a=a.nodeType?a:a.img,b.imageWidth>0&&b.imageHeight>0&&b.width>0&&b.height>0?D.drawImage(a,b.imageLeft,b.imageTop,b.imageWidth,b.imageHeight,b.left,b.top,b.width,b.height):c("Skipping image - "+a.src+" - area too small")}
function p(a,b,c){var d=a.className;switch(c){case"add":d+=" "+b;break;case"remove":var e=new RegExp("(?:^|\\s)"+b+"(?!\\S)","g");d=d.replace(e,"")};a.className=d.trim()}
function q(a){for(var b,c=a?[a]:z("targets"),d=0;d<c.length;d++)b=c[d],b=z("changeParent")?b.parentNode:b,p(b,z("classes").light,"remove"),p(b,z("classes").dark,"remove"),p(b,z("classes").complex,"remove")}
function r(a){var b,d,e,f,g=a.getBoundingClientRect(),h=0,i=0,j=0,k=0,l=z("mask");if(g.width>0&&g.height>0){q(a),a=z("changeParent")?a.parentNode:a,d=D.getImageData(g.left,g.top,g.width,g.height).data;for(var m=0;m<d.length;m+=4)d[m]===l.r&&d[m+1]===l.g&&d[m+2]===l.b?k++:(h++,b=.2126*d[m]+.7152*d[m+1]+.0722*d[m+2],e=b-j,i+=e*e,j+=e/h);k<=d.length/4*(1-z("minOverlap")/100)&&(f=Math.sqrt(i/h)/255,j/=255,c("Target: "+a.className+" lum: "+j+" var: "+f),p(a,j<=z("threshold")/100?z("classes").dark:z("classes").light,"add"),f>z("minComplexity")/100&&p(a,z("classes").complex,"add"))}}
function s(a,b){return a=(a.nodeType?a:a.el).getBoundingClientRect(),b=b===F?b:(b.nodeType?b:b.el).getBoundingClientRect(),!(a.right<b.left||a.left>b.right||a.top>b.bottom||a.bottom<b.top)}
function t(a){for(var b,c=(new Date()).getTime(),d=a&&("IMG"===a.tagName||a.img)?"image":"targets",e=a?!1:!0,f=z("targets").length,g=0;f>g;g++)b=z("targets")[g],s(b,F)&&("targets"!==d||a&&a!==b?"image"===d&&s(b,a)&&r(b):(e=!0,r(b)));if("targets"===d&&!e)throw a+" is not a target";j(c)}
function u(a){var b=function(a){var b=0;return"static"!==window.getComputedStyle(a).position&&(b=parseInt(window.getComputedStyle(a).zIndex,10)||0,b>=0&&b++),b},c=a.parentNode,d=c?b(c):0,e=b(a);return 1e5*d+e}
function v(a){var b=!1;return a.sort(function(a,c){a=a.nodeType?a:a.el,c=c.nodeType?c:c.el;var d=a.compareDocumentPosition(c),e=0;return a=u(a),c=u(c),a>c&&(b=!0),a===c&&2===d?e=1:a===c&&4===d&&(e=-1),e||a-c}),c("Sorted: "+b),b&&c(a),b}
function w(a,b,d){if(B){var e=z("mask");c("--- BackgroundCheck ---"),c("onLoad event: "+(d&&d.src)),b!==!0&&(D.clearRect(0,0,C.width,C.height),D.fillStyle="rgb("+e.r+", "+e.g+", "+e.b+")",D.fillRect(0,0,C.width,C.height));for(var f,g,h=d?[d]:z("images"),i=v(h),j=!1,k=0;k<h.length;k++)f=h[k],s(f,F)&&(g=f.nodeType?f:f.img,0===g.naturalWidth?(j=!0,c("Loading... "+f.src),g.removeEventListener("load",w),i?g.addEventListener("load",w.bind(null,null,!1,null)):g.addEventListener("load",w.bind(null,a,!0,f))):(c("Drawing: "+f.src),o(f)));d||j?d&&t(d):t(a)}}
function x(a){z("windowEvents")===!0&&(E&&clearTimeout(E),E=setTimeout(a,200))}
function y(a,b){if(void(0)===H[a])throw"Unknown property - "+a;if(void(0)===b)throw"Missing value for "+a;if("targets"===a||"images"===a){try{b=g("images"!==a||b?b:"img","images"===a?!0:!1)}catch(c){throw b=[],c}}else e(b,typeof H[a]);q(),H[a]=b,w(),"debugOverlay"===a&&i()}
function z(a){if(void(0)===H[a])throw"Unknown property - "+a;return H[a]}
function A(){for(var a,b=z("images"),c=[],d=0;d<b.length;d++)a=n(b[d]),c.push(a);return c};var B,C,D,E,F,G=void(0)!==window.orientation?"orientationchange":"resize",H={};return{init:a,destroy:b,refresh:w,set:y,get:z,getImageData:A}});(function($){$('body').removeClass('no-js');var backgroundCheckImages='.featured-video-1 img, .featured-slider-1 img, .featured-image-1 img, .portfolio-cat-1 img';window.backgroundCheckRefreshImages=function(){BackgroundCheck.set('images',backgroundCheckImages)};if(0!=$(backgroundCheckImages).size())BackgroundCheck.init({images:backgroundCheckImages,targets:'.background-check, .swiper-pagination',threshold:70,windowEvents:true})})(jQuery);(function($){$('.header-1.ff-section').each(function(index){$(this).addClass('header-1--id--'+index);var this_section='.header-1--id--'+index+'.ff-section',$this_section=$(this_section);$this_section.find('.logo').mouseenter(function(){BackgroundCheck.refresh()}).mouseleave(function(){BackgroundCheck.refresh()});$this_section.find('.menu-button').mouseenter(function(){BackgroundCheck.refresh()}).mouseleave(function(){BackgroundCheck.refresh()})
function headerVerticalCentering(){var $logoHolder=$this_section.find('.logo-holder'),$menuButtonHolder=$this_section.find('.menu-holder'),$logo=$this_section.find('.logo'),$menuButton=$this_section.find('.menu-button'),logoHeight=$logo.outerHeight(true),menuHeight=$menuButton.outerHeight(true);$menuButtonHolder.css('height','');$logoHolder.css('height','');if(logoHeight>menuHeight){$menuButtonHolder.css('height',logoHeight)}else $logoHolder.css('height',menuHeight)};var $menuItem=$('.side-menu .navigation > li'),$socialItem=$('.side-menu .side-menu__social li'),$menuButton=$this_section.find('.menu-button'),$logo=$('.side-menu .logo-wrapper'),$html=$('html'),$body=$('body'),$contentWrapperOverlay=$('.content-wrapper__overlay');$menuButton.on('click',function(e){e.preventDefault();if($body.hasClass('side-menu-closed')){$body.removeClass('side-menu-closed');$body.addClass('side-menu-opened');$contentWrapperOverlay.fadeIn()}else{$body.removeClass('side-menu-opened');$body.addClass('side-menu-closed');$contentWrapperOverlay.fadeOut()};setTimeout(function(){if(!$('body').hasClass('is-mobile'))BackgroundCheck.refresh()},300);return false});$contentWrapperOverlay.on('click',function(e){e.preventDefault();$body.removeClass('side-menu-opened');$body.addClass('side-menu-closed');$contentWrapperOverlay.fadeOut();setTimeout(function(){BackgroundCheck.refresh()},300)})
function mobileCollapse(){var headerHeight=$this_section.outerHeight();if($('.breakpoint').width()<=1){$('header.header').css('height',headerHeight)}else $('header.header').css('height','')};headerVerticalCentering();mobileCollapse();$(window).load(function(){headerVerticalCentering();mobileCollapse()});$(window).resize(function(){headerVerticalCentering();mobileCollapse()})})})(jQuery);(function($){$('.side-menu-1.ff-section').each(function(index){$(this).addClass('side-menu-1--id--'+index);var this_section='.side-menu-1--id--'+index+'.ff-section',$this_section=$(this_section)
function socialLinksFixed(){var windowHeight=$(window).height(),sideMenuInnerHeight=$this_section.find('.side-menu-inner').outerHeight(),socialLinksHeight=$this_section.find('.side-menu__social').outerHeight();if(sideMenuInnerHeight+socialLinksHeight<windowHeight){$this_section.find('.side-menu__social').addClass('side-menu__social--fixed')}else $this_section.find('.side-menu__social').removeClass('side-menu__social--fixed')};socialLinksFixed();$(window).load(function(){socialLinksFixed()});$(window).resize(function(){socialLinksFixed()})})})(jQuery);(function($){'use strict'
function shuffle(array){var currentIndex=array.length,temporaryValue,randomIndex;while(0!==currentIndex){randomIndex=Math.floor(Math.random()*currentIndex);currentIndex-=1;temporaryValue=array[currentIndex];array[currentIndex]=array[randomIndex];array[randomIndex]=temporaryValue};return array};$('.loader-1.ff-block').each(function(index){$(this).addClass('loader-1--id--'+index);var this_block='.loader-1--id--'+index+'.ff-block',$this_block=$(this_block);if($this_block.hasClass('loader-type-2')){var $animatedLogo=$this_block.find('.logo-animated__wrapper'),imageArray=JSON.parse($animatedLogo.attr('data-images'));shuffle(imageArray);var FADING_LENGTH=0,FADING_DELAY=150,imageIndex=0,animateLogoFunction=function(){imageIndex++;if(imageIndex>=imageArray.length)imageIndex=0;var $dummyImage=$('<img />',{class:'dummy-image',src:imageArray[imageIndex]});$dummyImage.appendTo($this_block.find('.logo-animated__wrapper')).hide().fadeIn(FADING_LENGTH,function(){$dummyImage.siblings('.dummy-image').remove()})},imageInterval=window.setInterval(animateLogoFunction,FADING_DELAY)};$(window).load(function(){window.clearInterval(imageInterval);$this_block.fadeOut('250');if(!$('body').hasClass('is-mobile'))BackgroundCheck.refresh()});$(window).bind('beforeunload',function(){$this_block.css('display','block').css('opacity','0').animate({opacity:1},250);if($this_block.hasClass('loader-type-2'))window.setInterval(animateLogoFunction,FADING_DELAY)})})})(jQuery);