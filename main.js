addEventListener("DOMContentLoaded", async(e)=>{
    let form = document.querySelector("#msform");    
    let peticion = await fetch(form.action);
    let json = await peticion.json();
    document.querySelector("#tipoDocumento").insertAdjacentHTML("beforeend", json.InformacionPersonal.select);
    document.querySelector("#generos").insertAdjacentHTML("beforeend", json.InformacionPersonal.genero);
    document.querySelector("#estados").insertAdjacentHTML("beforeend", json.InformacionPersonal.estadoCivil);



    let validarDatos = (input)=>{
        let data = {};
        for (let [id, value] of Object.entries(input)) {
            if(value.type != "submit"){
                if(value.type == "radio" && value.type == "checkbox"){
                    if(value.checked){
                        data[`${value.name}`] = value.value;
                    }
                }else if(value.nodeName == "select".toUpperCase()){
                    data[`${value.id}`] = value.options[value.selectedIndex].value;
                }else{
                    data[`${value.id}`] = value.value;
                }
            }
        }
        console.log(data);
    }
    form.addEventListener("submit", (e)=>{
        let input;
        if(e.submitter.dataset.boton == "informacionPersonal"){
            input = Array.from(e.target[0].querySelectorAll('input, select'));
        }
        input = validarDatos(input);
        console.log(input);
        e.preventDefault();
    })
})