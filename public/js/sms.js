        var clock = '';
        var nums = 30;
        var btn;

        function sendSMS(thisBtn){
        btn = thisBtn;
        btn.disabled = true; //将按钮置为不可点击
        btn.innerHTML = 'resend after ' + nums + ' s';
        clock = setInterval(doLoop, 1000); //一秒执行一次

        var iphone=$("#tel").val();
        //console.log(iphone);
        $.ajax({
            type:"get",
            url:'/smscode',
            data:{'iphone':iphone},

            success:function(msg){
                console.log(msg);
                document.getElementById("code").value = msg.code;
                if(msg.stat=='100'){
                    ;//alert('SMS code has sent!');
                }else{
                    alert('SMS code sent failed, check your network.');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {  //#3这个error函数调试时非常有用，如果解析不正确，将会弹出错误框
                console.log(XMLHttpRequest);
                //alert(XMLHttpRequest.status);
                //alert(XMLHttpRequest.readyState);
                console.log(textStatus); // paser error;
            },
        });
        }

        function doLoop()
        {
            nums--;
            if(nums > 0){
                btn.innerHTML = 'resend after ' + nums + ' s';
            }else{
                clearInterval(clock); //清除js定时器
                btn.disabled = false;
                btn.innerHTML = 'send code';
                nums = 30; //重置时间
            }
        }