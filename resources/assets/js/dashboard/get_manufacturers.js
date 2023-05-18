document.addEventListener("DOMContentLoaded", () => {

    document.getElementById('getManufacuters').addEventListener('click', getManufacutersErp); 

    function getManufacutersErp(){
        const button = this;
        const result = document.getElementById('erp-result');
        button.setAttribute('disabled', true);
        
        fetch('/erp/megasoft/manufacturers')    
        .then(response => response.text())
        .then(data => {
            const items = JSON.parse(data);
            Snackbar.show({text: `Total items: ${items.totalItems}`, pos: 'top-right'});
            button.removeAttribute('disabled');
            location.reload();
        });
    }

});

