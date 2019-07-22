/*
收集友誼 後台
使用技術為jQuery AJAX 
操作行為有新增、刪除、修改、查詢，每個function包含一整套的獨立行為

依照操作行為區分
每種行為對應的php檔案分別為：　
    -新增：POST.php
    -刪除：DELETE.php
    -修改：PUT.php


後台可分為六個部分：

1.管理員帳號管理(addNewManager)
    -新增、刪除、修改

2.聊天機器人管理(addNewRobotResponse)
    -新增、刪除、修改

3.會員帳號管理(memberBanned)
    -查詢、停權

4.家具管理(furnitureStatus)
    -查詢、修改(上下架商品)

5.服裝管理(clothingStatus)
    -修改、查詢

6.活動圖片管理(isBanner)
    -查詢、修改(設為banner)

*/

// 1.管理員帳號管理
function addNewManager() {
    $('body').on('click', '#btn-newManager', function(){
        let editNewManager = $("<tr class='newManager'></tr>").html(
            `<td></td>
            <td><input class="form-control" id="edit-mngName" type="text" value="" name="mng"></td>
            <td><input class="form-control" id="edit-mngPsw" type="text" value="" name="mng"></td>
            <td>
                <button type="button" class="btn btn-outline-info btn-add" id="btn-addManager">新增</button>
                <button type="button" class="btn btn-outline-danger btn-del" id="btn-cancelManager">取消</button>
            </td>`);
        if($('.newManager').length == 0) {
            $('#manager').append(editNewManager);
        } 
    })
    $('body').on('click', '#btn-cancelManager', function(){
        this.parentElement.parentElement.remove();
    })
    $('body').on('click', '#btn-addManager', function() {
        let mng_name = $('#edit-mngName').val();
        let mng_psw = $('#edit-mngPsw').val();
        if ( (mng_name && mng_psw) ) {
            let data = {
                table_name: 'manager',
                mng_name: mng_name,
                mng_psw: mng_psw,
            };
            let jsonStr = JSON.stringify(data);
            let btn_this = this;

            $.ajax({
                type: "POST",
                url: `POST.php?jsonStr=${jsonStr}`,
                success: function (dataString) {
                    let response = JSON.parse(dataString);
                    let newManager = $("<tr></tr>").html(`
                    <td>${response.latestId}</td>
                    <td><input class="form-control mng_name" type="text" value="${mng_name}" name="mng" readonly></td>
                    <td><input class="form-control mng_psw" type="text" value="${mng_psw}" name="mng" readonly></td>
                    <td>
                        <button type="button" class="btn btn-outline-secondary btn-edit btn-editMng">編輯</button>
                        <button type="button" class="btn btn-outline-danger btn-del btn-delMng">刪除</button>
                    </td>`);
                    $('#manager').append(newManager);
                    btn_this.parentElement.parentElement.remove();
                    alert('新增成功');
                },
                error: (e) => handleAjaxError(e, '管理員名稱重複，請重新再試')
            });
        } else {
            alert('帳號或密碼不能為空白');
        }
    })
    $('body').on('click', '.btn-delMng', function() {
        let mng_no = $(this.parentElement.parentElement.children[0]).text();
        let data = {
            table_name: 'manager',
            mng_no: mng_no,
        }
        let jsonStr = JSON.stringify(data);
        let btn_this = this;

        $.ajax({
            type: "DELETE",
            url: `DELETE.php?jsonStr=${jsonStr}`,
            success: function(response){
                btn_this.parentElement.parentElement.remove();
                alert('成功刪除')
            },
            error: function(e) {
                console.log(JSON.parse(e));
            }
        })
    })
    $('body').on('click', '.btn-editMng', function() {
        if (this.classList.contains('btn-editing')) {
            this.classList.remove('btn-editing');
            $(this.parentElement.parentElement.children).find('.mng_name').prop('readonly', true);
            $(this.parentElement.parentElement.children).find('.mng_psw').prop('readonly', true);
            $(this).text("編輯");
        } else {
            this.classList.add('btn-editing');
            $(this.parentElement.parentElement.children).find('.mng_name').prop('readonly', false);
            $(this.parentElement.parentElement.children).find('.mng_psw').prop('readonly', false);
            $(this).text('儲存');
        }
    })
    $('body').on('click', '.btn-editing', function() {
        let mng_no = $(this.parentElement.parentElement.children[0]).text();
        let mng_name = $(this.parentElement.parentElement.children).find('.mng_name').val();
        let mng_psw = $(this.parentElement.parentElement.children).find('.mng_psw').val();
        let data = {
            table_name: 'manager',
            mng_no: mng_no,
            mng_name: mng_name,
            mng_psw: mng_psw,
        };
        console.log(data);
        let jsonStr = JSON.stringify(data);
        let btn_this = this;
        $.ajax({
            type: "PUT",
            url: `PUT.php?jsonStr=${jsonStr}`,
            success: function (response) {
                console.log(response);
                alert('修改成功');
            },
            error: (e) => handleAjaxError(e, '編輯失敗，請聯繫系統管理員')
        })
    })
}

