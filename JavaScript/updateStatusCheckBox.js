document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll(".status-toggle").forEach(checkbox => {
        checkbox.addEventListener("change", function () {
            const userId = this.getAttribute("data-id");
            const newState = this.checked ? "active" : "inactive";
            const previous = !this.checked; 

           
            fetch("../actions/updateStatus.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `id=${encodeURIComponent(userId)}&state=${encodeURIComponent(newState)}`
            })   
        });
    });
});

