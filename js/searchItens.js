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
        'lab1': 1,
        'lab2': 2,
        'lab3': 3,
        'lab4': 4,
        'lab5': 5,
        'lab6': 6,
        'lab7': 7,
        'lab8': 8,
        'lab9': 9,
        'lab10': 10,
        'lab11': 11,
        'salaCoor': 12,
        'sala101': 13,
        'sala101A': 14,
        'sala102': 15,
        'sala104': 16,
        'sala111': 17,
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

                data.forEach(function (contact) {
                    let searchRow =
                        `
                        <tr class="color-change" data-id="${contact.id}">
                            <td class="text-center">${contact.id}</td>
                            <td class="text-center">${contact.nome_item}</td>
                            <td class="text-center">${contact.nome}</td>
                            <td class="text-center">${formatLab(contact.laboratorio)}</td>
                            <td class="text-center">${formatDate(contact.data)}</td>
                            <td class="text-center">${formatDate(contact.data_coleta)}</td>
                            <td class="text-center">${contact.quantidade}</td>
                            <td class="text-center">${contact.reagente}</td>
                            <td class="text-center">${formatResidues(contact.grupo_residuo)}</td>
                            <td>
                                <button onclick="window.location.href='views/edita.php?id=${contact.id}'" class="btn btn-primary btnEdit">Editar<i class="fa-solid fa-pen-to-square ms-2"></i></button>
                                <button class="btn btn-danger btnEdit ms-4" data-toggle="modal" onclick="removeItem(${contact.id})">Remover<i class="fa-solid fa-trash-can ms-2"></i></button>
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
