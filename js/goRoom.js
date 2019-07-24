function go_room(other_user){
    console.log("other_user")
    window.location = `otherRoom.php?mem_name=${this.user_id}&other_user=${other_user}`;
};