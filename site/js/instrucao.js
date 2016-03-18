function abrirPag(valor){
var url = valor;
 
xmlRequest.open("GET",url,true);
xmlRequest.onreadystatechange = mudancaEstado;
xmlRequest.send(null);
 
if (xmlRequest.readyState == 1) {
document.getElementById("conteudo").innerHTML = "<div id='carregando'><img src='http://www.boavista.rr.gov.br/imagens/carregando.gif'></div>";
}
    $('#lateral').removeClass('menu-active');
    $('body').removeClass('active');
return url;
}
 
function mudancaEstado(){
if (xmlRequest.readyState == 4){
document.getElementById("conteudo").innerHTML = xmlRequest.responseText;
}
}