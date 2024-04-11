$(document).ready(function() {
    setup();
});
function setup(){
    const sortableList = document.getElementById('draggable-list')
    
    const initSortableList = (e) => {
        e.preventDefault();
        const draggingItem = sortableList.querySelector('tr[data-state="dragging"]');
        const siblings = [...sortableList.querySelectorAll('tr[data-state="static"]')];
        
        let nextSibling = siblings.find(sibling => {
            let siblingtype = sibling.getAttribute('data-type');
            let draggingtype = draggingItem.getAttribute('data-type');
            let siblingClientRect = sibling.getBoundingClientRect();
            let siblingItemY = siblingClientRect.top + siblingClientRect.height / 2;

            if (siblingtype === draggingtype) {
                return e.clientY < siblingItemY;
            } else {
                if(siblingtype < draggingtype){
                    return true;
                } else {
                    return null;
                }
            }
        });
        if(nextSibling != null){
            sortableList.insertBefore(draggingItem, nextSibling);
        }
    }

    sortableList.addEventListener('dragover', initSortableList);
    sortableList.addEventListener('dragenter', e => e.preventDefault());
    
    draggableItems = document.querySelectorAll('tr[draggable="true"]');
    draggableItems.forEach(item => {
        item.addEventListener('dragstart', function(){
            setTimeout(() => item.setAttribute('data-state', 'dragging'), 0);
        });
        item.addEventListener('dragend', function(){
            item.setAttribute('data-state', 'static');

            const maxParticipants = parseInt(document.getElementById('maxParticipants').value);

            const proRows = document.querySelectorAll('tr[data-type="PRO"]');
            const proCount = proRows.length;
            for (let i = 0; i < proCount; i++) {
                const numDorsalTd = proRows[i].querySelector('#num-dorsal');
                numDorsalTd.textContent = i + 1;
                proRows[i].setAttribute('data-dorsal', i + 1);
            }

            const openRows = document.querySelectorAll('tr[data-type="OPEN"]');
            const openCount = openRows.length;
            for (let i = 0; i < openCount; i++) {
                const numDorsalTd = openRows[i].querySelector('#num-dorsal');
                const newDorsal = maxParticipants + i + 1;
                numDorsalTd.textContent = newDorsal;
                openRows[i].setAttribute('data-dorsal', newDorsal);
            }
            
            const carrera = document.getElementById('carrera-id');
            const carreraId = carrera.getAttribute('data-carrera');
            const url = carrera.getAttribute('data-url');
            const token = document.querySelector('input[name="_token"]').getAttribute('value');

            let dorsales = [];
            draggableItems = document.querySelectorAll('tr[draggable="true"]');
            draggableItems.forEach((item) => {
                dorsales.push({
                    dni: item.getAttribute('data-id'),
                    dorsalnum: item.getAttribute('data-dorsal')
                });
            });
            console.log(dorsales);
            
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: token,
                    numDorsales: dorsales,
                    carreraid: carreraId,
                },
                success: function(response) {
                    console.log(response.message);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
}