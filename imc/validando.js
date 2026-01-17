function validar() {
    let user=document.getElementById('usuario').value;
    let pass=document.getElementById('clave').value;
    if (user =="Liz" && pass =="1234") {
        window.location="index.php";
    }
    else {
        alert("Datos incorrectos");
    }
}