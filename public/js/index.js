var i_d = 1
var x = 0
function adiciona(){
  i_d += 1
  let input = document.createElement("input")
  input.type = "file"
  input.name = `pagina-${i_d}`
  input.id = `pag-${i_d}`
  input.className = "form-control m-2"
  document.getElementById("paginas").appendChild(input)  
}

function show(){
  if(x == 0){ 
  let texto = document.createElement("textarea")
  let botao = document.createElement("input")
  botao.type = "submit"
  botao.className = "btn btn-danger text-warning"
  botao.value = "Comentar" 
  texto.className = "form-control"
  texto.name = "coment" 
  document.getElementById("texto").appendChild(texto)
  document.getElementById("texto").appendChild(botao)
  x = 1
  }
}