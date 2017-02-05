function sb(){
    s = document.getElementById('inpu1').value;
    if(s){
        window.location.href="/api/items/search/" + s;
    }
    else{
        alert("the search field can't be empty"); 
    }
}

function notifOnMouseOver(){
	$("#notif").css("cursor","pointer");
	document.getElementById('notif').src ='/img/icons/svg/bell-grey.svg';
}

function notifOnMouseOut(){
	document.getElementById('notif').src ='/img/icons/svg/bell.svg';
}

function checkNotif(){}