// 2.聊天機器人管理
function addNewRobotResponse() {
    $('body').on('click', '#btn-newResp', function(){
        let editNewResp = $("<tr class='newRobotResp'></tr>").html(`
            <td id="edit-keyNo"></td>
            <td id="edit-resNo"></td>
            <td><input class="form-control" id="edit-keyCnt" type="text" value=""></td>
            <td><input class="form-control" id="edit-resCnt" type="text" value=""></td>
            <td>
                <button type="button" class="btn btn-outline-info btn-add" id="btn-addResp">新增</button>
                <button type="button" class="btn btn-outline-danger btn-del" id="btn-cancelResp">取消</button>
            </td>`);
        if($('.newRobotResp').length == 0) {
            $('#robot').append(editNewResp);
        } 
        $('.btn-del').on('click', function() {
            this.parentElement.parentElement.remove();
        })
    })
    $('body').on('click', '#btn-cancelResp', function(){
        this.parentElement.parentElement.remove();
    })
    $('body').on('click', '#btn-addResp', function() {
        let key_cnt = $('#edit-keyCnt').val();
        let res_cnt = $('#edit-resCnt').val();
        if ( (key_cnt && res_cnt) ) {
            let data = {
                table_name: 'robot_keyword',
                key_cnt: key_cnt,
                res_cnt: res_cnt,
            };
            let jsonStr = JSON.stringify(data);
            let btn_this = this;
            $.ajax({
                type: "POST",
                url: `POST.php?jsonStr=${jsonStr}`,
                success: function (dataString) {
                    let response = JSON.parse(dataString);
                    let newRobotResp = $("<tr class='newRobotResp'></tr>").html(`
                    <td class="key_no">${response.latestId}</td>
                    <td class="res_no">${response.latestId}</td>
                    <td><input class="form-control key_cnt" type="text" value="${key_cnt}" readonly></td>
                    <td><input class=" form-control res_cnt" type="text" value="${res_cnt}" readonly></td>
                    <td>
                        <button type="button" class="btn btn-outline-secondary btn-edit btn-editRobotKeyword">編輯</button>
                        <button type="button" class="btn btn-outline-danger btn-del btn-delRobotKeyword">刪除</button>
                    </td>`);
                $('#robot').append(newRobotResp);
                btn_this.parentElement.parentElement.remove();
                alert('新增成功');
                },
                error: (e) => handleAjaxError(e, '新增失敗')
            });
        } else {
            alert('帳號或密碼不能為空白');
        }
    })
    $('body').on('click', '.btn-delRobotKeyword', function() {
        let key_no = $(this.parentElement.parentElement.children[0]).text();
        let data = {
            table_name: 'robot_keyword',
            key_no: key_no,
        }
        let jsonStr = JSON.stringify(data);
        let btn_this = this;

        $.ajax({
            type: "DELETE",
            url: `DELETE.php?jsonStr=${jsonStr}`,
            success: function(){
                btn_this.parentElement.parentElement.remove();
                alert('成功刪除')
            },
            error: function(e) {
                console.log(JSON.parse(e));
            }
        })
    })
    $('body').on('click', '.btn-editRobotKeyword', function() {
        if (this.classList.contains('btn-editingRobotKeyword')) {
            this.classList.remove('btn-editingRobotKeyword');
            $(this.parentElement.parentElement.children).find('.key_cnt').prop('readonly', true);
            $(this.parentElement.parentElement.children).find('.res_cnt').prop('readonly', true);
            $(this).text("編輯");
        } else {
            this.classList.add('btn-editingRobotKeyword');
            $(this.parentElement.parentElement.children).find('.key_cnt').prop('readonly', false);
            $(this.parentElement.parentElement.children).find('.res_cnt').prop('readonly', false);
            $(this).text('儲存');
        }
    })
    $('body').on('click', '.btn-editingRobotKeyword', function() {
        let key_no = $(this.parentElement.parentElement.children[0]).text();
        let key_cnt = $(this.parentElement.parentElement.children).find('.key_cnt').val();
        let res_cnt = $(this.parentElement.parentElement.children).find('.res_cnt').val();
        let data = {
            table_name: 'robot_keyword',
            key_no: key_no,
            key_cnt: key_cnt,
            res_cnt: res_cnt,
        };
        console.log(data);
        let jsonStr = JSON.stringify(data);
        let btn_this = this;
        $.ajax({
            type: "PUT",
            url: `PUT.php?jsonStr=${jsonStr}`,
            success: function (response) {
                console.log(response);
                alert('修改成功');
            },
            error: (e) => handleAjaxError(e, '編輯失敗，請聯繫系統管理員')
        })
    })
}

