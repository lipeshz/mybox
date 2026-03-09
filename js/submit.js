async function submitData(){
    const data = stringBuilder();
    const obj = JSON.parse(data);
    window.alert(data);
    window.alert(obj.quantity);
    try{
        // Define a resposta como sendo do controller
        const response = await fetch('../controllers/equipments_register.php', {
            // Define as informações da requisição
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: data
        });

        const result = await response.json();
        if(result.status == "success"){
            alert(result.response.msg);
            window.location.href = "../views/index.php";
        }else{
            alert("Error: " + result.response.msg);
        }
    
    }catch(error){
        console.error('Erro:', error);
    }
}

// async function submitData(){
//     const data = stringBuilder();
//     window.alert(data);
//     const response = await fetch('../controllers/equipments_register.php', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json'
//         },
//         body: data
//     });
//     try{
//         const text = await response.text();
//         console.log(text)
//     }catch(error){

//     }
// }