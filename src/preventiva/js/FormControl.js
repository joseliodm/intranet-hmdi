
function number(){
    const patrimonio = document.getElementById("patrimonio");
    const monitor  = document.getElementById("monitor");
    const editmonitor  = document.getElementById("editmonitor");
    const editpatrimonio = document.getElementById("editpatrimonio");
    
    patrimonio.addEventListener("keyup", function(){
        this.value = this.value.replace(/\D/g, "");
    }
    );
    monitor.addEventListener("keyup", function(){
        this.value = this.value.replace(/\D/g, "");
    }
    );
    editmonitor.addEventListener("keyup", function(){
        this.value = this.value.replace(/\D/g, "");
    }
    );
    editpatrimonio.addEventListener("keyup", function(){
        this.value = this.value.replace(/\D/g, "");
    }
    );
}
number();

async function getDate() {
    const response = await fetch('https://worldtimeapi.org/api/timezone/America/Sao_Paulo');
    const data = await response.json();
    const date = new Date(data.datetime);
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();
    const hours = date.getHours();
    const minutes = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
    const seconds = date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds();
    document.getElementById('date').innerHTML = `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
}
setInterval(getDate, 1000);

getDate();

$(document).ready(function(){
    $('input').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
});
