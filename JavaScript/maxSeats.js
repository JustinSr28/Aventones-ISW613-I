document.addEventListener("DOMContentLoaded", () => {
    const plateSelect = document.getElementById("plate"); //obtengo referencia de el select
    const seatsInput = document.getElementById("seats"); //obtengo referencia del spinner de asientos

    function updateMaxSeats() {
        const max = plateSelect.selectedOptions[0].getAttribute("data-max"); //obtengo el valor del atributo data-max de la posicion 0
        seatsInput.max = max; //Establezco el valor max del spinner.
        if (seatsInput.value > max) seatsInput.value = max; //En caso de que ya se haya seleccionado un valor mayor al maximo, lo ajusto al maximo.
    }

    plateSelect.addEventListener("change", updateMaxSeats); //Ejecuta siempre que "cambie"
    updateMaxSeats();
});