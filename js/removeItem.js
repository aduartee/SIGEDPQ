function removeItem(id_item) {
    Swal.fire({
        title: 'Confirmação',
        text: 'Tem certeza de que deseja remover este item?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, remover!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'controllers/itemController.php',
                type: 'POST',
                data: {
                    id: id_item,
                    flag: 'remove'
                },
                success: function (data, textStatus, xhr) {
                    if (xhr.status === 200) {
                        $(`tr[data-id="${id_item}"]`).addClass('fade-out');

                        setTimeout(function () {
                            $(`tr[data-id="${id_item}"]`).remove();
                        }, 500);
                        Swal.fire('Sucesso', 'Item removido com sucesso!', 'success');
                    } else {
                        Swal.fire('Erro', 'Falha ao remover o item', 'error');
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 500) {
                        Swal.fire('Erro', 'Erro interno', 'error');
                    } else {
                        Swal.fire('Erro', 'Erro de comunicação com o servidor', 'error');
                    }
                }
            });
        }
    });
}