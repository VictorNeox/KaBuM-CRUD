let months = [ 
    'Janeiro', 
    'Fevereiro', 
    'Marco', 
    'Abril', 
    'Maio', 
    'Junho', 
    'Julho', 
    'Agosto', 
    'Setembro', 
    'Outubro', 
    'Novembro', 
    'Dezembro' 
];

let weekdays = [ 
    'Domingo', 
    'Segunda-Feira', 
    'Terca-Feira', 
    'Quarta-Feira', 
    'Quinta-Feira', 
    'Sexta-Feira', 
    'Sabado' 
];

let date = new Date();

let options = {
    i18n: {
        months,
        monthsShort: [ 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez' ],
        weekdays,
        weekdaysShort: [ 'Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab' ],
        weekdaysLetter: [ 'D', 'S', 'T', 'Q', 'Q', 'S', 'S' ],
    },
    selectMonths: true,
    selectYears: true,
    clear: false,
    format: 'yyyy-mm-dd',
    today: "today",
    close: "X",
    closeOnSelect: true
}

document.addEventListener('DOMContentLoaded', function() {
    let elems = document.querySelectorAll('.datepicker');
    let instances = M.Datepicker.init(elems, options);
});
