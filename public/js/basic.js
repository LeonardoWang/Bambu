function sb(){
    s = document.getElementById('inpu1').value;
    if(s){
        window.location.href="/api/items/search/" + s;
    }
    else{
        alert("the search field can't be empty"); 
    }
}

function notifOnMouseOver(btn){
	$('#'+btn.id).css("cursor","pointer");
	document.getElementById(btn.id).src ='/img/icons/svg/'+ btn.id +'-grey.svg';
}

function notifOnMouseOut(btn){
	document.getElementById(btn.id).src ='/img/icons/svg/' + btn.id + '.svg';
}

function checkNotif(){}