// 3.會員帳號管理
function memberBanned() {
    $('body').on('click', '.btn-memStatus', function(){
        let mem_no = $(this.parentElement.parentElement.children[0]).text();
        let mem_status = $(this.parentElement.parentElement.children).find('.btn-memStatus').text();
        let mem_status_boolean = $.trim(mem_status) === '正常' ? 1 : 0;
        let data = {
            table_name: `member`,
            mem_no: mem_no,
            mem_status_boolean: mem_status_boolean,
        };
        let jsonStr = JSON.stringify(data);
        let btn_this = this;
        $.ajax({
            type: "PUT",
            url: `PUT.php?jsonStr=${jsonStr}`,
            success: function(response) {
                console.log(response);
                if($(btn_this).hasClass('btn-avaliable')) {
                    $(btn_this).removeClass('btn-avaliable');
                    $(btn_this).addClass('btn-banned');
                    $(btn_this).text('停權');
                } else {
                    $(btn_this).removeClass('btn-banned');
                    $(btn_this).addClass('btn-avaliable');
                    $(btn_this).text('正常');
                }
            },
            error: (e) => handleAjaxError(e, '編輯失敗')
        })
    })
}

// 4.家具管理
function furnitureStatus() {
    $('body').on('click', '.btn-furnStatus', function(){
        let furn_no = $(this.parentElement.parentElement.children[0]).text();
        let furn_status = $(this.parentElement.parentElement.children).find('.btn-furnStatus').text();
        let furn_status_boolean = $.trim(furn_status) === '上架' ? 1 : 0;
        let data = {
            table_name: `product_furniture`,
            furn_no: furn_no,
            furn_status_boolean: furn_status_boolean,
        };
        let jsonStr = JSON.stringify(data);
        let btn_this = this;
        $.ajax({
            type: "PUT",
            url: `PUT.php?jsonStr=${jsonStr}`,
            success: function(response) {
                console.log(response);
                if($(btn_this).hasClass('btn-furnOn')) {
                    $(btn_this).removeClass('btn-furnOn');
                    $(btn_this).addClass('btn-furnOff');
                    $(btn_this).text('下架');
                } else {
                    $(btn_this).removeClass('btn-furnOff');
                    $(btn_this).addClass('btn-furnOn');
                    $(btn_this).text('上架');
                }
            },
            error: (e) => handleAjaxError(e, '編輯失敗')
        })
    })
    $('body').on('click', '.btn-editFurn', function(){
        if (this.classList.contains('btn-editingFurn')) {
            this.classList.remove('btn-editingFurn');
            $(this.parentElement.parentElement.children).find('.furn_name').prop('readonly', true);
            $(this.parentElement.parentElement.children).find('.furn_price').prop('readonly', true);
            $(this).text("編輯");
            // alert('修改成功');
        } else {
            this.classList.add('btn-editingFurn');
            $(this.parentElement.parentElement.children).find('.furn_name').prop('readonly', false);
            $(this.parentElement.parentElement.children).find('.furn_price').prop('readonly', false);
            $(this).text('儲存');
        }
    })
    $('body').on('click', '.btn-editingFurn', function(){
        let furn_no = $(this.parentElement.parentElement.children[0]).text();
        let furn_name = $(this.parentElement.parentElement.children).find('.furn_name').val();
        let furn_price = $(this.parentElement.parentElement.children).find('.furn_price').val();
        let data = {
            table_name: 'product_furniture_M',
            furn_no: furn_no,
            furn_name: furn_name,
            furn_price: furn_price,
        };
        console.log(data);
        let jsonStr = JSON.stringify(data);
        let btn_this = this;
        $.ajax({
            type: "PUT",
            url: `PUT.php?jsonStr=${jsonStr}`,
            success: function (response) {
                console.log(response);
                alert('修改成功');
            },
            error: (e) => handleAjaxError(e, '編輯失敗，請聯繫系統管理員')
        })
    })
}

