async function submit(){
    const data = stringBuilder()

    try{
        if(data){
            // Define a resposta como sendo do controller
            const response = await fetch('../controllers/equipments_register.php', {
                // Define as informações da requisição
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: data
            });
        }
    }catch(error){
        console.error('Erro:', error);
    }
}