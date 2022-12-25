window.URL = window.URL || window.webkitURL;

var fileSelect = document.getElementById("fileSelect"),
fileElem = document.getElementById("fileElem"),
fileList = document.getElementById("fileList");


fileSelect.addEventListener("click", function (e) {

  
  if (fileElem) {
    fileElem.click();
}
e.preventDefault(); 
}, false);

function handleFiles(files) {
  if (!files.length) {
    fileList.innerHTML = "<p>Selecione um Arquivo!</p>";
  }else if (files[0].type !== "text/csv") {
    fileList.innerHTML = "<p>Formato de arquivo inválido</p>";
    setTimeout(function () {
      fileList.innerHTML = "";
    }, 2000);
  }
  else {
      var list = document.createElement("ul");
    for (var i = 0; i < files.length; i++) {
      var li = document.createElement("li");
      list.appendChild(li);
        
    for (var a = 0; a < 1; a++) {
        var url = window.URL.createObjectURL(files[a]);
        var anexos
        if (localStorage.getItem("anexos") === null) { 
            anexos = [];
            anexos.push(url+'indice'+i);
            localStorage.setItem("anexos", JSON.stringify(anexos));
        }else {
            anexos = JSON.parse(localStorage.getItem("anexos"));
            anexos.push(url);
            localStorage.setItem("anexos", JSON.stringify(anexos));
        }
    }
    
var botao = document.createElement("button");
botao.textContent = "delete";
botao.className = "material-symbols-outlined delete-icon";
botao.onclick = function () {
    var anexos = JSON.parse(localStorage.getItem("anexos"));
    var index = anexos.indexOf(url);
    anexos.splice(index, 1);
    localStorage.setItem("anexos", JSON.stringify(anexos));
    var li = this.parentNode;
    var ul = li.parentNode;
    ul.removeChild(li);
};
li.appendChild(botao);



    if (files[i].type == "text/csv" ) {
        var icone = document.createElement("img");
        icone.src = "https://img.freepik.com/premium-psd/3d-file-csv-format-icon-illustration_148391-991.jpg?w=2000";
        icone.width = 20;
        icone.height = 20;
        var info = document.createElement("span");
        info.innerHTML = files[i].name + ": " + files[i].size + " bytes";
        li.appendChild(info);
        li.appendChild(icone);
    }

    }
    fileList.appendChild(list);

  }
}

function aguarde(){
    const img = 'https://cdn.dribbble.com/users/8424/screenshots/1036999/dots_2.gif';
    Swal.fire({
        title: 'Aguarde calculando dados...',
        html: '<img src="'+img+'" alt="aguarde" width="100px" height="100px" />',
        allowOutsideClick: false,
        showConfirmButton: false
    });
    setTimeout(() => {
        Swal.close();
    }, 5000);
}