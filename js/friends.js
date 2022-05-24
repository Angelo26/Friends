
        $(document).ready(()=>{
            showUsers();
        });

        function showUsers(){
            $.get("includes/showFriends.inc.php", (data)=>{ $(".showUsers").html(data);});
        }
        function followActions(fid, fsts){
            console.log(fid, fsts);
            $.post("includes/followActions.inc.php", {fid:fid, fsts:fsts}, ()=>{ 
                showUsers();        
            });
        }
