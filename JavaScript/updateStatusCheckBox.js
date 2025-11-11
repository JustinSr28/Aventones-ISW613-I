document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll(".status-toggle").forEach(checkbox => { //Identifica los elementos que tengan la clase status-toggle, y por cada checkBox, hace un listener de evento
        checkbox.addEventListener("change", function () { //Cada vez que un checkbox cambie, ejecuta la funcion
            const userId = this.getAttribute("data-id"); //Captamos el valor del del atributo html que creamos
            const newState = this.checked ? "active" : "inactive"; //Operador ternario, si el checkBox está checkeado, será active, sino inactive
             

           
            fetch("../actions/updateStatus.php", { 
                method: "POST", //Establecimos que el metodo a utilzar es el POST
                headers: { "Content-Type": "application/x-www-form-urlencoded" }, //Le dice al navegador que será una request en formato form
                body: `id=${encodeURIComponent(userId)}&state=${encodeURIComponent(newState)}` //Enviamos en el body de la request los parametros necesarios
            })   
        });
    });
});

