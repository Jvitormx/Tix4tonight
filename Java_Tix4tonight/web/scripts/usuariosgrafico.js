// O JS acionará o PHP, contudo é necessário que esta função seja assíncrona
// É necessário aguardar para recever a resposta do Servidor.
const criarGrafico = async () => {
  //Aciona o SQL e recebe a resposta.
  const dados = await fetch("./usuariosgrafico.jsp");
  const resposta = await dados.json();
  //Você pode usar o console para saber se os dados foram recebidos.
  console.log(resposta['dados']);

        var ctx = document.getElementById("myChart");
        var valores = resposta['dados'];
        var tipos = ["ADM", "Comum"];

        var myChart = new Chart(ctx, {
          type: "pie",
          data: {
            labels: tipos,
            datasets: [
              {
                label: "Usuarios",
                data: valores,
                backgroundColor: [
                  "rgba(255, 99, 132, 0.2)",
                  "rgba(54, 162, 235, 0.2)",
                  "rgba(255, 206, 86, 0.2)",
                  "rgba(75, 192, 192, 0.2)",
                  "rgba(153, 102, 255, 0.2)",
                ]
              }
            ]
          }
        }); 

}

criarGrafico();


