var cal = {
  // (A) INIT CALENDAR
  hMth:null, hYr:null, // MONTH & YEAR
  hWrap:null, // DAYS WRAPPER
  // EVENT FORM
  hBlock:null, hForm:null, hFormCX:null,
  hID:null, hStart:null, hEnd:null, hTxt:null, dTxT:null, hColor:null,
  init : () => {
    // (A1) GET HTML ELEMENTS
    cal.hMth = document.getElementById("calmonth");
    cal.hYr = document.getElementById("calyear");
    cal.hWrap = document.getElementById("calwrap");
    cal.hBlock = document.getElementById("calblock");
    cal.hForm = document.getElementById("calform");
    cal.hFormCX = document.getElementById("calformcx");
    cal.hID = document.getElementById("evtid");
    cal.hStart = document.getElementById("evtstart");
    cal.hEnd = document.getElementById("evtend");
    cal.hTxt = document.getElementById("evttxt");
    cal.dTxt = document.getElementById("detalles");
    cal.hColor = document.getElementById("evtcolor");

    // (A2) ATTACH CONTROLS
    cal.hMth.onchange = cal.draw;
    cal.hYr.onchange = cal.draw;
    cal.hForm.onsubmit = cal.save;
    cal.hFormCX.onclick = cal.hide;

    // (A3) DRAW CURRENT MONTH/YEAR
    cal.draw();
  },

  // (B) SUPPORT FUNCTION - AJAX FETCH
  ajax : (data, load) => {
    fetch("ajaxJugador.php", { method:"POST", body:data })
    .then(res=>res.text()).then(load);
  },

  // (C) DRAW CALENDAR
  draw : () => {
    // (C1) FORM DATA
    let data = new FormData();
    data.append("req", "draw");
    data.append("month", cal.hMth.value);
    data.append("year", cal.hYr.value);
    // (C2) AJAX LOAD SELECTED MONTH
    cal.ajax(data, (res) => {
      // (C2-1) ATTACH CALENDAR TO WRAPPER
      cal.hWrap.innerHTML = res;

      // (C2-3) CLICK EVENT TO EDIT
      for (let evt of cal.hWrap.getElementsByClassName("calevt")) {
        evt.onclick = (e) => { cal.show(evt); e.stopPropagation(); };
      }
    });
  },

  // (D) SHOW EVENT FORM
  show : (cell) => {
    let eid = cell.getAttribute("data-eid");

    // (D2) EDIT EVENT
      let edata = JSON.parse(document.getElementById("evt"+eid).innerHTML);
      cal.hID.value = eid;
      cal.hStart.value = edata["evt_start"].replaceAll(" ", "T");
      cal.hEnd.value = edata["evt_end"].replaceAll(" ", "T");
      cal.hTxt.value = edata["evt_text"];
      cal.dTxt.value = edata["detalles"];

    // (D3) SHOW EVENT FORM
    cal.hBlock.classList.add("show");
  },

  // (E) HIDE EVENT FORM
  hide : () => { cal.hBlock.classList.remove("show"); },
};
window.addEventListener("DOMContentLoaded", cal.init);
