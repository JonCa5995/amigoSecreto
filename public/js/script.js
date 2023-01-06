function toggleRestablece() {
    let panel = document.getElementById('restablece');
    let btn  = document.getElementById('btnResetClave');
    let login  = document.getElementById('loginForm');
    let loginTitle = document.getElementById('loginTitle');

    login.hidden = !login.hidden;
    panel.hidden = !panel.hidden;
    btn.innerText = panel.hidden ? 'Recuperar clave' : 'Volver';
    btn.classList.toggle('btn-primary');
    btn.classList.toggle('btn-warning');
    loginTitle.innerText = !panel.hidden ? 'Ups ;( parece que se te ha olvida la clave' : 'Inicia sesión para jugar';
}

function editarDeseo(event) {
    let deseoId = document.getElementById('id');
    let descripcion = document.getElementById('descripcion');
    let parent = event.target.parentNode.parentNode.parentNode.previousSibling.previousSibling;
    parent.parentNode.classList.toggle('selected');
    let selected = parent.parentNode.classList.contains('selected');
    for (let tr of parent.parentNode.parentNode.getElementsByClassName('table-warning')) {
        tr.classList.remove('table-warning');
        tr.classList.remove('selected');
    }
    if (selected) {
        deseoId.disabled = false;
        parent.parentNode.classList.add('table-warning');
        descripcion.value = parent.innerText;
        descripcion.focus();
        deseoId.value = parent.previousSibling.previousSibling.firstChild.textContent;
    } else {
        deseoId.disabled = true;
        deseoId.value = '';
        descripcion.value = '';
    }
}

