function showBranch(str, div_name, func_name = "retrieve_data") {
  // For data transfer when the city or branch is pressed
  if (str == "") {
    document.getElementById(div_name).innerHTML = "";
    document.getElementById("info").innerHTML = ``;
    document.getElementById("info").classList.add("d-none");
    if (div_name === "districts")
      document.getElementById("districts").classList.add("d-none");
    return;
  } else {
    document.getElementById("districts").classList.remove("d-none");
    document.getElementById("info").classList.remove("d-none");
    document.getElementById("info").innerHTML = ``;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById(div_name).innerHTML = this.responseText;
      }
    };
    if (func_name !== "retrieve_data")
      xmlhttp.open("GET", "Main_menu/show_info?r=" + str, true);
    else xmlhttp.open("GET", "Main_menu/retrieve_data?q=" + str, true);

    xmlhttp.send();
  }
}
