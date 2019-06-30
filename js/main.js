// 手機選單動畫
function menuMobileTransform() {
  $(".menuMobile_link").click(function(e) {
    e.preventDefault();
    
    $(".menuMobile_overlay").toggleClass("open");
    $(".menuMobile").toggleClass("open");
  });
}

// 好友點擊切換
function chooseFriend() {
  document.querySelectorAll('.friendList_friend').forEach( e => {
    e.addEventListener('mouseover', e=> {
      e.target.style="cursor: pointer";
      e.stopPropagation();
    });
    e.addEventListener('click', e=> {
      console.log("HEY");
      e.stopPropagation();
    })
  });
}

// 開關聊天室
function collapseChatGroup() {
  $(".friendList_open").click(function(e) {
    e.preventDefault();
    
    $(".chatGroup").toggleClass("collapse");
  })

  $(".closeBtn").click(function(el) {
    el.preventDefault();
    $(".closeBtn").css('cursor', 'pointer');
    $(".chatGroup").toggleClass("collapse");
  })
}




window.addEventListener('load', function(){
  menuMobileTransform();
  chooseFriend();
  collapseChatGroup();
});