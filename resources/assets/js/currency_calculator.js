const primary_currency = document.getElementById("currency_1").options;
const secondary_currency = document.getElementById("currency_2").options;

document.getElementById("btn-convert").addEventListener("click", () => {
    $(document).ready(function () {
        document.getElementById("result").classList.remove("d-none");
        document.getElementById("result").classList.add("d-block");

        const amount = $("#amount");
        const xmlhttp = new XMLHttpRequest();
        if (amount.val() !== "") {
            xmlhttp.onreadystatechange = function(e) {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txt-toBeConverted").innerHTML = "<b>Result: </b>" + this.responseText + " " + secondary_currency[secondary_currency.selectedIndex].text;
                }
            };
            var string = `${amount.val()}/${primary_currency[primary_currency.selectedIndex].text}/${secondary_currency[secondary_currency.selectedIndex].text}`;
            xmlhttp.open("GET","http://localhost/yef/calculator/convert/" + string, true);

            xmlhttp.send();
        }

    }); } );
