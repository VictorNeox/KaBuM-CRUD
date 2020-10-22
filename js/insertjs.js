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
    format: 'dd/mm/yyyy',
    today: "today",
    close: "X",
    closeOnSelect: true
}

document.addEventListener('DOMContentLoaded', function() {
    let elems = document.querySelectorAll('.datepicker');
    let instances = M.Datepicker.init(elems, options);
});


// Validates

function validate() {
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let cpf = document.getElementById("cpf").value;
    let rg = document.getElementById("rg").value;
    let telephone1 = document.getElementById("telephone1").value;
    let telephone2 = document.getElementById("telephone2").value;

    console.log(name, email, cpf, rg, telephone1, telephone2);
}


// onkeypress="return (/[0-9]/i.test(event.key))