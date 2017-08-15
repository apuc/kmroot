function createMonth(year, month){
  if(!year && !month){
    year = new Date().getYear();
    month = new Date().getMonth();
  }
  if(month > 11){
    year += Math.floor(month / 11);
    month = month % 12;
  }
  if(month < 0){
    year += Math.floor(month / 11);
    month += 12;
  }
  calMonth = month;
  calYear = year;

  first_day = new Date(year, month, 1, 0, 0, 0, 0);
  first_day_of_week = (first_day.getDay() - 1) % 7 + 1;
  today = new Date();
  today = new Date(today.getYear()+1900, today.getMonth(), today.getDate(), 0, 0, 0, 0);

  mn = new Array('Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентрябрь','Октябрь','Ноябрь','Декабрь');

  $(".datepicker-switch").html(mn[month]+" "+(year+1900));

  var app = "";

  dateCal = first_day;
  dateCal.setDate(first_day.getDate() - first_day_of_week);

  for(c = 1; c <= 7; c++){
    app += "<tr>\n";
    for(b = 1; b <= 7; b++){
      dateCal.setDate(dateCal.getDate() + 1);

      if(today.getDate() == dateCal.getDate() && today.getMonth() == dateCal.getMonth() && today.getYear() == dateCal.getYear()+1900){
        addClass = " today";
      } else {
        addClass = "";
      }
      if(dateCal.getMonth() != month){
        old = " old";
      } else {
        old = "";
      }
      app += "<td class=\"day"+addClass+old+"\">"+dateCal.getDate()+"</td>\n";
    }
    app += "</tr>\n";
    if(c > 1 && dateCal.getMonth() != month){
      break;
    }
  }

  $(".table-condensed tbody").html(app);

}
