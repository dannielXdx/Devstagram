
import Dropzone from "dropzone";
     
Dropzone.autoDiscover = false;
 
const dropzone = new Dropzone(".dropzone", {
        dictDefaultMessage: "Sube aquí tu imagen",
        acceptedFiles: ".png, .jpg, .jpeg, .gif",
        addRemoveLinks: true,
        dictRemoveFile: "Borrar archivo",
        maxFiles: 1,
        uploadMultiple: false,

        init:function(){
            if(document.querySelector('[name="image"]').value.trim()){
                const imagenPublicada = {}
                imagenPublicada.size = 1234 // valor obligatorio pero no ocupado en esta situación, se pone cualquier cosa
                imagenPublicada.name = document.querySelector('[name="image"]').value;

                this.options.addedfile.call(this, imagenPublicada);
                this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

                imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
            }
        }
    });

dropzone.on('success', function(file, response){
    document.querySelector('[name="image"]').value = response.image;
})

dropzone.on('removedfile', function(){
    document.querySelector('[name="image"]').value = null;
})