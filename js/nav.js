// 手機選單動畫
function menuMobileTransform() {
    $(".menuMobile_link").click(function (e) {
        e.preventDefault();

        $(".menuMobile_overlay").toggleClass("open");
        $(".menuMobile").toggleClass("open");
    });
}

// 電腦選單hover換圖
function navMousemove() {
    $('.nav_myRoom').mouseover(function () {
        $(this).find('img').attr('src', 'imgs/homePage/icon/room_selected.png');
        $(this).find('span').css('color', '#fffdfd');
    })
    $('.nav_myRoom').mouseout(function () {
        $(this).find('img').attr('src', 'imgs/homePage/icon/room.png');
        $(this).find('span').css('color', '#331c1c');
    })

    $('.nav_dressingRoom').mouseover(function () {
        $(this).find('img').attr('src', 'imgs/homePage/icon/fittingRoom_selected.png');
        $(this).find('span').css('color', '#fffdfd');

    })
    $('.nav_dressingRoom').mouseout(function () {
        $(this).find('img').attr('src', 'imgs/homePage/icon/fittingRoom.png');
        $(this).find('span').css('color', '#331c1c');
    })

    $('.nav_findFriend').mouseover(function () {
        $(this).find('img').attr('src', 'imgs/homePage/icon/friend_selected.png');
        $(this).find('span').css('color', '#fffdfd');

    })
    $('.nav_findFriend').mouseout(function () {
        $(this).find('img').attr('src', 'imgs/homePage/icon/friend.png');
        $(this).find('span').css('color', '#331c1c');
    })

    $('.nav_events').mouseover(function () {
        $(this).find('img').attr('src', 'imgs/homePage/icon/events_selected.png');
        $(this).find('span').css('color', '#fffdfd');

    })
    $('.nav_events').mouseout(function () {
        $(this).find('img').attr('src', 'imgs/homePage/icon/events.png');
        $(this).find('span').css('color', '#331c1c');
    })

    $('.nav_shop').mouseover(function () {
        $(this).find('img').attr('src', 'imgs/homePage/icon/mall_selected.png');
        $(this).find('span').css('color', '#fffdfd');

    })
    $('.nav_shop').mouseout(function () {
        $(this).find('img').attr('src', 'imgs/homePage/icon/mall.png');
        $(this).find('span').css('color', '#331c1c');
    })

    $('.nav_member').mouseover(function () {
        $(this).find('img').attr('src', 'imgs/homePage/icon/member_selected.png');
        $(this).find('span').css('color', '#fffdfd');

    })
    $('.nav_member').mouseout(function () {
        $(this).find('img').attr('src', 'imgs/homePage/icon/member.png');
        $(this).find('span').css('color', '#331c1c');
    })
}

$(document).ready(function () {
    menuMobileTransform();
    navMousemove();
})