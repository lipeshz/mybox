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
    console.log("retorno do stringBuilder: " + dataArray);
    return JSON.stringify(dataArray)
}