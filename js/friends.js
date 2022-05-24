$(document).ready(()=>{

    $.get("includes/showFriends.inc.php", function(data){ $(".showUsers").html(data);});
});