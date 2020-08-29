<template>
    <!-- componente que es mostrado cuando un usuario no tiene permiso de entrara a una respectiva pagina, unicamente tiene un texto
     Debido a que no se requeire de mas acciones-->
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mt-5"> NO TIENES ACCESSO PARA ESTA PAGINA </h1>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
