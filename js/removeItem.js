
function removeItem(id_item){
    $('#exampleModal').modal('show');

    $('#remove').on("click", function(){
        window.location.href = "remover.php&id=" + id_item;
    });
}