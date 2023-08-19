document.addEventListener('DOMContentLoaded', function() {


    eventListeners();

    darkMode();
});

function darkMode() {
    const preferDarkMode = window.matchMedia(('prefers-color-scheme: daprefers-color-scheme: rk'));

    //console.log(preferDarkMode.matches)
    
    if(preferDarkMode.matches) {
        document.body.classList.add('.dark-mode');
    } else {
        document.body.classList.remove('.dark-mode');
    }
    
    preferDarkMode.addEventListener('change', function() {
        if(preferDarkMode.matches) {
            document.body.classList.add('.dark-mode');
        } else {
            document.body.classList.remove('.dark-mode');
        }
    })

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function() {

       document.body.classList.toggle('dark-mode')  

    });
}


function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive)

    //muestra campos condicionales      
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]')
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodoContacto))

};

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion') 

    if(navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    }
};


function mostrarMetodoContacto(e) {
    const contactoDiv = document.querySelector('#contacto');

     if(e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
        <label for="telefono">Numero Telefono</label>
        <input type="tel" id="telefono" placeholder="Tu Telefono" name="contacto[telefono]">

        <p>Indicar fecha y hora para la llamada</p>

        <label for="fecha">Fecha</label>
        <input type="date" id="telefono" name="contacto[fecha]">

        <label for="hora">Hora</label>
        <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]"> 
        `;
     } else {
        contactoDiv.innerHTML = `
        <label for="email">Tu Email</label>
        <input type="email" id="email" placeholder="Tu Email" name="contacto[email]" required>
        `
    }
}

