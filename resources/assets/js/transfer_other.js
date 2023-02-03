function showTransfer_other(str = "", div_name, func_name,thiss="") {
 
    if (str == "") {
      document.getElementById(div_name).innerHTML = "";
      return;
    } else {
        const buttons = document.querySelector('.bg-success');
        
        if(buttons!==null)
          buttons.classList.remove('bg-success');
        thiss.parentElement.parentElement.classList.add('bg-success', 'font-weight-bold');
      
      // document.getElementById("amount").innerHTML=``;
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById(div_name).innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "Transfer_other/sender_select?g=" + str, true);
  
      // xmlhttp.open("GET", "Transfer/recipient?q=" + str, true);
      xmlhttp.send();
    }
  }

  
  function amount_other(div_name="") {
    $(document).ready(function () {
        let amount = "";
        if(div_name ==='amount_p')
          amount = $("#input_amount")
        else
          amount = $("#input_iban");
        const xmlhttp = new XMLHttpRequest();
        if (amount.val() !== "") {
          const buttons = document.querySelector('.bg-success');
          if(buttons!==null)
            buttons.classList.remove('bg-success');
          if (div_name ==='amount_p'){
            document.getElementById("send_part").innerHTML = ``;
            document.getElementById("recipient_other").innerHTML = ``;
            document.getElementById("input_iban").value = ``;
          }
          xmlhttp.onreadystatechange = function (e) {
            if (this.readyState == 4 && this.status == 200) {
              if (div_name === 'amount_p')
                document.getElementById("amount_part").innerHTML = this.responseText;
              else
                document.getElementById("recipient_other").innerHTML = this.responseText;
            }
          };
          let string = amount.val();
          if (div_name === 'amount_p')
            xmlhttp.open("GET", "Transfer_other/send_amount?v=" + string, true);
          else
            xmlhttp.open("GET", "Transfer_other/recipient_other?m=" + string, true);
    
          xmlhttp.send();
          setTimeout(() => {
            document.getElementById("amount_part").innerHTML = ``;
          }, 3000);
          
        }
      })
}