document.addEventListener("DOMContentLoaded", () => {

    document.getElementById('getCategories').addEventListener('click', getCategoriesErp); 

    function getCategoriesErp(){
        const button = this;
        const result = document.getElementById('erp-result');
        const spinner = document.createElement('span');
        spinner.classList.add('spinner-border', 'text-white', 'me-1', 'align-self-center', 'loader-sm');
        
        button.prepend(spinner);
        button.setAttribute('disabled', true);

        
        fetch('/erp/megasoft/categories')    
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

