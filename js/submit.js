async function submitData(){
    const data = stringBuilder();
    window.alert(data);
    try{
        // Define a resposta como sendo do controller
        const request = await fetch('../controllers/equipments_register.php', {
            // Define as informações da requisição
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: data
        });

        const result = await request.json();
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