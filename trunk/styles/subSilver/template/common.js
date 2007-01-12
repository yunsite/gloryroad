function ObjectInfo(obid,obname,oblv,obnum)
{
    this.obid = obid;
    this.obname = obname;
	this.oblv = oblv;
	this.obnum = obnum;

}
function skillInfo(skid,skname,sklv)
{
    this.skid = skid;
    this.skname = skname;
	this.sklv = sklv;
}
function formulaInfo(fid,obid,obname,gcion,scion,ccion,skills,objects)
{
	this.fid = fid;
	this.obid = obid;
	this.obname = obname;
	this.gcoin =gcion;
	this.scoin =scion;
	this.ccoin =ccion;
	this.objects=objects;
	this.skills = skills;
}
function getSkillInfo(skillinfo,orderid){
	document.getElementById("skillimg_"+orderid).innerHTML = "<img src=\"images/rpg/skills/"+skillinfo.skid+".gif\" title=\""+skillinfo.skname+"&nbsp;[LV "+skillinfo.sklv+"]"+"\" />";
}
function getObjectInfo(obinfo,orderid){
	document.getElementById("objectsimg_"+orderid).innerHTML = "<img src=\"images/rpg/object/1/"+obinfo.obid+".gif\" title=\""+obinfo.obname+"&nbsp;[LV "+obinfo.oblv+"]"+"\" />";
	document.getElementById("objectsnum_"+orderid).innerHTML = obinfo.obnum;
}

function showSkillInfo(orderid,skillinfo){

	getSkillInfo(skillinfo,orderid);
	document.getElementById("skills"+orderid).style.display = "block";

	
}
function showCost(finfo){
	var fcost="";
	if(finfo.gcoin>0){
		fcost = "<img src=\"images/rpg/g.gif\" />"+finfo.gcoin;
	}
	if(finfo.scoin>0){
		fcost =fcost+"<img src=\"images/rpg/s.gif\" />"+finfo.scoin;
	}
	if(finfo.ccoin>0){
		fcost =fcost+"<img src=\"images/rpg/c.gif\" />"+finfo.ccoin;
	}	
	document.getElementById("fcost").innerHTML =fcost;
	
}
function showObjectInfo(orderid,obinfo){

	getObjectInfo(obinfo,orderid);
	document.getElementById("objects"+orderid).style.display = "block";

	
}

function showFormulaInfo(finfo){

	document.getElementById("objectimg").innerHTML = "<img src=\"images/rpg/object/1/"+finfo.obid+".gif\"/>";
	document.getElementById("objectname").innerHTML = finfo.obname;
	for(var i = 0; i < finfo.skills.length; i++)
	{
		showSkillInfo((i+1),finfo.skills[i]);
	}
	for(var i = 0; i < finfo.objects.length; i++)
	{
		showObjectInfo((i+1),finfo.objects[i]);
	}	
	showCost(finfo);
}
function selectFormulaInfo(sel){

	for(var i = 0; i < allformulas.length; i++)
    {
        if(sel.selectedIndex==0)
		{
			initFormulaInfo();
		}else if(allformulas[i].fid == sel.selectedIndex)
        {
			document.getElementById("fid").value =allformulas[i].fid;
			document.getElementById("domax").disabled =false;
			showFormulaInfo(allformulas[i]);
        }
    }
}
function initFormulaInfo(){
	document.getElementById("selectf").selectedIndex="0";
	document.getElementById("objectimg").innerHTML ="";
	document.getElementById("objectname").innerHTML ="";
	document.getElementById("fcost").innerHTML ="";
	document.getElementById("doit").disabled =true;
	document.getElementById("domax").disabled =true;
	document.getElementById("objectnum").disabled =true;
	document.getElementById("fid").value =0;
	document.getElementById("skills1").style.display="none";
	document.getElementById("skills2").style.display="none";
	document.getElementById("objects1").style.display="none";
	document.getElementById("objects2").style.display="none";

}
function countmax(){
	if(document.getElementById("fid").value>0&&document.getElementById("buildid").value>0)
	xajax_objectscount(document.getElementById("fid").value,document.getElementById("buildid").value);
	document.getElementById("domax").disabled =true;
	document.getElementById("doit").focus();

}
function dostart(){
	if(document.getElementById("fid").value>0&&document.getElementById("buildid").value>0){
		if (document.getElementById("objectnum").value>0)
		{
			//messageinfo("开始制作中,请稍后.");
			xajax_objectsstart(document.getElementById("fid").value,document.getElementById("buildid").value,document.getElementById("objectnum").value);
			document.getElementById("domax").disabled =true;
			document.getElementById("doit").focus();
		}

	}


}

function checkEdit(){
	if(document.getElementById("objectnum").value>document.getElementById("max").value){
		document.getElementById("objectnum").value = document.getElementById("max").value;
	}
}
