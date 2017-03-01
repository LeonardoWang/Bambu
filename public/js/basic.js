function enterToSearch(thisTextArea,e){
    if(window.event) // IE
    {
        keynum = e.keyCode;
    }
    else if(e.which) // Netscape/Firefox/Opera
    {
        keynum = e.which;
    }

    if (keynum == 13) // press enter
    {
        sb();
    }
}


function sb(){
    s = document.getElementById('inpu1').value;
    if(s){
        category = document.getElementById('category').value;
        if(category=='all'){
            window.location.href="/items/KSearch/" + s;
        }
        else if(category=='art'){
            window.location.href="/items/CSearch/art/" + s;
        }
        else if(category=='beauty'){
            window.location.href="/items/CSearch/beauty/" + s;
        }
        else if(category=='book'){
            window.location.href="/items/CSearch/book/" + s;
        }
        else if(category=='clothing'){
            window.location.href="/items/CSearch/clothing/" + s;
        }
        else if(category=='computer'){
            window.location.href="/items/CSearch/computer/" + s;
        }
        else if(category=='home'){
            window.location.href="/items/CSearch/home/" + s;
        }
        else if(category=='sports'){
            window.location.href="/items/CSearch/sports/" + s;
        }
        else if(category=='toys'){
            window.location.href="/items/CSearch/toys/" + s;
        }
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

function preview(file,num)
{  
    var prevDiv = document.getElementById('preview'+num);
    if (file.files && file.files[0])  
    {  
        var reader = new FileReader();  
        reader.onload = function(evt){  
            $("#preview"+num).css("z-index","1000");
            prevDiv.innerHTML = '<img style="max-height:80px;max-width:80px;" src="' + evt.target.result + '" />';  
        }    
        reader.readAsDataURL(file.files[0]);  
        $('#p_'+num).empty();
    }  
    else
    {  
        $("#preview"+num).css("z-index","1000");
        prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';  
        $('#p_'+num).empty();
    } 
}  

function changeImg(num,address){
    $("#imgdiv").attr({'data-image':'images/'+address}); 
    document.getElementById('img').src='images/'+address;
    $("#li1").css("background", "#dfe2e5");
    $("#li2").css("background", "#dfe2e5"); 
    $("#li3").css("background", "#dfe2e5"); 
    $("#li4").css("background", "#dfe2e5"); 
    $("#li"+num).css("background", "#e53935");  
}
