document.addEventListener("DOMContentLoaded", () => {

    document.getElementById('getManufacuters').addEventListener('click', getManufacutersErp); 

    function getManufacutersErp(){
        const button = this;
        const result = document.getElementById('erp-result');
        const spinner = document.createElement('span');
        spinner.classList.add('spinner-border', 'text-white', 'me-1', 'align-self-center', 'loader-sm');

        button.setAttribute('disabled', true);
        button.prepend(spinner);
        fetch('/erp/megasoft/manufacturers')    
        .then(response => response.text())
        .then(data => {
            const items = JSON.parse(data);
            Snackbar.show({text: `Total items: ${items.totalItems}`, pos: 'top-right'});
            button.removeAttribute('disabled');
            spinner.remove();
            location.reload();
        });
    }

});

