function calibrateTextArea(){
    for(let instanceName in CKEDITOR.instances)
    CKEDITOR.instances[instanceName].updateElement();
}
function showReplyField(btn,id){
    let par=btn.parentElement;
    par=par.parentElement;
    let fc=par.querySelector(".reply_form_container");
    let inp=fc.querySelector("input");
    inp.setAttribute("value",id);
    par=par.parentElement;
    fc.style.display="block";
}
function hideReplyField(btn){
    let par=btn.parentElement;
    par=par.parentElement;
    par=par.parentElement;
    par.style.display="none";
    console.log(par);
}
