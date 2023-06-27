import Dropzone from "dropzone";

var url = window. location. href; //PARA USAR LAS FUNCIONES EN DETERMINADAS PAGINAS 
console.log(url);
//MOSTRAR MESAJE DE COMENTARIO EXITOSO EN CREAR PUBLICACION

window.addEventListener('load', ini, false);
    function ini() {
    setTimeout(function () {
        $("#mensaje").fadeOut(1000);
    }, 1000);
};

                            

//SWITCH ENTRE SEGUIDOS Y SEGUIDORES
window.addEventListener('load', init, false);
function init() {    
    let div1 = document.querySelector('#seguidos');
    div1.style.display = '';
    let div2 = document.querySelector('#seguidores');
    div2.style.display = 'none';
    let boton1 = document.querySelector('#boton1');
    let boton2 = document.querySelector('#boton2');
    
    boton1.addEventListener('click', function (e) {
        if(div1.style.display === ''){
            div2.style.display = 'none';
            boton2.style.fontWeight = '600';             
            boton2.style.color = 'rgb(156 163 175)';
        }else{
            div1.style.display = '';
            div2.style.display = 'none';            
            boton1.style.color = 'black';
            boton1.style.fontWeight = '700';           
            boton2.style.color = 'rgb(156 163 175)';
            boton2.style.fontWeight = '600';
        }
    }, false);
   
    boton2.addEventListener('click', function (e) {
        if(div2.style.display === 'grid'){
            div1.style.display = 'none';
            boton1.style.fontWeight = '600';
            boton1.style.color = 'rgb(156 163 175)';
        }else{
            div2.style.display = 'grid';
            div1.style.display = 'none';           
            boton2.style.color = 'black';
            boton2.style.fontWeight = '700';             
            boton1.style.color = 'rgb(156 163 175)';
            boton1.style.fontWeight = '600';
        }
    }, false);
}


//DROPZONE

if (url=='http://localhost:8000/posts/create') {
    

    Dropzone.autoDiscover = false;

    const dropzone = new Dropzone("#dropzone", {
        dictDefaultMessage: "Arrastra o pincha aqui para subir la imagen",
        acceptedFiles: ".png, .jpg, .jpeg, .gif",
        addRemoveLinks: true,
        dictRemoveFile: 'Borrar Archivo',
        maxFiles: 1,
        uploadMultiple: false,

        ini: function(){
            if (document.querySelector(['name="imagen"']).value.trim()) {
            const imagenPublicada = {}
            imagenPublicada.size = 1234;
            imagenPublicada.size = document.querySelector(['name="imagen"']).value;  
            
            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);
            
            imagenPublicada.previewElement.calssList.add('dz-success', 'dz-complete')
            }        
        }
    })

    // dropzone.on('sending', function(file, xhr, formData){
    //     console.log(file);
    // })

    // dropzone.on('error', function(file, message){
    //     console.log(message);
    // })

    dropzone.on('success', function(file, response){
        
        document.querySelector('[name="imagen"]').value = response.imagen
    })

    dropzone.on('removeFile', function(){
        document.querySelector('[name="imagen"]').value = '';
    })

}
console.log(url);









                    