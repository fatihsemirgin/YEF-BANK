function showTransfer(str = "", div_name, func_name,thiss="") {
  if (str == "") {
    document.getElementById(div_name).innerHTML = "";
    return;
  } else {
    if(func_name === 'recipient'){
      const buttons = document.querySelector('.bg-success');
      if(buttons!==null)
        buttons.classList.remove('bg-success');
      document.getElementById(str).parentElement.parentElement.classList.add('bg-success', 'font-weight-bold');
      
    }
    else{
      const buttons = document.querySelectorAll('.bg-success');
      if(buttons!==null && buttons.length>1){
        buttons[buttons.length-1].classList.remove('bg-success');
      }
        
      thiss.parentElement.parentElement.classList.add('bg-success', 'font-weight-bold')
    }
    document.getElementById("amount").innerHTML=``;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById(div_name).innerHTML = this.responseText;
      }
    };
    if (func_name !== "recipient")
      xmlhttp.open("GET", "Transfer/sender?r=" + str, true);
    else xmlhttp.open("GET", "Transfer/recipient?q=" + str, true);

    // xmlhttp.open("GET", "Transfer/recipient?q=" + str, true);
    xmlhttp.send();
  }
}
