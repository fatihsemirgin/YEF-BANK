var counter=3;
function amount() {
    $(document).ready(function () {
        const amount = $("#currency-field");
        const xmlhttp = new XMLHttpRequest();
        if (amount.val() !== "") {
          const buttons = document.querySelector('.bg-success');
          if(buttons!==null)
            buttons.classList.remove('bg-success');
          document.getElementById("sender").innerHTML = ``;
          xmlhttp.onreadystatechange = function (e) {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("amount").innerHTML = this.responseText;
            }
          };
          var string = amount.val();
          xmlhttp.open("GET", "Transfer/done?d=" + string, true);
    
          xmlhttp.send();
          setTimeout(() => {
            const ınterval_temp = setInterval(() => {
              document.getElementById("amount").innerHTML = `<h3>The Page is Reload After ${counter} seconds...</h3>`
              counter--;
              if(counter === -1){
                clearInterval(ınterval_temp);
                document.location.reload();
              }
                
            }, 800);
          }, 1200);
        }
      })
}
