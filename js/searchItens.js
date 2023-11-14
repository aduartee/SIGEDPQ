document.addEventListener('DOMContentLoaded', function () {

    let searchInput = document.getElementById('search');
    
    searchInput.addEventListener('input', function () {
        let searchValue = searchInput.value;
        console.log(searchValue);

        $.ajax({
            url: 'controllers/searchController.php',
            type: 'POST',
            data: {
                itemName: searchValue
            },
            dataType: 'json',
            success: function (data, textStatus, xhr) {
                if (xhr === 200) {
                    console.log(data);
                }
            },
            error: function () {
                if (xhr.status === 500) {
                    Swal.fire('Erro', 'Erro interno', 'error');
                } else {
                    Swal.fire('Erro', 'Erro de comunicação com o servidor', 'error');
                }
            }
        });
    });
});