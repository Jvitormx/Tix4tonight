(function(win,doc){
  'use strict';

  //Captura o elemento HTML marcado com a classe
  let calendarEl = doc.querySelector('.calendar');

  //Cria uma instância
  //dayGridMonth - Abre por mês, pode ser semana ou display 
let calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    //headerToolBar - configuração da barra superior. O que vai no início, no meio ou no fim
    headerToolbar:{
        start: 'prev,next,today',
        center: 'title',
        end: 'dayGridMonth, timeGridWeek, timeGridDay'
    },
    //buttonText - personaliza o texto dos botões da headerToolBar
    buttonText:{
        today:    'hoje',
        month:    'mês',
        week:     'semana',
        day:      'dia'
    },
    //locale - troca a linguagem
    locale:'pt-br',
    //Captura o evento clique
    dateClick: function(info) {
            if(info.view.type == 'dayGridMonth'){
                calendar.changeView('timeGrid', info.dateStr);
            }else{
                win.location.href='tela_criar_evento_calendario.php?date='+info.dateStr; 
            }
    },
    //Marca eventos no calendário
    events: 'eventoslistar.php',
	eventClick: function(info) {
		win.location.href='PaginaEvento2.php?id=${info.event.id}'
	}
});
calendar.render();

})(window,document);