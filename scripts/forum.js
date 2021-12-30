var cnt=0;
class Vote {
    constructor(id,vote) {
        this.id=id;
        this.vote=vote;
      }
  }
function calibrateTextArea(){
    for(let instanceName in CKEDITOR.instances)
    CKEDITOR.instances[instanceName].updateElement();
}
function showReplyField(btn,id){
    let par=btn.parentElement;
    par=par.parentElement;
    let fc=par.querySelector(".reply_form_container");
    let inp=par.querySelector(".reply_hidden");
    inp.setAttribute("value",id);
    par=par.parentElement;
    fc.style.display="block";
}
function hideReplyField(btn){
    let par=btn.parentElement;
    par=par.parentElement;
    par=par.parentElement;
    par.style.display="none";
}
function voteToServer(v){
    let req=new XMLHttpRequest();
    let url="extra/vote.php";
    let s="s";
	req.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
            if(this.responseText!="true"){
			    //  alert(this.responseText);
                 s=this.responseText;
			}
	  	}
	};
	req.open("POST", url, false);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send("jsonVote="+JSON.stringify(v));
    return s;
}
function upvoteInit(btn,id){
    btn.setAttribute("src","images/spinner.gif");
    setTimeout(function() {
        upvote(btn,id);
    }, 100);
}
function upvote(btn,id){
    let par=btn.parentElement;
    let elems=par.querySelectorAll('img');
    url="images/upvote.svg";
    let cnt=0;
    cnt=voteToServer(new Vote(id,1));
    for(let i=0;i<elems.length;i++) elems[i].classList.remove('active_btn');
    btn.setAttribute("src",url);
    btn.classList.add('active_btn');
    let lbl=par.querySelector('label');
    lbl.innerHTML=cnt;
    
    
}
function downvoteInit(btn,id){
    btn.setAttribute("src","images/spinner.gif");
    setTimeout(function() {
        downvote(btn,id);
    }, 100);
}
function downvote(btn,id){
    let par=btn.parentElement;
    let elems=par.querySelectorAll('img');
    url="images/downvote.svg";
    let cnt=0;
    cnt=voteToServer(new Vote(id,-1));
    for(let i=0;i<elems.length;i++) elems[i].classList.remove('active_btn');
    btn.setAttribute("src",url);
    btn.classList.add('active_btn');
    let lbl=par.querySelector('label');
    lbl.innerHTML=cnt;
    
    
}
