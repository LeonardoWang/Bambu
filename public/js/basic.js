function sb(){
    s = document.getElementById('inpu1').value;
    if(s){
        window.location.href="/items/KSearch/" + s;
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

function deleteComment(id){
    var r=confirm("Do you really want to delete this comment?")
    if (r==true)
    {
        $.ajax({
            type:"get",
            url:'/api/trage_requests/delete/'+id,
            data:{},
            async:false,

            success:function(data){
                console.log(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
                //alert(XMLHttpRequest.status);
                //alert(XMLHttpRequest.readyState);
                console.log(textStatus); // paser error;
            }
        });
        window.location.reload();
    }
}

//function uploadProfilePicture(){}