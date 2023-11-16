document.addEventListener('DOMContentLoaded', function () {
    let description = document.getElementById('description');

    changeContent(description.value);

    description.addEventListener('input', function () {
        changeContent(description.value);
    });
});

function changeContent(description) {
    let descriptionInfo = document.getElementById('description-info');
    descriptionInfo.innerHTML = description;
}
