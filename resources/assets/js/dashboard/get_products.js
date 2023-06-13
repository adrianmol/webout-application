document.addEventListener("DOMContentLoaded", () => {
    document
        .getElementById("getProducts")
        .addEventListener("click", getProductsErp);

    function getProductsErp() {
        const button = this;
        const result = document.getElementById("erp-result");
        const spinner = document.createElement("span");
        spinner.classList.add(
            "spinner-border",
            "text-white",
            "me-1",
            "align-self-center",
            "loader-sm"
        );

        button.prepend(spinner);
        button.setAttribute("disabled", true);

        fetch("/products/runErpJob")
            .then((response) => response.text())
            .then((response) => {
                console.log(response);
                const data = JSON.parse(response);
                Snackbar.show({ text: `${data.message}`, pos: "top-right" });
                button.removeAttribute("disabled");
                spinner.remove();
            });
    }
});
