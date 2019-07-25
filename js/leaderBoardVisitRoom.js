function goLeaderBoardMemberRoom() {
    $('body').on('click', '.btn-visit', function(){
        let memName = $('.owl-item.active.center')[0].children[0].dataset.memname;
        window.location = `otherRoom.php?other_user=${memName}`;
    })
}

$(document).ready(function () {
    goLeaderBoardMemberRoom();
});
