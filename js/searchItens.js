function formatDate(date) {
    let formatDate = new Date(date).toLocaleDateString("pt-BR");
    return formatDate;
}

function formatResidues(residue) {
    let mapping = {
        'soh': 0,
        'sonh': 1,
        'sopp': 2,
        'aquaso': 3,
        'aquosocromo': 4,
        'aquosocianeto': 5,
        'solido': 6
    };
    let position = mapping[residue]
    let resiudes = ['SOH', 'SOñH', "SOPP", 'Aquoso sem cromo e cianeto', 'Aquoso com cromo', 'Aquoso com cianeto', 'Sólido'];
    let residueName = resiudes[position];
    return residueName;
}

function formatLab(lab) {
    let mapping = {
        'lab1': 0,
        'lab2': 1,
        'lab3': 2,
        'lab4': 3,
        'lab5': 4,
        'lab6': 5,
        'lab7': 6,
        'lab8': 7,
        'lab9': 8,
        'lab10': 9,
        'lab11': 10,
        'salaCoor': 11,
        'sala101': 12,
        'sala101A': 13,
        'sala102': 14,
        'sala104': 15,
        'sala111': 16,
    };

    let position = mapping[lab];
    let laboratory = ['Laboratório 1', 'Laboratório 2', 'Laboratório 3', 'Laboratório 4', 'Laboratório de Espectrofotometria', 'Laboratório de Potenciometria', 'Laboratório de Cromatografia', 'Laboratório de Microbiologia', 'Laboratório de Polímeros', 'Laboratório de Pesquisa', 'Laboratório de Preparo', 'Sala de Coordenação', 'Sala de Aula – 101', 'Sala de Professores – 101A', 'Sala de Professores – 102', 'Sala de Aula – 104', 'Sala de Aula – 111'];
    let labName = laboratory[position];
    return labName;
}

document.addEventListener('DOMContentLoaded', function () {

    let searchInput = document.getElementById('search');

    searchInput.addEventListener('input', function () {
        let searchValue = searchInput.value;

        $.ajax({
            url: 'controllers/searchController.php',
            type: 'POST',
            data: {
                itemName: searchValue
            },
            dataType: 'json',
            success: function (data, textStatus, xhr) {
                $('#returnTable tbody').empty();

                data.forEach(function (item) {
                    let searchRow =
                        `
                        <tr class="color-change" data-id="${item.id}">
                            <td class="text-center">${item.id}</td>
                            <td class="text-center">${item.nome_item}</td>
                            <td class="text-center">${item.nome}</td>
                            <td class="text-center">${formatLab(item.laboratorio)}</td>
                            <td class="text-center">${formatDate(item.data)}</td>
                            <td class="text-center">${formatDate(item.data_coleta)}</td>
                            <td class="text-center">${item.quantidade}</td>
                            <td class="text-center">${item.reagente}</td>
                            <td class="text-center">${formatResidues(item.grupo_residuo)}</td>
                            <td>
                                <button onclick="window.location.href='views/formItem.php?id=${item.id}'" class="btn btn-primary btnEdit">Editar<i class="fa-solid fa-pen-to-square ms-2"></i></button>
                                <button class="btn btn-danger btnEdit ms-4" data-toggle="modal" onclick="removeItem(${item.id})">Remover<i class="fa-solid fa-trash-can ms-2"></i></button>
                            </td>
                        </tr>
                    `;
                    $('#returnTable tbody').append(searchRow);
                });

            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(xhr);
                console.log(textStatus);
                if (xhr.status === 500) {
                    Swal.fire('Erro', 'Erro interno', 'error');
                } else {
                    Swal.fire('Erro', 'Erro de comunicação com o servidor', 'error');
                }
            }
        });
    });
});
