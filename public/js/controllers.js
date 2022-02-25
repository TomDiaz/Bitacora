

let form_cap = document.getElementById('form_cap')

form_cap.addEventListener('submit', function(e){

    e.preventDefault();


    let data={
        'nombre': document.getElementById('nombre').value,
        'apellido': document.getElementById('apellido').value,
        'cuil': document.getElementById('cuil').value,
        'email': document.getElementById('email').value,
        'celular': document.getElementById('celular').value,
        'usuario': document.getElementById('usuario').value,
        'clave1': document.getElementById('clave1').value,
     }

    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;


    console.log(data)
  
    fetch('/capitanes',{

        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        }

    })
    .then( res => res.json())
    .then( data => {

        Swal.fire({
            position: 'center-center',
            icon: data.type,
            title: data.msj,
            showConfirmButton: false,
            timer: 2000,
            type: data.type,
          })

          let form= [
              document.getElementById('nombre'),
              document.getElementById('apellido'),
              document.getElementById('cuil'),
              document.getElementById('email'),
              document.getElementById('celular'),
              document.getElementById('usuario'),
              document.getElementById('clave1'),
          ]

        if(data.type == 'error'){

            console.log(data.err)
            
            form.forEach( element => {

                if(!element.value){
                    element.style.cssText = 'border: solid 1px red'
                    $(element).next('.icono').html(`
                    <i class="fa-solid fa-circle-exclamation fa-fade"></i>
                    `)
                }

            })
        }
        else{

            form.forEach( element => {
                    element.style.cssText = 'border: solid 1px #ced4da'
                    $('i').remove()
            })

            form_cap.reset()
        }

    })
    

})


function deleteCapitan(id){


    console.log("Se eleimino el capitan con el id: " + id)

    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;


     Swal.fire({
       title: '¿Está seguro?',
       text: "¡No podrás revertir esto!",
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Si, borrar capitan!',
       cancelButtonText: 'Cancelar'
     }).then((result) => {

       if (result.value) {

        console.log("Pasa por aca")

        fetch('/capitanes/' + id,{

            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
    
        })
        .then( res => res.json())
        .then( data => {
    
           console.log(data)

           Swal.fire(
             'Eliminado!',
             'El capitan ' + data.capitan + ' ha sido eliminado.',
             'success'
           )
           .then((result) => {
               console.log(result)

               if(result.value){
                 window.location.reload(true);
               }

           })

        })


       }
     })

     
}



function getiframe(url){
    Swal.fire({
        html: '<iframe style="width:100%;" src="' + url + '" frameborder="0"></iframe>',
        customClass: 'pdf-visor'

      })
}


function getMap(inicio, fin){

    console.log(inicio.longitud)



    Swal.fire({
        html: '<div id="mapa" style="width:100%; height:500px;"></div>',
        customClass: 'map-visor'

      })

      let mapa = new google.maps.Map(document.getElementById('mapa')  , {
        center: {lat: inicio.latitud , lng: inicio.longitud},
        zoom: 5,
        mapId: '761d02f6ca887a9c'
    });

    let marcador1 = new google.maps.Marker({
       map: mapa,
       draggable: true,
       position: {lat: inicio.latitud , lng: inicio.longitud},
       title: "Coordenadas Inicio"
    })

    let marcador2 = new google.maps.Marker({
       map: mapa,
       draggable: true,
       position: {lat: fin.latitud, lng: fin.longitud},
       title: 'Coordenadas Fin'
    })

    var infowindow1 = new google.maps.InfoWindow({
        content: `<span class="coord coord-color1">Coordenadas de Inicio</span>`
    });
    var infowindow2 = new google.maps.InfoWindow({
        content: `<span class="coord coord-color2">Coordenadas de Fin</span>`
    });

    infowindow1.open(mapa,marcador1);
    infowindow2.open(mapa,marcador2);

      google.maps.event.addListener(marcador1, 'click', function() {
        infowindow1.open(mapa,marcador1);
      });

      google.maps.event.addListener(marcador2, 'click', function() {
        infowindow2.open(mapa,marcador2);
      });
}



