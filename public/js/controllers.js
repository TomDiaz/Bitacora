


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
        'clave': document.getElementById('clave').value,
        'clave_confirmation': document.getElementById('clave_confirmation').value,
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
              document.getElementById('clave'),
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


function deleteBitacora(id){

  console.log("Se eleimino el bitacora con el id: " + id)

    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;


     Swal.fire({
       title: '¿Está seguro?',
       text: "¡No podrás revertir esto!",
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Si, borrar bitacora!',
       cancelButtonText: 'Cancelar'
     }).then((result) => {

       if (result.value) {

        console.log("Pasa por aca")

        fetch('/bitacoras/delete/' + id,{

            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
    
        })
        .then( res => res.json())
        .then( data => {
    
           console.log(data)

           Swal.fire(
             'Eliminada!',
             'La bitacora ' + data.bitacora + ' ha sido eliminada.',
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

/// Cambio de contraseña
function keyCapitan(id){

  Swal.fire({
    html: `
         <div class="clave-capitan">
           <h3>Cambio de clave</h3>
           <hr>
            <input type="password" class="form-control " name="clave" placeholder="Nueva clave" id="clave" aria-describedby="emailHelp" >
            </br>
            <input type="password" class="form-control " name="clave_confirmation" placeholder="Confirmar nueva clave" id="clave_confirmation" aria-describedby="emailHelp" >
           <hr>
         
         </div>
      `,
    showCancelButton: true,
    confirmButtonText: 'Aceptar y guardar',
    cancelButtonText: 'Cancelar',
    cancelButtonColor: '#d33',

  }).then((result) => {

    if (result.value) {
      
      const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
      let clave = $('#clave').val()
      let clave_confirmation = $('#clave_confirmation').val()
      let data = {
          'clave': clave,
          'clave_confirmation': clave_confirmation
      }

      console.log(data)

      fetch('/storeKey/' + id,{

        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        }
      })
      .then( res => res.json())
      .then( data => {

        Swal.fire(
          '',
          data.msj ,
          data.type
        )
      })

     }
  });

}


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



/* EMBARCACIONES  */

  
async function popupCapitanes(capitanes){
   console.log(capitanes)

    if(capitanes.length > 0){

     let data = await fetch('/capchecked')
                     .then( res => res.json())
                     .then( data => {
                          return data
                      })
 
    console.log("-----Capitanes elejidos")
    console.log(data)
    console.log("----Capitanes elejidos end")                      
  
   
    let capitanes_nuevo = []
    let tamplate = ''
    let capitanes_check = data.id;
    let capitanes_cuil;

    if(data.capitanes.length > 0){
       data.capitanes.forEach(element => {
           
           let check = true;

           if(capitanes.find(x => x.id == element.id)){
               check = false;
           }

           if(check){
             console.log("-----Capitanes elejidos 3")
             console.log(element)
             capitanes.push(element)
           }

       });
    }

    

    capitanes.forEach(element => {

        console.log(data.id)
        if(data.id.find(x => x == element.id)){
          
          tamplate += `
          <div class="capitan"><span>${element.nombres} ${element.apellidos} - CUIL:${element.cuil}</span><input disabled="false" class="check " type="checkbox" checked value="${element.id}" id="capitan-${element.id}"> <i class="fa-solid fa-circle-check"></i></div>
          `
        }

        else{

          tamplate += `
             <div class="capitan"><span>${element.nombres} ${element.apellidos} - CUIL:${element.cuil}</span><input disabled="false" class="check " type="checkbox" value="${element.id}" id="capitan-${element.id}"> <i class="fa-solid"></i></div>
          `
        }

    });

    

    Swal.fire({
      html: `
           <div class="capitanes">
             <h3>Capitanes</h3>
             <hr>
              <input type="text" class="form-control cuil-capitan" name="cuil_capitan" placeholder="Sumar capitan por cuil" id="exampleInputEmail1" aria-describedby="emailHelp" >
             <hr>
             <div class="nuevo_capitan">
             </div>
              ${tamplate}
           </div>
        `,
      customClass: 'capitanes-visor',
      showCancelButton: true,
      confirmButtonText: 'Aceptar y guardar',
      cancelButtonText: 'Cancelar',
      cancelButtonColor: '#d33',

    })
    .then((result) => {
         if(result.value){

           const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

           let data = {
             'capitanes': capitanes_check
           }

           fetch('/capchecked',{

            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
    
           })
            .then( res => res.json())
            .then( data => {
                console.log(data)
           })

           
           console.log("check: " + capitanes_check)
           console.log("Cuil: " + capitanes_cuil)

           let cont_text = ''
           if(capitanes_check.length > 0){
             cont_text = `<span> ${capitanes_check.length} </span>`
           }

           $('.btn-list-capitanes').html(`Agregar Capitan/es ${cont_text}`)

         }
    })


    $(".cuil-capitan").change(function(){
      capitanCuil($(this).val())
      $(this).val('');
    });

    async function capitanCuil(cuil){

      let data = await fetch('/capitan/' + cuil)
                    .then( res => res.json())
                    .then( data => {
                         return data
                     })
       console.log(data)

      
       let tamplate2 = ''
       capitanes_nuevo.push(data)

       console.log(capitanes_nuevo)
       capitanes_nuevo.forEach(element => {
        tamplate2 += `
          <div class="capitan"><span>${element.nombres} ${element.apellidos} - CUIL:${element.cuil} </span><input disabled="false" class="check " type="checkbox" checked value="${element.id}" id="capitan-${element.id}"> <i class="fa-solid fa-circle-check"></i></div>
          `
        });

      $('.nuevo_capitan').html(tamplate2)
      capitanes_check.push(data.id.toString())
      console.log(capitanes_check)

      $('.nuevo_capitan .capitan').click(function(){
        console.log("click")

        if($(this).children('.check').is(':checked')){

          $(this).children('.check').attr( 'checked', false )
          $(this).children('i').removeClass('fa-circle-check')
  
  
         let index =  capitanes_check.findIndex( x => x == $(this).children('.check').val());
  
         console.log(index)
  
        
         capitanes_check.splice(index, 1)
  
        }
        else{
  
          $(this).children('.check').attr( 'checked', true)
          $(this).children('i').addClass('fa-circle-check')
          capitanes_check.push($(this).children('.check').val())
          console.log(capitanes_check)
        }
      })
       
    }

    $('.capitan').click(function(){

      console.log("click")

      if($(this).children('.check').is(':checked')){

        $(this).children('.check').attr( 'checked', false )
        $(this).children('i').removeClass('fa-circle-check')


       let index =  capitanes_check.findIndex( x => x == $(this).children('.check').val());

       console.log(index)

      
       capitanes_check.splice(index, 1)

      }
      else{

        $(this).children('.check').attr( 'checked', true)
        $(this).children('i').addClass('fa-circle-check')
        capitanes_check.push($(this).children('.check').val())
        console.log(capitanes_check)
      }

      
 
   });

     
   }
   else{
     $('.btn-list-capitanes').attr("disabled", "disabled")
     Swal.fire({
      icon: 'error',
      title: 'Sin capitanes para agregar',
      text: 'Por favor agregue un nuevo capitan para continuar..',
      type: "error",
      showConfirmButton: false,
      timer: 2000

    })

   }

  }


 


/* EMBARCACIONES END */