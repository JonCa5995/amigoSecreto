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

