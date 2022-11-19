const btn = document.getElementById("pagamento2");

btn.addEventListener("click", ()=>{

    if(btn.value === "Selecionar"){
        btn.value = "Selecionado";
    }else{
        btn.value= "Red";
    }
})