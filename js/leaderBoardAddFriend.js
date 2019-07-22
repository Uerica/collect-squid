function addLeaderBoardFriend() {
    $('body').on('click', '.btn-addFriend', function() {
        let f_no = '<?php echo friendNo; ?>';
        // let f_noSelected = $('.owl-item .active .center').children[0].dataset;
        // console.log(f_noSelected);
        let a = $('.owl-item')[0].children[0].value;
        console.log(a)
        let mem_no = '<?php echo $_SESSION("mem_no"); ?>';
        let friend_no = '';
        let status = 0;
        let data = {
            table_name: 'friendLB',
            mem_no: 'mem_no',
            friend_no: 'friend_no',
            status: 'status',
        };
        // console.log(data);
        let jsonStr = JSON.stringify(data);
        let btn_this = this;
        $.ajax({
            type: "PUT",
            url: `PUT.php?jsonStr=${jsonStr}`,
            success: function (response) {
                console.log(response);
                alert('修改成功');
            },
            // error: (e) => handleAjaxError(e, '已是朋友')
        })
    })
}

// function handleAjaxError(e, message) {
//     let json;
//     try {
//         json = JSON.parse(e);
//     }
//     catch (exception) {
//         json = e;
//     }
//     console.log(json);
//     message && alert(message);
// }


$(document).ready(function () {
    addLeaderBoardFriend();
});