// 5.服裝管理
function clothingStatus() {
    $('body').on('click', '.btn-editClo', function(){
        if (this.classList.contains('btn-editingClo')) {
            this.classList.remove('btn-editingClo');
            $(this.parentElement.parentElement.children).find('.clo_name').prop('readonly', true);
            $(this).text("編輯");
            // alert('修改成功');
        } else {
            this.classList.add('btn-editingClo');
            $(this.parentElement.parentElement.children).find('.clo_name').prop('readonly', false);
            $(this).text('儲存');
        }
    })
    $('body').on('click', '.btn-editingClo', function(){
        let clo_no = $(this.parentElement.parentElement.children[0]).text();
        let clo_name = $(this.parentElement.parentElement.children).find('.clo_name').val();
        let data = {
            table_name: 'product_clothing',
            clo_no: clo_no,
            clo_name: clo_name,
        };
        console.log(data);
        let jsonStr = JSON.stringify(data);
        let btn_this = this;
        $.ajax({
            type: "PUT",
            url: `PUT.php?jsonStr=${jsonStr}`,
            success: function (response) {
                console.log(response);
                alert('修改成功');
            },
            error: (e) => handleAjaxError(e, '編輯失敗，請聯繫系統管理員')
        })
    })
}

// 6.活動圖片管理
function isBanner() {
    $('body').on('click', '.btn-banner', function(){
        let evt_no = $(this.parentElement.parentElement.children[0]).text();
        let isBanner = $(this.parentElement.parentElement.children).find('.btn-banner').text();
        let bannerStatus = $.trim(isBanner) === '是' ? 1 : 0;
        let data = {
            table_name: `events`,
            evt_no: evt_no,
            bannerStatus: bannerStatus,
        };
        console.log(data);
        let jsonStr = JSON.stringify(data);
        let btn_this = this;
        $.ajax({
            type: "PUT",
            url: `PUT.php?jsonStr=${jsonStr}`,
            success: function(response) {
                console.log(response);
                if($(btn_this).hasClass('btn-isBanner')) {
                    $(btn_this).removeClass('btn-isBanner');
                    $(btn_this).addClass('btn-isNotBanner');
                    $(btn_this).text('否');
                } else {
                    $(btn_this).removeClass('btn-isNotBanner');
                    $(btn_this).addClass('btn-isBanner');
                    $(btn_this).text('是');
                }
            },
            error: (e) => handleAjaxError(e, '編輯失敗')
        })
    })
}


// 搜尋功能
function searchData() {
    $('#search-member').on('keyup', function(){
        let value = $(this).val().toLowerCase();
        $('#member tr').filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $('#search-furniture').on('keyup', function(){
        let value = $(this).val().toLowerCase();
        $('#furniture tr').filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $('#search-clothing').on('keyup', function(){
        let value = $(this).val().toLowerCase();
        $('#clothing tr').filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $('#search-event').on('keyup', function(){
        let value = $(this).val().toLowerCase();
        $('#event tr').filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
};

// 共用 - 報錯訊息
function handleAjaxError(e, message) {
    let json;
    try {
        json = JSON.parse(e);
    }
    catch (exception) {
        json = e;
    }
    console.log(json);
    message && alert(message);
}


$(document).ready(function () {
    addNewManager();
    addNewRobotResponse();
    memberBanned();
    furnitureStatus();
    clothingStatus();
    isBanner();
    searchData();
});

