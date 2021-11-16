function hideNav() {
    let nv =  document.getElementById("left_bar");
    let sb =  document.getElementById("search_bar");
    let center=document.getElementById("center");
    let nvbtn=document.getElementById("nav_btn");
    let closebtn=document.getElementById("close_btn");
    closebtn.style.opacity="0";
    nvbtn.style.opacity="1";
    nvbtn.style.cursor="hand";
    center.style.marginLeft="0px";
    sb.style.backgroundColor="hsl(200,5%,100%)";
    nv.style.width="0";
    
}
function showNav() {
    let nv =  document.getElementById("left_bar");
    let sb =  document.getElementById("search_bar");
    let center=document.getElementById("center");
    let nvbtn=document.getElementById("nav_btn");
    let closebtn=document.getElementById("close_btn");
    closebtn.style.opacity="1";
    nvbtn.style.opacity="0";
    nv.style.width="200px";
    center.style.marginLeft="200px";
    nvbtn.style.cursor="default";
    
    
}
function togleNav()
{
    let lnk=document.getElementById("menu_style");
    if(lnk.getAttribute("href")=="css/menu_off.css"){
        lnk.setAttribute("href","css/menu_on.css");
    }
    else{
        lnk.setAttribute("href","css/menu_off.css");
    }
}
