const modal = document.getElementById('modal-equipments');
const btnShow = document.getElementById('btn-show');
const btnClose = document.getElementById('btn-close');

btnShow.onclick = function(){
    modal.classList.add('show');
}

btnClose.onclick = function(){
    modal.classList.remove('show');
}

window.onclick = function(event){
    if(event.target == modal){
        modal.classList.remove('show');
    }
}