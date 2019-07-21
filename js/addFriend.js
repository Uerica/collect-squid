function addFriend(mem_name , friend_name){
    const xhr = new XMLHttpRequest();
    xhr.onload = () => {
        if (xhr.status == 200) {
            console.log('addFriend OK');
        } else {
            console.error(xhr.responseText);
        }
    };
    const url = `addFriend.php?mem_name=${mem_name}&friend_name=${friend_name}`;
    xhr.open("get", url, true);
    xhr.send(null);
}