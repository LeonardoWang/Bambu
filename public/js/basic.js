function sb(){
            s = document.getElementById('inpu1').value;
            if(s){
            window.location.href="/api/items/search/" + s;
            }
            else
                alert("the search field can't be empty"); 
        }

        function home(){
            window.location.href="/";
        }