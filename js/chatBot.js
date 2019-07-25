
//第二版 連資料庫
window.addEventListener("load",function(){
document.getElementById("chatSubmit").onclick = getAns;//輸入文字

let questionTags = document.getElementsByClassName("questionTag");//關鍵字
for( let i=0; i<questionTags.length; i++){
    questionTags[i].onclick = getAns2;

    
}
})

function getAns(){//輸入文字
let xhr = new XMLHttpRequest();
let question = document.getElementById("chatInput").value;
xhr.onload = function(){
    if(xhr.status == 200){ //http狀態碼 成功
        if( xhr.responseText == "notFound"){
            alert('目前機器人沒有此答案, 請輸入關鍵字');
        }else{
            //-------------------------------------Tr.
            let chatBotBox = document.getElementById("chatContainer");
            let chatContainer = document.querySelector(".chatContainer");
            let chatBtn = document.querySelector(".chatButton");
            let newQA_item = chatContainer.cloneNode(true);
            newQA_item.style.display = "";
            newQA_item.querySelector(".chat_A p").innerHTML = xhr.responseText;
            newQA_item.querySelector(".chat_Q p").innerHTML = question;
            chatBotBox.insertBefore(newQA_item, chatBtn);
            document.getElementById("chatInput").value="";
        };

    }else{
        alert(xhr.status);
    };
};
let url = "getAns.php?type=text&chatInput=" + document.getElementById("chatInput").value;
xhr.open("get",url,true);
xhr.send(null);

document.getElementById('chatContainer').scrollTop = document.getElementById('chatContainer').scrollHeight;
};

function getAns2(e){
let xhr = new XMLHttpRequest();
let questionTag = e.target.innerText;
xhr.onload = function(){
    if(xhr.status == 200){
        if( xhr.responseText == "notFound"){
            alert('目前機器人沒有此答案, 請輸入關鍵字');
        }else{
            //chatContainer
            let chatBotBox = document.getElementById("chatContainer");
            let chatContainer = document.querySelector(".chatContainer");
            let chatBtn = document.querySelector(".chatButton");
            let newQA_item = chatContainer.cloneNode(true);
            newQA_item.style.display = "";
            newQA_item.querySelector(".chat_A p").innerHTML = xhr.responseText;
            newQA_item.querySelector(".chat_Q p").innerHTML = questionTag;
            chatBotBox.insertBefore(newQA_item, chatBtn);
        };

    }else{
        alert(xhr.status);
    };
};


let url = "getAns.php?type=tag&keyword=" + e.target.innerText;//??
xhr.open("get",url,true);
xhr.send(null);

document.getElementById('chatContainer').scrollTop = document.getElementById('chatContainer').scrollHeight;
};
