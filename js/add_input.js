// Identifica o botão e o container dos novos campos.
const btnAddInput = document.getElementById("add-input")
const inputContainer = document.getElementById("input-container");

function addInput(){
    // Cria o campo e o select do tipo de dado
    const newInput = document.createElement('input')
    const newInputType = document.createElement('select')
    const newInputTitle = document.createElement('input')
    const row = document.createElement('div')

    newInputTitle.classList.add('json-key')
    newInput.classList.add('json-value')
    newInputTitle.placeholder = "Nome do campo"
    row.classList.add('input-form')

    const btnRemoveInput = document.createElement('button')
    btnRemoveInput.innerText = 'REMOVE'
    btnRemoveInput.type = 'button'

    // Preenche o select com as opções de tipo de dado
    const newOption1 = new Option('Texto', 'text')
    const newOption2 = new Option('Númerico', 'number')
    const newOption3 = new Option('Arquivo', 'file')
    newInputType.add(newOption1)
    newInputType.add(newOption2)
    newInputType.add(newOption3)
    
    // Espera uma mudança no select para mudar o tipo de campo
    newInputType.addEventListener('change', function(){
        newInput.type = newInputType.value
        newInput.value = ""
    })

    // Remove a div do container
    btnRemoveInput.onclick = () => row.remove();

    // Insere os campos na div
    row.appendChild(newInputTitle)
    row.appendChild(newInput)
    row.appendChild(newInputType)
    row.appendChild(btnRemoveInput)

    // Insere a div no container
    inputContainer.append(row)
}

function stringBuilder(){
    const dataRows = document.querySelectorAll('.input-form');
    let dataArray = {}

    dataRows.forEach(dataRow => {
        const key = dataRow.getAttribute('data-name');
        const value = dataRow.querySelector('.json-value').value

        if(key && value.length > 0){
            dataArray[key] = value
        }
    });
    return JSON.stringify(dataArray)
}