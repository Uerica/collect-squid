function init() {
    // if($("#giveHeart").text() == "給我你的愛") {
        $('#giveHeart').click(giveHeart);
    // }
    // } else {
    //     $('#giveHeart').click(retriveHeart);
    // }
    console.log(document.getElementById('isLove').value);
}

function giveHeart() {
    const xhr = new XMLHttpRequest();
    
    xhr.onload = function() {
        if(xhr.status == 200) {
            if( document.getElementById('isLove').value == "giving") {
                document.getElementById('isLove').value = "retriving";
                $('#giveHeart').text('我不愛你了');
            } else {
                document.getElementById('isLove').value = "giving";
                $('#giveHeart').text('給我你的愛');
            }
        } else {
            alert(xhr.status);
        }
    }

    const url = `giveHeart.php`;
    xhr.open('post', url, true);

    const heartForm = document.getElementById('heartForm');
    const form = new FormData(heartForm);
    xhr.send(form);
}

// function retriveHeart() {
//     const xhr = new XMLHttpRequest();

//     xhr.onload = function() {
//         if(xhr.status == 200) {
//             console.log(xhr.responseText);
//             $('#giveHeart').text('');
//         } else {
//             alert(xhr.status);
//         }
//     }

//     const url = `giveHeart.php`;
//     xhr.open('post', url, true);

//     const heartForm = document.getElementById('heartForm');
//     const form = new FormData(heartForm);
//     xhr.send(form);
// }

window.onload = init;