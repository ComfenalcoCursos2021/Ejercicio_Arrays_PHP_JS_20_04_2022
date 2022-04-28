addEventListener("DOMContentLoaded", async(e)=>{
    /*Cargar los datos de los JSON de los formularios*/
    /**************************************************/
    let form = document.querySelector("#msform");    
    let peticion = await fetch(form.action);
    let json = await peticion.json();
    document.querySelector("#tipo-documento").insertAdjacentHTML("beforeend", json.InformacionPersonal.select);
    document.querySelector("#generos").insertAdjacentHTML("beforeend", json.InformacionPersonal.genero);
    document.querySelector("#estados").insertAdjacentHTML("beforeend", json.InformacionPersonal.estadoCivil);
    /**************************************************/

    
    let validarDatos = (input)=>{
        let data = {};
        for (let [id, value] of Object.entries(input)) {
            if(value.type != "submit"){
                if(value.type == "radio" || value.type == "checkbox"){
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
        return data;
    }
    let enviar = async(data)=>{
        let config = {
            method: form.method, 
            body: JSON.stringify(data)
        }
        let peticion = await fetch(form.action, config);
        let json = await peticion.text();
        console.log(json);
    }
    form.addEventListener("submit", (e)=>{
        let input;
        if(e.submitter.dataset.boton == "informacionPersonal"){
            input = Array.from(e.target[0].querySelectorAll('input, select'));
        }
        input = validarDatos(input);
        enviar(input);
        e.preventDefault();
    })


    document.querySelector(".botonF1").addEventListener("mouseover", (e)=>{
        let btn = document.querySelectorAll(".btn");
        for (let boton of Object.values(btn)) {
            boton.classList.add("animacionVer");
        }
    })
    document.querySelector(".contenedor").addEventListener("mouseleave", (e)=>{
        let btn = document.querySelectorAll(".btn");
        for (let boton of Object.values(btn)) {
            boton.classList.remove('animacionVer');
        }
    })
    let cargarDatos = async(data)=>{ 
        let config = {
            method:"POST",
            headers: {
                'file': data
            }
        };
        let peticion = await fetch(form.action, config);
        let json = await peticion.json();
        document.querySelector("thead").innerHTML = json.head;
        document.querySelector("tbody").innerHTML = json.body;
    }
    let modal = document.getElementById("myModal");
    document.querySelector("#myBtn").addEventListener("click", (e)=>{
        modal.style.display = "block";
        cargarDatos(e.target.offsetParent.dataset.json);
    })
    document.querySelector(".close").addEventListener("click", (e)=>{
        modal.style.display = "none";
    })
    



    
    
})