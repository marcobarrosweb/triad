//SELECT2 SALA
$("#sala").select2();
//CLOCK HORA
$('.clockpicker').clockpicker();

//DATA INICIO DATAPICKER`
$('#data_inicio').datepicker({
autoclose: true,
beforeShowDay: $.noop,
calendarWeeks: false,
clearBtn: false,
daysOfWeekDisabled: [],
endDate: Infinity,
forceParse: true,
format: 'dd/mm/yyyy',
keyboardNavigation: true,
language: 'en',
minViewMode: 0,
orientation: "auto",
rtl: false,
startDate: new Date(),
startView: '',
todayBtn: false,
todayHighlight: false,
weekStart: 0
 });

//DATA FIM DATAPICKER
  $('#data_fim').datepicker({
  autoclose: true,
  beforeShowDay: $.noop,
  calendarWeeks: false,
  clearBtn: false,
  daysOfWeekDisabled: [],
  endDate: Infinity,
  forceParse: true,
  format: 'dd/mm/yyyy',
  keyboardNavigation: true,
  language: 'en',
  minViewMode: 0,
  orientation: "auto",
  rtl: false,
 startDate: new Date(),
  startView: '',
  todayBtn: false,
  todayHighlight: false,
  weekStart: 0
   });
