var body=document.body,agent=navigator.userAgent
var isIE,isIE4,isIE5,isIE6,isOpr,isMoz

var l

String.prototype.inc=function(k1,k2){return k2==null?this.indexOf(k1)>-1?true:false:(k2+this+k2).indexOf(k2+k1+k2)>-1?true:false}


isOpr=agent.inc("Opera")
isIE=agent.inc("IE")&&!isOpr
isIE4=agent.inc("IE 4")
isIE5=agent.inc("IE 5")||agent.inc("IE 4")
isIE6=isIE&&!isIE5
isMoz=agent.inc("Mozilla")&&!isOpr&&!isIE
if(isIE4){
	document.getElementById=function(key){return document.all[key]}
	document.getElementsByName=function(key){var a=new Array(),ol=document.all;for(i=0;i<ol.length;i++){if(ol[i].name==key)a[a.length]=ol[i];}return a}
	document.getElementsByTagName=function(key){var a=new Array(),ol=document.all;for(i=0;i<ol.length;i++){if(ol[i].tagName.toLowerCase()==key)a[a.length]=ol[i];}return a}
}
if(isMoz){
	Event.prototype.__defineGetter__("srcElement",function(){var node=this.target;while(node.nodeType!=1){node=node.parentNode}return node})
	HTMLElement.prototype.__defineGetter__("children",function(){return this.childNodes})
	HTMLElement.prototype.__defineGetter__("parentElement",function(){return this.parentNode})
}
function msg(key,run){
	var l
	l="<div align=center style=height:45px;margin-top:60px class=msg>"+key+"</div>"
	l+="<div align=center><input id=btDlgOk type=button value='确定' onclick='dlg_hide()' class=bt70 style='cursor:pointer;font:12px;'></div>"
	dlg_show(l,300,160,run)
	document.getElementById("btDlgOk").focus()
}
function messageinfo(key,run){
	var l
	l="<div align=center style=height:45px;margin-top:60px class=msg>"+key+"</div>"
	l+="<div align=center></div>"
	dlg_show(l,300,160,run);
	document.getElementById("bxDlg").focus()

}
function conf(key,run){
	var l
	l="<div align=center style=height:45;margin-top:60 class=msg>"+key+"</div>"
	l+="<div align=center><input id=btDlgOk type=button value='确定' onclick='dlg_hide()' class=bt70 style='cursor:pointer;font:12px;'>&nbsp;&nbsp;<input id=btDlgNo type=button value='取消' onclick='dlg_hide(1)' style='cursor:pointer;font:12px;'></div>"
	dlg_show(l,300,160,run)
	document.getElementById("btDlgNo").focus()
}
function dlg_show(key,w,h,run){
	var ol
	document.getElementById("bxDlg").run=run
	document.getElementById("bxDlg").style.width=w+"px"
	document.getElementById("bxDlg").style.height=h+"px"
	document.getElementById("bxDlg").style.left=(document.documentElement.scrollWidth-w)/2+"px"
	document.getElementById("bxDlg").style.top=document.documentElement.clientHeight/2+document.documentElement.scrollTop-h/2+"px"
	document.getElementById("bxDlg").innerHTML=key
	document.getElementById("bxDlg_bg").style.height=document.getElementById("bodymain").offsetTop+document.getElementById("bodymain").offsetHeight+"px"
	if(isIE5)
		document.getElementById("bxDlg_bg").innerHTML="<embed src=images/rpg/dlg_bg.swf quality=high scale=noborder wmode=transparent style=width:100%;height:100%;position:absolute;left:0;top:0 align=middle allowScriptAccess=sameDomain type=application/x-shockwave-flash /><div style=position:absolute;left:0;top:0;width:100%;height:100%;background:url()>&nbsp;</div>"
	else
		dlg_fadeBg(0)
	if(!isMoz&&!isOpr){
		ol=document.getElementsByTagName("select")
		for(i=0;i<ol.length;i++){
			hide(ol[i])
		}
	}
	if(isIE5||isOpr){
		ol=document.getElementsByTagName("div")
		for(i=0;i<ol.length;i++){
			if(ol[i].getAttribute("etype")=="dlghide")
				hide(ol[i])
		}
	}
	show("bxDlg")
	show("bxDlg_bg")
}
function dlg_fadeBg(index){
	if(isIE6){
		document.getElementById("bxDlg_bg").innerHTML="<div id=bxDlg_bg1 style=height:100%;background:black;filter:alpha(opacity="+index+")>&nbsp;</div>"
		if(index<15)
			window.setTimeout("dlg_fadeBg("+(index+3)+")",10)
	}
	else{
		if(index==0)
			document.getElementById("bxDlg_bg1").style.visibility=document.getElementById("bxDlg_bg2").style.visibility=document.getElementById("bxDlg_bg3").style.visibility=document.getElementById("bxDlg_bg4").style.visibility=document.getElementById("bxDlg_bg5").style.visibility="hidden"
		else
			document.getElementById("bxDlg_bg"+index).style.visibility=""
		if(index<5)
			window.setTimeout("dlg_fadeBg("+(index+1)+")",10)
	}
}
function dlg_hide(isNo){
	var ol
	var flag
	if(!isMoz&&!isOpr){
		ol=document.getElementsByTagName("select")
		for(i=0;i<ol.length;i++){
			show(ol[i])
		}
	}
	if(isIE5||isOpr){
		ol=document.getElementsByTagName("div")
		for(i=0;i<ol.length;i++){
			if(ol[i].getAttribute("etype")=="dlghide")
				show(ol[i])
		}
	}
	document.getElementById("bxDlg_bg").style.height=300
	if(!isIE5)
		dlg_fadeBg(0)
	hide("bxDlg")
	hide("bxDlg_bg")
	if(document.getElementById("bxDlg").run!=null&&isNo!=1)
		eval(document.getElementById("bxDlg").run)


}
function show(obj){
	document.getElementById(obj).style.visibility=""
}
function hide(obj){
	document.getElementById(obj).style.visibility="hidden"
}



